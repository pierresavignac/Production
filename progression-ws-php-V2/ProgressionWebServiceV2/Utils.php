<?php

namespace ProgressionWebService;

use ProgressionWebService\Property;
use ProgressionWebService\ArrayOfProperty;

class Utils
{
    /**
     * Initialize a ProgressionPortType service correctly configured
     *
     * @param string $hostname The server hostname to connect to!
     * @returns ProgressionPortType
     */
    public static function initWebService($hostname = "") {
        $serverUrl = 'https://' . $hostname;
        $serviceUrl = $serverUrl . '/server/ws/v1/ProgressionWebService';
        $wsdlUrl = $serviceUrl . '?wsdl';
        $service = new ProgressionPortType(array(), $wsdlUrl);
        $service->__setLocation($serviceUrl);
        return $service;
    }

    /**
     * Set a single Property in an ArrayOfProperty
     *
     * @param ArrayOfProperty $arrayOfProperty The list of properties
     * @param string $name The name of the property to add
     * @param string $value The value to set
     */
    public static function setProperty(ArrayOfProperty $arrayOfProperty, $name = "", $value = "") {
        $property = (new Property())->setName($name);
        $exists = false;
        if ($arrayOfProperty == null)
            $arrayOfProperty = new ArrayOfProperty();
        $properties = $arrayOfProperty->getProperty();
        if ($properties == null) {
            $properties = array();
            $arrayOfProperty->setProperty($properties);
        } else {
            // Check if already exists!!!
            foreach ($properties as $prop) {
                if ($prop->getName() == $name) {
                    $property = $prop;
                    $exists = true;
                    break;
                }
            }
        }
        $property->setValue(new SoapVar($value, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'));
        if (!$exists)
            array_push($properties, $property);
        return $arrayOfProperty;
    }

    /**
     * Set multiple properties in an ArrayOfProperty
     *
     * @param ArrayOfProperty $arrayOfProperty The array of properties to put properties into.
     * @param array $properties The array of properties to set. ex.:
     *
     * array(
     *   "name1" => "value1"
     *   "name2" => "value2"
     * );
     */
    public static function setProperties(ArrayOfProperty $arrayOfProperty, array $properties) {
        if ($arrayOfProperty == null)
            $arrayOfProperty = new ArrayOfProperty();
        $propnames = array_keys($properties);
        foreach ($propnames as $propname) {
            Utils::setProperty($arrayOfProperty, $propname, $properties[$propname]);
        }
        return $arrayOfProperty;
    }

    /**
     * Set multiple Properties in the ArrayOfProperty of a Record
     *
     * @param Record $record The record to set properties in.
     * @param array $properties The array of properties to set. ex.:
     *
     * array(
     *   "name1" => "value1"
     *   "name2" => "value2"
     * );
     */
    public static function setRecordProperties(Record $record, array $properties) {
        $arrayOfProperty = $record->getProperties();
        if ($arrayOfProperty == null) {
            $arrayOfProperty = new ArrayOfProperty();
            $record->setProperties($arrayOfProperty);
        }
        Utils::setProperties($arrayOfProperty, $properties);
    }
}

?>