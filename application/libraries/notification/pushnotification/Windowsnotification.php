<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Androidnotification
 *
 * @author Quadir
 */
include_once 'Abstractpushnotification.php';

class Windowsnotification extends Abstractpushnotification {

    //put your code here
    private $endpoint;
    private $hubPath;
    private $sasKeyName;
    private $sasKeyValue;
    private $curlUri;

    const API_VERSION = "?api-version=2013-10";

    public function __construct($ciLibrary, $deviceID, $notificationData) {
        parent::__construct($ciLibrary, $notificationData, $deviceId);
        $this->notificationData = $notificationData;
        $this->hubPath = $this->getPlatformSpecificConfiguration['hub_path'];
//        $this->parseConnectionString($this->getPlatformSpecificConfiguration['connection_string']);
        $this->curlUri = $this->endpoint . $this->hubPath . "/messages" . NotificationHub::API_VERSION;
    }

    public function buildNotificationDataTemplate() {
        $toast = "--simple-boundary\nContent-type: text/xml\nContent-Disposition: inline; name=notification\n\n<toast><visual><binding template=\"ToastText01\"><text id=\"1\">Hello there!</text></binding></visual></toast>\n--simple-boundary\nContent-type: application/json\nContent-Disposition: inline; name=devices\n\n['https://db5.notify.windows.com/?token={AwYAAADBMYoppxXQMeANGfnQPKUNGZfRcDW%2bikm7UnP5zbHbT5tSUL4AvVWHm%2b0Ulvte%2fUVbM1dmHVCYhQIvdSGw6fmiKe1U6%2f08djRQLL0rKi7MZxGa%2bbDJKvLpR3zjoV2z7YM%3d}','https://db5.notify.windows.com/?token={AwYAAADZHlMkf4cYUbUEck%2fCyOgrXrRcdEydU7A3YdWlajHVquudSQZUmLmqheJEVHbVSIGUqOv4Dfd5JYj7O4THNlbkgBwSSfOsBr%2fCIJHQjXZ0%2b8B1CnuZYADsBa6uhdY9IBU%3d}','https://db5.notify.windows.com/?token={AwYAAAAUA%2fwY7d3wFe32dppPPZjjYj340WdkVSxhDHEAYAieSQyupnswcSb%2blFqNRq8WokmuA9VSbak3nJjlRwcqeYecYlex8%2fEpR7FPHND3NtIKel5X%2f7386%2bpUvLELkT6sulU%3d}']\n--simple-boundary--";
        return $toast;
    }

    public function buildPayload() {
        
    }

    public function getPostData() {
        $postData = $this->buildNotificationDataTemplate();
        return json_encode($postData);
    }

    public function getHeaders() {
        $headers = ['Authorization: ' . $this->generateSasToken($this->curlUri), 'Content-Type: multipart/mixed; boundary = \"simple-boundary\"', 'ServiceBusNotification-Format: windows', 'X-WNS-Type: wns/toast'];
    }

    protected function generateSasToken($uri) { // would be used to send the sastoken as header in wns 
        $uri = $this->endpoint . $this->hubPath . "/messages" . NotificationHub::API_VERSION;
        $targetUri = strtolower(rawurlencode(strtolower($uri)));
        $expires = time();
        $expiresInMins = 60;
        $expires = $expires + $expiresInMins * 60;
        $toSign = $targetUri . "\n" . $expires;

        $signature = rawurlencode(base64_encode(hash_hmac('sha256', $toSign, $this->sasKeyValue, TRUE)));

        $token = "SharedAccessSignature sr=" . $targetUri . "&sig="
                . $signature . "&se=" . $expires . "&skn=" . $this->sasKeyName;

        return $token;
    }

    private function parseConnectionString($connectionString) {
        $parts = explode(";", $connectionString);
        if (sizeof($parts) != 3) {
            throw new Exception("Error parsing connection string: " . $connectionString);
        }
        foreach ($parts as $part) {
            if (strpos($part, "Endpoint") === 0) {
                $this->endpoint = "https" . substr($part, 11);
            } else if (strpos($part, "SharedAccessKeyName") === 0) {
                $this->sasKeyName = substr($part, 20);
            } else if (strpos($part, "SharedAccessKey") === 0) {
                $this->sasKeyValue = substr($part, 16);
            }
        }
    }

    public function sendWindowsNotification($notification) {
        if ($this->getPlatformSpecificConfiguration['isNotificationEnabled'] === "yes") {
            $this->callHTTP($this->curlUri, $this->getHeaders(), $this->getPostData());
        }
    }

    public final function sendNotification() {
        
    }

}
