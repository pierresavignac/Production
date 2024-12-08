<?php

function backupAndFixFile($filePath) {
    if (!file_exists($filePath)) {
        echo "Le fichier $filePath n'existe pas.\n";
        return;
    }

    // Créer une sauvegarde
    $backupPath = $filePath . '.bak';
    if (!file_exists($backupPath)) {
        copy($filePath, $backupPath);
        echo "Sauvegarde créée : $backupPath\n";
    }

    $content = file_get_contents($filePath);
    $className = basename($filePath, '.php');
    
    if ($className === 'Task') {
        // Remplacer toutes les méthodes set() dans Task.php
        preg_match_all(
            '/\/\*\*\s*\n\s*\* @param RecordRef \$(\w+)\s*\n\s*\* @return[^\n]*\n\s*\*\/\s*\n\s*public function set\((?:\?\\\\RecordRef )?\$(\w+)\)/',
            $content,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $paramName = $match[1];
            $oldMethod = $match[0];
            $newMethod = "/**\n     * @param RecordRef \$$paramName\n     * @return \\ProgressionWebService\\Task\n     */\n    public function set$paramName(?\\RecordRef \$$paramName)";
            
            // Vérifier si la méthode existe déjà
            if (strpos($content, "function set$paramName") === false) {
                $content = str_replace($oldMethod, $newMethod, $content);
            }
        }
    }

    // Correction du constructeur si présent
    if (strpos($content, 'public function __construct') !== false) {
        $constructorPattern = '/public function __construct\((.*?)\)/s';
        if (preg_match($constructorPattern, $content, $matches)) {
            $params = explode(', ', $matches[1]);
            $newParams = array_map(function($param) {
                if (strpos($param, '\\DateTime') !== false) {
                    return str_replace('\\DateTime $removed = null', '?\\DateTime $removed', $param);
                }
                if (strpos($param, '$') === 0 && strpos($param, ' = null') !== false) {
                    $paramName = substr($param, 1, strpos($param, ' =') - 1);
                    return "?string \$$paramName";
                }
                return $param;
            }, $params);
            
            $newConstructor = 'public function __construct(' . implode(', ', $newParams) . ')';
            $content = preg_replace($constructorPattern, $newConstructor, $content);
        }
    }

    // Correction des paramètres array
    $content = preg_replace(
        '/\(array \$(\w+) = null\)/',
        '(?array $$1)',
        $content
    );

    file_put_contents($filePath, $content);
    echo "Fichier corrigé : $filePath\n";
}

// Restaurer les fichiers originaux s'ils existent
function restoreOriginals($files) {
    foreach ($files as $file) {
        $backupFile = $file . '.bak';
        if (file_exists($backupFile)) {
            copy($backupFile, $file);
            echo "Restauré : $file\n";
        }
    }
}

$files = [
    __DIR__ . '/ProgressionWebServiceV2/Record.php',
    __DIR__ . '/ProgressionWebServiceV2/ArrayOfProperty.php',
    __DIR__ . '/ProgressionWebServiceV2/ArrayOfRecord.php',
    __DIR__ . '/ProgressionWebServiceV2/Task.php',
    __DIR__ . '/ProgressionWebServiceV2/ArrayOfRecordRef.php',
    __DIR__ . '/ProgressionWebServiceV2/TaskState.php',
    __DIR__ . '/ProgressionWebServiceV2/TaskItemList.php',
    __DIR__ . '/ProgressionWebServiceV2/TaskItem.php',
    __DIR__ . '/ProgressionWebServiceV2/TaxAmount.php',
    __DIR__ . '/ProgressionWebServiceV2/TaskOptim.php'
];

// D'abord restaurer les fichiers originaux
restoreOriginals($files);

// Puis appliquer les corrections
foreach ($files as $file) {
    backupAndFixFile($file);
}

echo "\nTerminé ! Les fichiers ont été mis à jour pour utiliser des types nullables explicites.\n"; 