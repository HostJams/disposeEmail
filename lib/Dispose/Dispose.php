<?php
/**
 * Created by PhpStorm.
 * User: Kemoy
 * Date: 7/23/2015
 * Time: 4:24 PM
 */


namespace Dispose;
class Dispose
{
    private $error;
    private $action;
    private $domain;
    private $api_response;

    private function _construct($action,$domain)
    {
        $this->error = 'init';
        $this->domain = $domain;
        $this->action = $action;
    }


    /**
     * Extract the domain from the email and set the domain
     * returns those as an array.
     * @param string $email 'user@domain'
     */
    private function extract_domain($email)
    {
        $parts = explode('@', $email);
        $this->domain = array_pop($parts);
    }

    /**
     * The API call format
     */
    private function call_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $url = 'http://developer.hostjams.com/disposable/dispose.php?action='.$this->action.'&domain='.$this->domain;
        curl_setopt($ch, CURLOPT_URL,$url);
        $this->api_response = curl_exec($ch);
        curl_close($ch);

    }


    /**
     * submit a request to the api
     */
     public function submit($action,$email)
     {
         //getting the domain to query for
         $this->extract_domain($email);

         //initalizing
         $this->_construct($action,$this->domain);

         $this->call_api();
     }

    /**
     * get the result from the api in Json format
     */
    public function getApi_responseJson()
    {
       //print_r($this->api_response);

        return $this->api_response;

    }

    /**
     * get the result from the api in array format
     */

    public function getApi_responseArray()
    {
        //print_r(json_decode($this->api_response,true));
        return json_decode($this->api_response,true);
    }

    /**
     * get the status header status response
     */
    public function getHeaderStatus()
    {
        $status = json_decode($this->api_response,true);
        echo $status['status'];
    }



}