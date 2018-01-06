<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vAgenda')) ?>





<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='<?php echo base_url();?>assets/fullcalendar/scheduler.min.css' rel='stylesheet' />
<script src='<?php echo base_url();?>assets/fullcalendar/moment.min.js'></script>

<script src='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/scheduler.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/pt-br.js'></script>







<script>
    $(function() { // document ready

        $('#calendar').fullCalendar({
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            allDaySlot: false,
            eventOverlap: false,
            defaultView: 'agendaDay',
            minTime: '08:00:00',
            maxTime: '19:00:00',
            defaultTimedEventDuration: '00:30:00',
            editable: true,

            eventLimit: true, // allow "more" link when too many events
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaTwoDay,agendaWeek,month'
            },
            views: {
                agendaTwoDay: {
                    type: 'agenda',
                    duration: {
                        days: 2
                    },

                    // views that are more than a day will NOT do this behavior by default
                    // so, we need to explicitly enable it
                    groupByResource: true

                    //// uncomment this line to group by day FIRST with resources underneath
                    //groupByDateAndResource: true
                }
            },

            //// uncomment this line to hide the all-day slot
            //allDaySlot: false,

            resources: {
                url: '<?php echo base_url(); ?>index.php/os/listausuarios',
                type: 'POST',
                data: {
                    value1: 'aaa',
                    value2: 'bbb'
                },
                success: function(data) {
                    console.log(data);
                },
                error: function() {
                    alert('Erro ao carregar eventos!');
                },
            },
            events: {
                url: '<?php echo base_url(); ?>index.php/os/listevent',
                type: 'POST',
                data: {
                    
                   
                },
                success: function(data) {
                    console.log(data);
                },
                error: function() {
                    alert('Erro ao carregar eventos!');
                },
            },

            selectable: true,
            selectHelper: true,
            select: function(start) {

                $('#cadastrar #dataInicial').val(moment(start).format('DD/MM/YYYY'));
                $('#cadastrar #start').val(moment(start).format('YYYY-MM-DD'));
                $('#cadastrar #hora').val(moment(start).format('HH:mm'));
                $('#cadastrar #end').val(moment(end).format('YYYY-MM-DD'));

                $('#cadastrar').modal('show');



            },

   eventClick: function(event) {
            $('#editar #id').text(event.resourceId);
       $('#editar #title').text(event.title);
       $('#editar #description').text(event.description);
        $('#editar').modal('show');
},

            dayClick: function(date, jsEvent, view, resource) {
                console.log(
                    'dayClick',
                    date.format(),
                    resource ? resource.id : '(no resource)'
                );
            }
        });

    });

</script>




<div id='calendar'></div>

<div id='cadastrar' class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Agendamento</h3>
    </div>
    <div class="modal-body">
        <div class="span12" id="divCadastrarOs">

            <form action="<?php echo base_url();?>index.php/os/adicionar" method="post" id="formOs">

                <div class="span12" style="padding: 1%">

                    <div class="span4">
                        <label for="data">Data<span class="required">*</span></label>
                        <input id="dataInicial" class="span12 datepicker" type="text" name="dataInicial" value="" />
                        <input id="dataInicial" class="span12 " type="hidden" name="dataInicial" value="" />

                    </div>
                    <div class="span4">
                        <label for="data">Horario<span class="required">*</span></label>
                        <input id="hora" class="span12" type="text" name="hora" value="" />
                        <input id="hora" class="span12 " type="hidden" name="hora" value="" />


                    </div>
                    <div class="span3">
                        <label for="status">Status<span class="required">*</span></label>
                        <select class="span12" name="status" id="status" value="">

                                                <option value="Aberto">Aberto</option>
                                                <option value="Em Andamento">Em Andamento</option>
                                                <option value="Finalizado">Finalizado</option>
                                                <option value="Cancelado">Cancelado</option>
                                            </select>
                    </div>


                    <input id="start" class="span12 " type="hidden" name="start" value="" />
                    <input id="end" class="span12 " type="hidden" name="end" value="" />


                </div>
                <div class="span12" style="padding: 1%; margin-left: 0">

                    <div class="span8">
                        <label for="cliente">Cliente<span class="required">*</span></label>
                        <input id="cliente" class="span12" type="text" name="cliente" value="" />
                        <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="" />
                    </div>

                    <div class="span4">
                    <label for="tecnico">Profissional<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value=""  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value=""  />
                    </div>

                </div>



                <div class="span12" style="padding: 1%; margin-left: 0">
                    <div class="span6 offset3" style="text-align: center">
                        <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
                        <a href="<?php echo base_url() ?>index.php/os" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        

    </div>
</div>


<div id='editar' class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Detalhe Agenda</h3>
    </div>
    <div class="modal-body">
         
        <label>Cliente: <span id="title" name="title"></span></label>
        <label>Serviço: <span id="description" name="description"></span></label>
       
    </div>
    <div class="modal-footer">
      
    </div>
</div>



<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>



<script type="text/javascript">
    $(document).ready(function() {

        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 1,
            select: function(event, ui) {

                $("#clientes_id").val(ui.item.id);


            }
        });




        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 1,
            select: function(event, ui) {

                $("#usuarios_id").val(ui.item.id);


            }
        });





      $("#formOs").validate({
          rules:{
             cliente: {required:true},
             tecnico: {required:true},

          },
          messages:{
             cliente: {required: 'Campo Requerido.'},
             tecnico: {required: 'Campo Requerido.'},

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

    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

    });

</script>
