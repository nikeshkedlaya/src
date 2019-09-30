<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahosessionhandler
 *
 * @author KaHO
 */
class Kahosessionhandler extends SessionHandler
{

    // put your code here
    public function __construct()
    {}

    public function read($sessionId)
    {
        return parent::read($sessionId);
    }

    public function write($sessionId, $data)
    {
        return parent::write($sessionId, $data);
    }

    public function gc($maxLifeTime)
    {
        Kahoutility::iterateThroughSessionUploadedAttachement([
            $this,
            "deleteUploadedAttachement"
        ]);
        return parent::gc($maxLifeTime);
    }

    public function deleteUploadedAttachement($uploadedAttachmentObj)
    {
        if (Kahoutility::isStringParamValid($uploadedAttachmentObj[ATTACHMENT_NAME_PATH_KEY])) {
            Kahoutility::deleteFile($uploadedAttachmentObj[ATTACHMENT_NAME_PATH_KEY]);
        }
    }

    public function destroy($sessionId)
    {
        return parent::destroy($sessionId);
    }
}
