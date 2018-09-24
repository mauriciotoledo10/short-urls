<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Urls extends CI_Controller {
    
    //adicionando um método construtor
    function __construct(){
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    //index
    public function Index()
    {
    $this->form_validation->set_rules('address','URL','required|min_length[5]|max_length[1000]|trim');
    
    if($this->form_validation->run() == FALSE){
        $data['error'] = validation_errors();
        $data['short_url'] = false;
    }else{
        $this->load->model('Urls_model');
        $data['address'] = $this->input->post('address');
        if($this->session->userdata('logged'))
        $data['user_id'] = $this->session->userdata('id');
        $res = $this->Urls_model->Save($data);
        
        //retorna o código da URL caso ela tenha sido gravada
        if($res){
            $data['error'] = null;
            $data['short_url'] = base_url($res);
        }else{
            $data['error'] = "Não foi possível encurtar a URL.";
            $data['short_url'] = false;
        }
    }
    //chamando a view home
    $this->load->view('home',$data);
    }

    //método responsável por redirecionar a URL curta para a URL original.
    public function Go(){
        if (!$this->uri->segment(1)) {
            redirect(base_url());
        } else {
            $code = $this->uri->segment(1);
            $this->load->model('Urls_model');
            $result = $this->Urls_model->Fetch($code);
            if ($result) {
                redirect(prep_url($result));
            } else {
                $data['error'] = "URL não localizada.";
                $data['short_url'] = null;
                $this->load->view('home',$data);
            }
        }
    
    }


}