<?php
/**
 * Created by PhpStorm.
 * User: Kemoy
 * Date: 7/23/2015
 * Time: 5:38 PM
 */

require_once __DIR__.'/vendor/autoload.php';

use Dispose\Dispose;

$api = new Dispose();

$action = 'request';
$email = 'kemoy@rit.edu';
$api->submit($action,$email);
$api->getApi_response();

