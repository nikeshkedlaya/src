<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Buildjsmodule extends KaHO_Controller
{

    public $User;

    public function __construct()
    {
        parent::__construct();
    }

    public function getJsonUploadedFile()
    {
        if (isset($_FILES['jsfile']) && ! is_null($files = $_FILES['jsfile'])) {
            $fileName = $files['name'];
            $filePath = $files['tmp_name'];
            if (! strstr($fileName, ".") === ".json") {
                die("please upload a valid json file");
            }
            if (! move_uploaded_file($filePath, "assets/js_module_upload/" . $fileName)) {
                die("there is an error while uploading a valid json file");
            }
            $jsContent = file_get_contents("assets/js_module_upload/" . $fileName);
            if (Kahoutility::checkArrayParam($jsonArray = Kahoutility::convertJSONStrToArray($jsContent))) {
                $this->load->library("buildjsmodule/buildmodulelib", [
                    $jsonArray
                ]);
                $this->buildmodulelib->buildJSModule();
            } else {
                die("json string is not in proper format");
            }
        } else {
            die("either key name is not jsfile or attachment is not attached properly");
        }
    }
}
