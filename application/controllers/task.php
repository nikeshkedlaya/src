<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 15 Nov, 2014 11:40:50 AM
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
// namespace kaholabs
class Task extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("task/taskservice");
    }

    public function getTaskList()
    {
        $this->taskservice->getTaskList();
    }

    public function getTaskHistory()
    {
        $this->taskservice->getTaskHistory();
    }

    public function taskAdd()
    {
        $this->taskservice->taskAdd();
    }

    public function getTaskPriorityList()
    {
        $this->taskservice->getTaskPriorityList();
    }

    public function taskEditDetails()
    {
        $this->taskservice->taskEditDetails();
    }

    public function taskDelete()
    {
        $this->taskservice->taskDelete();
    }

    public function taskUpdate()
    {
        $this->taskservice->taskUpdate();
    }
}
