<?php
/*
    Author: Patiphan Pansanga 
    Create: 2022-09-07
*/
defined('BASEPATH') OR exit('Access Denied');

class Genlib {
    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }

    public function checkLogin() {
        if (empty($_SESSION['u_id']) || session_status() !== PHP_SESSION_ACTIVE ) {
            redirect(base_url('login')); //redirects to login page
        }else {
            return "";
        }
    }

    public function updateSession($data) {
        $_SESSION['u_fullname'] = $data->u_firstname . " " . $data->u_lastname;
		$_SESSION['u_role'] = $data->u_role;
		$_SESSION['u_status'] = $data->u_status;
        if($_SESSION['u_status'] != 1) {
            session_destroy();
            redirect(base_url());
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
