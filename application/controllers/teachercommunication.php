<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 12 Jan, 2015 5:49:34 PM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
class Teachercommunication extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("communicationservice");
    }

    public function getTeacherConversationMail()
    { // for getting the mail thread conversation between the user
        $this->communicationservice->getConversationMail();
    }

    public function addMailDetail()
    {
        $this->communicationservice->addMailDetail();
    }

    public function replyMail()
    {
        $this->communicationservice->replyMail();
    }

    public function getTeacherInboxMail()
    {
        $this->communicationservice->getInboxMail();
    }

    public function getTeacherSentMail()
    { // for getting the communication sent mail items list whe teachers login
        $this->communicationservice->getSentMail();
    }

    public function uploadMailAttachment()
    {
        $this->communicationservice->uploadMailAttachment();
    }

    public function getMailRecipients()
    {
        $this->communicationservice->getMailRecipients();
    }
}
