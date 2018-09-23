<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
    //definindo nosso método construtor
    function __construct(){
        parent::__construct();
    }

    //método responsável por salvar os dados do usuário no banco de dados.
    function Save($data){
        $data['passw'] = password_hash($data['passw'], PASSWORD_DEFAULT);
        $this->db->insert('users',$data);
        $userID = $this->db->insert_id();

        if($userID){
            return $this->GetUser($userID);
        }else{
            return false;
    }
}
    
    //método responsável por recuperar dados do usuário cujo id foi passado como parâmetro
    public function GetUser($id){
        $this->db->select('*')->from('users')->where('id',$id);
        $result = $this->db->get()->result();
        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    //método responsável por atualizar os dados de um usuário no banco.
    function Update($data){
        $data['passw'] = password_hash($data['passw'], PASSWORD_DEFAULT);
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('users', $data);
    }

    //método que vai retornar os dados de um usuário que está tentando fazer login.
    function Login($data){
        $this->db->select('*')->from('users')->where('email',$data['email']);
        $results = $this->db->get()->result();
        return $results;
    }



}