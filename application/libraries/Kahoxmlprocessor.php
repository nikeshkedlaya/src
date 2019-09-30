<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Converttoxml
 *
 * @author KaHO
 */
class Kahoxmlprocessor
{

    // put your code here
    public static function convertJSONStringToXML($input, array $keysToExtractContainer = null): string
    {
        $convertedXMLStr = "";
        if (empty($input) === FALSE) {
            if (! Kahoutility::checkArrayParam($input) && Kahoutility::isStringParamValid($input)) {
                $input = Kahoutility::convertJSONStrToArray($input);
            }
            $convertedXMLStr = self::convertArrayToXML($input, $keysToExtractContainer);
        }
        return $convertedXMLStr;
    }

    public static function extractValFromArrayWrapper(array $input, array $keysToExtractContainer = null)
    {
        $extractedValFromArray = NULL;
        if (Kahoutility::checkArrayParam($input)) {
            $extractedValFromArray = array_map(function ($val) use ($keysToExtractContainer) {
                return self::extractValFromArrayObjByKey($val, $keysToExtractContainer);
            }, $input);
        }
        return $extractedValFromArray;
    }

    // <editor-fold defaultstate="collapsed" desc="extractKeyFromArrayObj">
    /**
     * desc will extract the specified key from given array object and return a new array
     */
    public static function extractValFromArrayObjByKey(array $arrayObj, array $keysToExtractContainer = null): array
    {
        $extractValArray = [];
        try {
            if (Kahoutility::checkArrayParam($keysToExtractContainer)) {
                foreach ($keysToExtractContainer as $keyName) {
                    $extractValArray[$keyName] = $arrayObj[$keyName] ?? "";
                }
            } else {
                $extractValArray = $arrayObj;
            }
        } catch (Exception $exc) {} finally {
            return $extractValArray;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="convertArrayToXML">
    /**
     * desc will convert the array to xml
     */
    public static function convertArrayToXML($arrayData, array $keysToExtractContainer = null): string
    {
        $convertedArrayToXML = "";
        try {
            if (Kahoutility::checkArrayParam($arrayData)) {
                $xml = new SimpleXMLElement("<Root/>");

                function buildXMLElement(array $arrayData, SimpleXMLElement &$xmlObject, string $nodeKey = NULL, array $keysToExtractContainer = null)
                {
                    foreach ($arrayData as $key => $value) {
                        if (! is_array($value)) {
                            if (Kahoutility::checkArrayParam($keysToExtractContainer)) {
                                if (array_search($key, $keysToExtractContainer) !== false) {
                                    $xmlObject->addChild($key, $value);
                                }
                            } else {
                                $xmlObject->addChild($key, $value);
                            }
                        } else {
                            if (is_numeric($key)) {
                                $subNode = $xmlObject->addChild($nodeKey);
                                buildXMLElement($value, $subNode, $nodeKey, $keysToExtractContainer);
                            } else {
                                $nodeKey = $key;
                                buildXMLElement($value, $xmlObject, $nodeKey, $keysToExtractContainer);
                            }
                        }
                    }
                }
                
                buildXMLElement($arrayData, $xml, null, $keysToExtractContainer);
                $convertedArrayToXML = $xml->asXML();
                $convertedArrayToXML = str_replace("<?xml version=\"1.0\"?>", "", $convertedArrayToXML);
            }
        } catch (Exception $exc) {} finally {
            return $convertedArrayToXML;
        }
    }
    
    // </editor-fold>
}
