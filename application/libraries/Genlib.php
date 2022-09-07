<?php
defined('BASEPATH') OR exit('Access Denied');

class Genlib {
    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }
    /**
     *
     * @return string
     */
    public function checkLogin() {
        if (empty($_SESSION['u_id']) || session_status() !== PHP_SESSION_ACTIVE ) {
            //redirect to log in page
            redirect(base_url('login')); //redirects to login page
        }else {
            return "";
        }
    }

    public function ajaxOnly(){
       //display uri error if request is not from AJAX
       if(!$this->CI->input->is_ajax_request()){
           redirect(base_url());
       }

       else{
           return "";
       }
   }

}
