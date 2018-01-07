<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Funcionario</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formFuncionario" method="post" class="form-horizontal">

                    <div class="span12" style="padding: 3%">
                        <div class="span7">
                            <label for="nomefuncionario">Nome ou apelido<span class="required" style="text-transform:uppercase">*</span>
                        
                            <input id="nomefuncionario" type="text" class="span8" name="nomefuncionario" value="<?php echo set_value('nomefuncionario'); ?>"  /></label>

                        </div>
                        
                        <div class="span5">
                            <label for="admissao">Admissão
                        
                            <input id="admissao" type="date" class="span7" name="admissao" value="<?php echo set_value('admissao'); ?>"  /></label>

                        </div>

                    </div>

                    <div class="span12" style="padding: 1%">
                        <div class="span12">
                            <label for="nome">Nome completo<span class="required" style="text-transform:uppercase">*</span>
                        
                            <input id="nomecompleto" type="text" class="span7" name="nomecompleto" value="<?php echo set_value('nomecompleto'); ?>"  /></label>
                        </div>
                    </div>


                    <div class="span12" style="padding: 2%">
                        <div class="span4">
                            <label for="rg">RG<span class="required">*</span>
                      
                            <input id="rg" type="text" class="span8" name="rg" value="<?php echo set_value('rg'); ?>"  /></label>

                        </div>

                        <div class="span4">
                            <label for="cpf">CPF<span class="required">*</span>
                            
                                <input id="cpf" class="span8" type="text" name="cpf" value="<?php echo set_value('cpf'); ?>" /></label>

                        </div>

                        <div class="span4">
                            <label for="cor">Cor da Agenda
                           
                                <input id="cor" type="color" class="span6" name="cor" value="<?php echo set_value('cor'); ?>"></label>

                        </div>

                    </div>


                    <div class="span12" style="padding: 2%">
                        <div class="span6">
                            <label for="rua">Rua<span class="required">*</span>
                        
                            <input id="rua" type="text" class="span10" name="rua" value="<?php echo set_value('rua'); ?>" /></label>

                        </div>

                        <div class="span3">
                            <label for="numero">Numero<span class="required">*</span>
                      
                            <input id="numero" type="text" class="span4" name="numero" value="<?php echo set_value('numero'); ?>" /></label>

                        </div>

                    </div>
                    <div class="span12" style="padding: 2%">
                        <div class="span4">
                            <label for="bairro">Bairro<span class="required">*</span>
                       
                            <input id="bairro" type="text" class="span9" name="bairro" value="<?php echo set_value('bairro'); ?>" /></label>

                        </div>

                        <div class="span4">
                            <label for="cidade">Cidade<span class="required">*</span>
                       
                            <input id="cidade" type="text" class="span9" name="cidade" value="<?php echo set_value('cidade'); ?>" /></label>

                        </div>

                        <div class="span3">
                            <label for="estado">Estado<span class="required">*</span>
                        
                            <input id="estado" type="text" class="span7" name="estado" value="<?php echo set_value('estado'); ?>" /></label>

                        </div>

                    </div>


                    <div class="span12" style="padding: 2%">
                        <div class="span4">
                            <label for="telefone" >Telefone<span class="required">*</span>

                            <input id="telefone" type="text" maxlength="15" name="telefone" value="<?php echo set_value('telefone'); ?>" /></label>

                        </div>

                        <div class="span4">
                            <label for="celular" >Celular

                            <input id="celular" type="text" name="celular" value="<?php echo set_value('celular'); ?>" /></label>



                        </div>


                        <div class="span4">
                            <label>Situação*

                            <select name="situacao" id="situacao">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select></label>

                        </div>

                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/funcionarios" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#formFuncionario').validate({
            rules: {
                nomecompleto: {
                    required: true
                }


            },
            messages: {
                nomecompleto: {
                    required: 'Campo Requerido.'
                }


            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });




    });

</script>
