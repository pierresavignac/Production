<?php

spl_autoload_register(function ($class) {
    // Namespace de base pour les classes ProgressionWebService
    $prefix = 'ProgressionWebService\\';
    $base_dir = __DIR__ . '/';

    // Vérifier si la classe utilise le namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Récupérer le nom relatif de la classe
    $relative_class = substr($class, $len);

    // Remplacer le namespace par le chemin du dossier et ajouter .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si le fichier existe, le charger
    if (file_exists($file)) {
        require $file;
    }
}); 