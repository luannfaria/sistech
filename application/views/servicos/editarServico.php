<div class="row-fluid" style="margin-top:0">
                              <div class="span12">
                                    <div class="widget-box">
                                          <div class="widget-title">
                                                <span class="icon">
                                                      <i class="icon-align-justify"></i>
                                                </span>
                                                <h5>Editar Serviço</h5>
                                          </div>
                                          <div class="widget-content nopadding">
                                                <?php echo $custom_error; ?>
                                              
                                              
                                               <form action="<?php echo current_url(); ?>" id="formServico" method="post" class="form-horizontal" >
                    <div class="span12" style="padding: 3%">
                         <?php echo form_hidden('idServicos',$result->idServicos) ?>
                       
                        <div class="span7">
                             <label for="nome">Nome do serviço
                            <input id="nome" class="span10" type="text" name="nome" value="<?php echo $result->nome ?>"  />
                                 </label>
                        </div>
                        
                             <div class="span4">
                                   <label for="categoria">Categoria</label>
                                      <select id="categoria" class="span12" name="categoria" value="<?php echo $result->categoria ?>">
                                        <?php foreach($categoria as $linha): ?>
                                          <option value="<?php echo $linha->nomecategoria?>"> <?php echo $linha->nomecategoria?></option>
                                         
                                          <?php endforeach; ?>
                                         
                                         
                                        </select>
                      
                        </div>
                        
                        
                    </div>
                  
                    <div class="span12" style="padding:3%">
                        
                          <div class="span4">
                        <label for="preco" >Preço
                       
                            <input  id="preco" class="span5 money" type="text" name="preco" value="<?php echo $result->preco ?>"  /></label>
                        
                    </div>
                        
                        <div class="span4">
                            <label for="comissao" >Comissão fixa
                            <input id="comissao" class="span5 money" type="text" name="comissao" value="<?php echo $result->comissao ?>"  /></label>
                        </div>
                         <div class="span4">
                            <label for="comissaoporcentagem" >Comissão %
                            <input id="comissaoporcentagem" pattern="[0-9]*" class="span5" type="number" name="comissaoporcentagem" value="<?php echo $result->comissaoporcentagem ?>"  /></label>
                        </div>
                    </div>
                   

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                 <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                                            <a href="<?php echo base_url()?>index.php/servicos" id="btnAdicionar" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
                                          </div>
                                    </div>
                              </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
          $(".money").maskMoney();
           $('#formServico').validate({
            rules :{
                  nome:{ required: true},
                  preco:{ required: true}
            },
            messages:{
                  nome :{ required: 'Campo Requerido.'},
                  preco :{ required: 'Campo Requerido.'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });
      });
</script>



