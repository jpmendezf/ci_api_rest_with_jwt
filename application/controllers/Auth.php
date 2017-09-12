<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class Auth extends REST_Controller
{

    public function token_get()
    {
        $tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token
        $tokenData['nombre'] = 'Algo';
        $tokenData['op'] = true;
        $output = $this->token_generate($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    public function token_post()
    {
        $decodedToken = $this->token_is_valid();

        if ( $decodedToken != false )
        {
            $this->set_response($decodedToken, REST_Controller::HTTP_OK);
        }
        else
        {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
}