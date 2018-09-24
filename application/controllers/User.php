<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
    //chamando nosso método construtor
    function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
    
    //método principal de autenticação do usuário
    public function Login(){
        $this->form_validation->set_rules('email','Email','required|min_length[1]|valid_email|trim');
        $this->form_validation->set_rules('passw','Senha','required|min_length[6]|trim');
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        }else{
            $dataLogin = $this->input->post();
            $res = $this->User_model->Login($dataLogin);
            if($res){
                foreach($res as $result){
                    if (password_verify($dataLogin['passw'], $result->passw))
                    {
                        $data['error'] = null;
                        $this->session->set_userdata('logged',true);
                        $this->session->set_userdata('email',$result->email);
                        $this->session->set_userdata('id',$result->id);
                        redirect();
                    }else{
                         $data['error'] = "Senha incorreta.";
                        }
                    }
                }else{
                    $data['error'] = "Usuário não cadastrado.";
                }
            }
            //carregando a view de login
            $this->load->view('login',$data);
        }
    
    //método qe vai encerrar a sessão do usuário
    public function Logout(){
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id');
        redirect();
    }
}