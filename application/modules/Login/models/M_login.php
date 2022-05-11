<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    function prosesLogin($username){
        $this->db_logistik_pt->where('username',$username);
        
        return $this->db_logistik_pt->get('usr')->row();
    }

    function viewDataByID($username){
        $query = $this->db_logistik_pt->where('username',$username);
        $q = $this->db_logistik_pt->get('usr');
        $data = $q->result();
        
        return $data;
    }


}

/* End of file M_login.php */

?>