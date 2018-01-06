<?php

class Servicos extends CI_Controller {


    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */

    function __construct() {
        parent::__construct();
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('mapos/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('servicos_model', '', TRUE);
        $this->data['menuServicos'] = 'Serviços';
    }

	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vServico')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar serviços.');
           redirect(base_url());
        }

        $this->load->library('pagination');


        $config['base_url'] = base_url().'index.php/servicos/gerenciar/';
        $config['total_rows'] = $this->servicos_model->count('servicos');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

		$this->data['results'] = $this->servicos_model->get('servicos','idServicos,nome,categoria,comissao,preco','',$config['per_page'],$this->uri->segment(3));

	    $this->data['view'] = 'servicos/servicos';
       	$this->load->view('tema/topo',$this->data);



    }

    function adicionarCategoria(){
            
        $data =array(
           'nomecategoria' =>set_value ('categoria')
        
        );
           
    if($this->servicos_model->addcategoria($data)){
        
        redirect(base_url() . 'index.php/servicos');
    }
        else{
            redirect(base_url() . 'index.php/servicos');
        }
        redirect(base_url() . 'index.php/servicos');
    }
    
    function deleteCategoria(){
        
         $ID = $this->input->post('idcategoria');
            if($this->servicos_model->deletecategoria('categoria','idcategoria',$ID) == true){

                echo json_encode(array('result'=> true));
            }
            else{
                echo json_encode(array('result'=> false));
            }
    }
    
    
   function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aServico')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar serviços.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('servicos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",","", $preco);
            $comissao = $this->input->post('comissao');
            $comissao = str_replace(",","", $comissao);

            $data = array(
                'nome' => set_value('nome'),
                'preco' => $preco,
                'comissao'=>$comissao,
                'categoria' => set_value('categoria'),
                'comissaoporcentagem'=>set_value('comissaoporcentagem')
            );

            if ($this->servicos_model->add('servicos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Serviço adicionado com sucesso!');
                redirect(base_url() . 'index.php/servicos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
       $this->data['categoria'] = $this->servicos_model->getLista();
        $this->data['view'] = 'servicos/adicionarServico';
        $this->load->view('tema/topo', $this->data);

    }
    
    public function show_categoria()
	{
		$query=$this->db->get('categoria');
        $result= $query->result();
        $data=array();
		foreach($result as $r)
		{
			$data['value']=$r->idcategoria;
			$data['label']=$r->nomecategoria;
			$json[]=$data;
			
			
		}
		echo json_encode($json);
		

	
	}

    
     function lista(){
    $this->load->model("servicos_model");

$categoria = $this->servicos_model->retorna_categoria();

$option = "<option value=''></option>";
foreach($categoria -> result() as $linha) {
$option .= "<option value='$linha->idcategoria'>$linha->nomecategoria</option>";
}

$variaveis['options_categoria'] = $option;

$this->load->view('adicionarServico', $variaveis);

}
    function editar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eServico')){
           $this->session->set_flashdata('error','Você não tem permissão para editar serviços.');
           redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('servicos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",","", $preco);
        //    $comissao = $this->input->post('comissao');
           // $comissao = str_replace(",","", $comissao);
            $data = array(
                'nome' => $this->input->post('nome'),
                'categoria' => $this->input->post('categoria'),
                //'comissao'=> $comissao,
                'preco' => $preco
            );

            if ($this->servicos_model->edit('servicos', $data, 'idServicos', $this->input->post('idServicos')) == TRUE) {
                $this->session->set_flashdata('success', 'Serviço editado com sucesso!');
                redirect(base_url() . 'index.php/servicos/editar/'.$this->input->post('idServicos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->servicos_model->getById($this->uri->segment(3));
$this->data['categoria'] = $this->servicos_model->getLista();
        $this->data['view'] = 'servicos/editarServico';
        $this->load->view('tema/topo', $this->data);

    }
   

    function excluir(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dServico')){
           $this->session->set_flashdata('error','Você não tem permissão para excluir serviços.');
           redirect(base_url());
        }


        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir serviço.');
            redirect(base_url().'index.php/servicos/gerenciar/');
        }

        $this->db->where('servicos_id', $id);
        $this->db->delete('servicos_os');

        $this->servicos_model->delete('servicos','idServicos',$id);


        $this->session->set_flashdata('success','Serviço excluido com sucesso!');
        redirect(base_url().'index.php/servicos/gerenciar/');
    }
}
