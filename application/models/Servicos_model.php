<?php
class Servicos_model extends CI_Model {


    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */

    function __construct() {
        parent::__construct();
    }


    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idServicos','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
    
    function addcategoria($data)
    {
        $this->db->set($data);
    $this->db->insert($this->db->dbprefix . 'categoria');
        
		
    }
      public function retorna_categoria(){
         $sql = "SELECT idcategoria,nomecategoria from categoria";
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return $array;

}
    
    public function getLista (){
        $this->db->select('*');
        $this->db->from('categoria');
        return $this->db->get()->result();
    }
    
    
    function getById($id){
        $this->db->where('idServicos',$id);
        $this->db->limit(1);
        return $this->db->get('servicos')->row();
    }

    function add($table,$data){
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}

		return FALSE;
    }

    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}

		return FALSE;
    }

    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}

		return FALSE;
    }
    
    function deletecategoria($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}

		return FALSE;
    }
 

	function count($table){
		return $this->db->count_all($table);
	}
}
