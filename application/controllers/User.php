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

    //método executado para cadastro de um novo usuário
    public function Register(){
        $this->form_validation->set_rules('name','Nome','required|min_length[3]|trim');
        $this->form_validation->set_rules('email','Email','required|min_length[1]|valid_email|trim');
        $this->form_validation->set_rules('passw','Senha','required|min_length[6]|trim');
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        }else{
            $dataRegister = $this->input->post();
            $res = $this->User_model->Save($dataRegister);
            
            if($res){
                $data['error'] = null;
            }else{
                $data['error'] = "Não foi possível criar o usuário.";
            }
        }
        
        if($data['error'])
        $this->load->view('login',$data);
        
        else{
        $this->session->set_userdata('logged',true);
        $this->session->set_userdata('email',$res->email);
        $this->session->set_userdata('id',$res->id);
        redirect();
        }
    }
    
    //método que vai executar a mudança de senha do usuário
    public function UpdatePassw(){
        $data['success'] = null;
        $data['error'] = null;
        $this->form_validation->set_rules('passw','Senha','required|min_length[6]|trim');
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        }else{
            $data = $this->input->post();
            $this->User_model->Update($data);
            $data['success'] = "Senha alterada com sucesso!";
            $data['error'] = null;
        }
        $data['user'] = $this->User_model->GetUser($this->session->userdata('id'));
        
        //carrega a view de alteração de senha
        $this->load->view('alterar-senha',$data);
    }

    //método que listará todas as URLs encurtadas pelo usuário logado.
    public function URLs(){
        $this->load->model('Urls_model');
        $urls = $this->Urls_model->GetAllByUser($this->session->userdata('id'));
        $data['urls'] = $urls;
        $data['error'] = null;
        $data['short_url'] = false;
        //carregando a view de urls
        $this->load->view('minhas-urls',$data);
        }
}