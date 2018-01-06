<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aServico')){ ?>
    <a href="<?php echo base_url()?>index.php/servicos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Novo serviço</a>

<a data-toggle="modal" href="#categoria" class="btn btn-success"><i class="icon-plus icon-white"></i> Nova categoria</a>
<?php } ?>

<?php

if(!$results){?>

    <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-wrench"></i>
         </span>
        <h5>Serviços e habilidades</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Código</th>
            <th>Categoria</th>
            <th>Nome</th>
            <th>Preço</th>
            
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="5">Nenhum Serviço Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>



<?php }
else{ ?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-wrench"></i>
         </span>
        <h5>Serviços e habilidades</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Código</th>
            <th>Categoria</th>
            <th>Nome</th>
            <th>Preço</th>
            
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->idServicos.'</td>';
    echo '<td>'.$r->categoria.'</td>';
            echo '<td>'.$r->nome.'</td>';
            echo '<td>'.number_format($r->preco,2,',','.').'</td>';
        
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eServico')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/servicos/editar/'.$r->idServicos.'" class="btn btn-info tip-top" title="Editar Serviço"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dServico')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" servico="'.$r->idServicos.'" class="btn btn-danger tip-top" title="Excluir Serviço"><i class="icon-remove icon-white"></i></a>  '; 
            }    
                      
                      
            echo '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
        



<?php echo $this->pagination->create_links();}?>


<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/servicos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Serviço</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idServico" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este serviço?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>

<div id="categoria" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Categorias</h5>
  </div>
  <div class="modal-body">
      <form id="formServicos" action="<?php echo base_url() ?>index.php/servicos/adicionarCategoria" method="post">
      <div class="span12">
            <label>Nome categoria <input type="text" class="span6" name="categoria" id="categoria"  />
                </label>
          <button class="btn btn-success span4"><i class="icon-white icon-plus"></i> Adicionar</button>
          </div>
      
      <div class="span12" id="divCategoria" style="margin-left: 0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Categoria</th>
                                              
                                                
                                                <th>Ações</th>
                                                
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
     $sql= "select * from categoria";
        $query = $this->db->query($sql);
        $result = $query->result();
        

                                        
                                        foreach ($result as $s) {
                                           
                                            echo '<tr>';
                                            echo '<td>'.$s->nomecategoria.'</td>';
                                        
                                            echo '<td><span idAcao="'.$s->idcategoria.'" title="Excluir Categoria" class="btn btn-danger"><i class="icon-remove icon-white"></i></span></td>';
                                           
                                            echo '</tr>';
                                        }?>

                                       
                                        </tbody>
                                    </table>
                                </div>
      </form>
  </div>
  <div class="modal-footer">
    
  </div>
 
</div>








<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var servico = $(this).attr('servico');
        $('#idServico').val(servico);

    });
    
    $(document).on('click', 'span', function(event) {
            var idcategoria = $(this).attr('idAcao');
            if((idcategoria % 1) == 0){
               $("#divCategoria").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/servicos/deletecategoria",
                  data: "idcategoria="+idcategoria,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divCategoria").load("<?php echo current_url();?> #divCategoria" );

                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir categoria.');
                    }
                  }
                  });
                  return false;
            }

       });

});

</script>