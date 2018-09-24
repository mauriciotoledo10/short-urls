<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
    //chamando nosso método construtor
    function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
}