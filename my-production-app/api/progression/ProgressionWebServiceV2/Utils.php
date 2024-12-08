<?php

namespace ProgressionWebService;

class Utils {
    /**
     * Convertit une date en format DateTime
     */
    public static function toDateTime($date) {
        if ($date instanceof \DateTime) {
            return $date;
        }
        if (is_string($date)) {
            return new \DateTime($date);
        }
        return null;
    }

    /**
     * Crée une SoapVar pour les paramètres de type string
     */
    public static function createStringParam($value) {
        return new \SoapVar($value, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema');
    }

    /**
     * Crée une SoapVar pour les paramètres de type integer
     */
    public static function createIntParam($value) {
        return new \SoapVar($value, XSD_INTEGER, 'integer', 'http://www.w3.org/2001/XMLSchema');
    }

    /**
     * Crée une SoapVar pour les paramètres de type float
     */
    public static function createFloatParam($value) {
        return new \SoapVar($value, XSD_FLOAT, 'float', 'http://www.w3.org/2001/XMLSchema');
    }

    /**
     * Crée une SoapVar pour les paramètres de type boolean
     */
    public static function createBoolParam($value) {
        return new \SoapVar($value, XSD_BOOLEAN, 'boolean', 'http://www.w3.org/2001/XMLSchema');
    }

    /**
     * Formate une réponse de tâche en format standard
     */
    public static function formatTaskResponse($task) {
        if (!$task) {
            return null;
        }

        return [
            'code' => $task->getCode(),
            'summary' => $task->getSummary(),
            'description' => $task->getDescription(),
            'date' => $task->getRv() ? $task->getRv()->format('Y-m-d H:i:s') : null,
            'client' => [
                'name' => $task->getClientRef() ? $task->getClientRef()->getLabel() : null,
                'phone' => self::getCustomProperty($task, 'phone'),
                'address' => self::getCustomProperty($task, 'address'),
                'city' => self::getCustomProperty($task, 'city')
            ],
            'task' => [
                'id' => $task->getCode(),
                'title' => $task->getSummary(),
                'description' => $task->getDescription(),
                'price' => $task->getTaskItemList() ? $task->getTaskItemList()->getTotal() : 0
            ]
        ];
    }

    /**
     * Récupère une propriété personnalisée d'une tâche
     */
    private static function getCustomProperty($task, $propertyName) {
        if (!$task->getProperties() || !$task->getProperties()->getProperty()) {
            return null;
        }

        foreach ($task->getProperties()->getProperty() as $property) {
            if ($property->getName() === $propertyName) {
                return $property->getValue();
            }
        }

        return null;
    }
}

?>