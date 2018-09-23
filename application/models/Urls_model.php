<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Urls_model extends CI_Model{
    
    //definindo nosso método construtor
    function __construct(){
        parent::__construct();
    }

    //método que vai gerar o código único que representará a URL original.
    //é usado com um do while (condição) p/ verificar se o código alfanumérico de 8 dígitos gerado já foi
    //utilizado ou se está disponível. Enquanto o código gerado não for um código único, não haverá retorno....
    //essa é a função do (do while (condição))
    function GenerateUniqueCode(){
        do{
        $code = random_string('alnum',8);
        $this->db->from('urls')->where('code',$code);
        $num = $this->db->count_all_results();
        }while($num >= 1);
        return $code;
    }

    //método responsável por salvar no banco de dados as informações da URL que o usuário inseriu a retornar a URL curta.
    function Save($data){
        $data['code'] = $this->GenerateUniqueCode();
        $this->db->insert('urls',$data);
        if($this->db->insert_id()){
        return $data['code'];
        }else{
        return false;
        }
    }
}