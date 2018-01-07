<a href="<?php echo base_url()?>index.php/funcionarios/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Profissional</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Profissionais</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
         <th>Codigo</th>
            <th>Nome</th>
            
            <th>Telefone</th>
            
            <th>Data admissão</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhum Profissional Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>


<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Profissionais</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Codigo</th>
            <th>Nome</th>
            
            <th>Telefone</th>
            
            <th>Data admissão</th>
           <th></th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->idfuncionarios.'</td>';
            echo '<td>'.$r->nomecompleto.'</td>';
            echo '<td>'.$r->telefone.'</td>';
            echo '<td>'.$r->dataadmissao.'</td>';
           
            echo '<td>
                      <a href="'.base_url().'index.php/funcionarios/editar/'.$r->idfuncionarios.'" class="btn btn-info tip-top" title="Editar Usuário"><i class="icon-pencil icon-white"></i></a>
                  </td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>

	
<?php echo $this->pagination->create_links();}?>
