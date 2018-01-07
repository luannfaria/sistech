
<?php
class Funcionarios extends CI_Controller {
    
    
    function __construct(){
        
        parent::__construct();
         if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('mapos/login');
        }
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cFuncionario')){
          $this->session->set_flashdata('error','Você não tem permissão para configurar os funcionarios.');
          redirect(base_url());
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('funcionarios_model', '', TRUE);
        $this->data['menuFuncionarios'] = 'Funcionarios';
        $this->data['menuConfiguracoes'] = 'Configurações';
    }
    
    function index(){
        $this->gerenciar();
    }
    
    
    function gerenciar(){
        
        $this->load->library('pagination');
        

        $config['base_url'] = base_url().'index.php/funcionarios/gerenciar/';
        $config['total_rows'] = $this->funcionarios_model->count('funcionarios');
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

		$this->data['results'] = $this->funcionarios_model->get($config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'funcionarios/funcionarios';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
    
    function adicionar(){  
          
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('funcionarios') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {     

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $data = array(
                    'nomecompleto' => set_value('nomecompleto'),
                'nomefuncionario' => set_value('nomefuncionario'),
                'dataadmissao' => set_value('admissao'),
					'rg' => set_value('rg'),
					'cpf' => set_value('cpf'),
					'rua' => set_value('rua'),
					'numero' => set_value('numero'),
					'bairro' => set_value('bairro'),
					'cidade' => set_value('cidade'),
					'estado' => set_value('estado'),
					'telefone' => set_value('telefone'),
					'celular' => set_value('celular'),
                    'coragenda'=>set_value('cor'),
					'situacao' => set_value('situacao')

					
            );
           
			if ($this->funcionarios_model->add('funcionarios',$data) == TRUE)
			{
                                $this->session->set_flashdata('success','Funcionario cadastrado com sucesso!');
				redirect(base_url().'index.php/funcionarios/adicionar/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

			}
		}
        
  
		$this->data['view'] = 'funcionarios/adicionarFuncionario';
        $this->load->view('tema/topo',$this->data);
   
       
    }
    
     function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para editar clientes.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('funcionarios') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomecompleto' => $this->input->post('nomecompleto'),
                'nomefuncionario' => $this->input->post('nomefuncionario'),
                'telefone' => $this->input->post('telefone'),
                'celular' => $this->input->post('celular'),
                'coragenda' => $this->input->post('coragenda'),
               'dataadmissao' => $this->input->post('admissao'),
                'rua' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'bairro' => $this->input->post('bairro'),
                'cidade' => $this->input->post('cidade'),
                'estado' => $this->input->post('estado')
                
            );

            if ($this->funcionarios_model->edit('funcionarios', $data, 'idfuncionarios', $this->input->post('idfuncionarios')) == TRUE) {
                $this->session->set_flashdata('success','Funcionario editado com sucesso!');
                redirect(base_url() . 'index.php/funcionarios/editar/'.$this->input->post('idfuncionarios'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->funcionarios_model->getById($this->uri->segment(3));
        $this->data['view'] = 'funcionarios/editarfuncionario';
        $this->load->view('tema/topo', $this->data);

    }
}

?>