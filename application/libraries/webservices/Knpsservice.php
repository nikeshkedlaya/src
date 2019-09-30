<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acknowledgementservice
 *
 * @author KaHO
 */
class Knpsservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
        $this->kahoCrudServices->loadDatabaseByKey("knps_phagwara");
        $this->ciLibrary->load->library("email");
    }

    public function generateTeacherDairySubmissionReport() {
        $params = ["Date" => $this->getYestardayDate()];
        $resp = $this->kahoCrudServices->getRecord("sGenerateTeacherDairySubmissionReport", $params)->getResponse();
        return $resp;
    }

    public function generateAttenanceReport() {
        $params = ["Date" => $this->getYestardayDate()];
        $resp = $this->kahoCrudServices->getRecord("sGenerateAttenanceReport", $params)->getResponse();
        return $resp;
    }

    private function getYestardayDate() {
        return date("d/m/Y", strtotime("-1 days"));
    }

    public function generateAllReport() {
        $generateReportFunctionContainer = ["generateTeacherDairySubmissionReport", "generateAttenanceReport"];
        $self = $this;
        return array_map(function($functionName) use($self) {
            $generatedReportResponse = call_user_func([$self, $functionName]);
            if (kahoutility::checkArrayParam($generatedReportResponse)) {
                $generatedReportFileName = $generatedReportResponse[0]["concat(_file_name,'.csv')"];
                $workingDir = kahoutility::getClientWD(WORKING_DIRECTORY_WEB_KEY, "knps");
                copy("/tmp/" . $generatedReportFileName, $workingDir . "/" . $generatedReportFileName);
                return $workingDir . "/" . $generatedReportFileName;
            }
        }, $generateReportFunctionContainer);
    }

    public function sendEmail() {
        $this->ciLibrary->email->from($this->emailFrom(), "KaHO Labs")
                ->to($this->emailTo())
                ->cc($this->cc())
                ->subject("Attendance and Teacher Diary Submission Report")
                ->message("here is the teacher diary and attendance submission report for the " . $this->getYestardayDate());
        $attachmentReport = $this->generateAllReport();
        foreach ($attachmentReport as $val) {
            $this->ciLibrary->email->attach($val);
        }
        $result =  $this->ciLibrary->email->send();

        // var_dump($result);
        // echo '<br/>';
        // echo $this->ciLibrary->email->print_debugger();
    }

    public function emailFrom() {
        $this->ciLibrary->load->config("email");
        $emailFrom = $this->ciLibrary->config->item("email")['smtp_user'];
        return $emailFrom;
    }

    public function emailTo() {
        // return "sandeep@kaholabs.com";
		return "knpsweb@gmail.com";
    }

    public function cc() {
        return "knps_ch@yahoo.com,knpsweb@gmail.com,charuchhabra3@gmail.com,vikram@kaholabs.com,nikesh@kaholabs.com";
        // return "vikram@kaholabs.com,nikesh@kaholabs.com";
    }

}
