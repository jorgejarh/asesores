
<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug"> <?php echo $title;?> </h2>
      <div> <?php echo anchor('nota_cargo/index','Atras');?> </div>
      <br />
      <div style="width:95%; margin:auto;">
        <?php
        echo form_open('',array('class'=>'form_nota'));
		?>
        <table width="100%">
          <tr align="right">
            <td>Por $ <?php echo form_input('cantidad_por', set_value('cantidad_por'));?> Más IVA</td>
          </tr>
          <tr>
            <td><?php echo form_dropdown('tipo_persona',array('C'=>"Cooperativa",'PN'=>"Persona Natural"),set_value('tipo_persona'));?> <?php echo form_dropdown('cooperativa',array());?></td>
          </tr>
          <tr>
            <td><p>Hemos cargado a su cuenta por Cobrar en la Fundacion Asesores para el Desarrollo, la suma de :</p></td>
          </tr>
          <tr>
            <td><?php $opciones=array('name'=>'cantidad_letras', 'value'=>set_value('cantidad_letras'), 'readonly'=>'readonly','style'=>'width:100%;'); 
			echo form_input($opciones );?>
              </td>
          </tr>
          <tr>
            <td><p>Por Participación en jornada de capacitación:</p></td>
          </tr>
          <tr>
            <td><?php echo form_dropdown('id_capacitacion',array());?>
              </td>
          </tr>
          <tr>
            <td><div><b>Participantes:</b></div>
            	<div class="participantes">
                	
                </div>
            </td>
          </tr>
          <tr>
            <td>Inversión individual: $
             <?php 
			 $opciones=array('name'=>'inversion_individual', 'value'=>set_value('inversion_individual'), 'readonly'=>'readonly'); 
			echo form_input($opciones );?> 
            
            Inversión Total: $
             <?php 
			 $opciones=array('name'=>'inversion_total', 'value'=>set_value('inversion_total'), 'readonly'=>'readonly'); 
			echo form_input($opciones );?>
            </td>
          </tr>
          <tr>
          	<td align="center"><input type="submit" id="save" value="Guardar" onclick="validar_todo();" /></td>
          </tr>
        </table>
        
        
        <?php
		echo form_close();
		?>
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
$(document).ready(function() {
   
   $('select[name=tipo_persona]').change(function(e) {
		$.ajax({
		  url: "<?php echo site_url('nota_cargo/ajax_listado_personas');?>/"+$(this).val(),
		  type:"POST",
		  success:function(data){

		  	 $('select[name=cooperativa]').html(data);
			 $('select[name=cooperativa]').change();
		  }
		  
		});
	});
	
	
	
	$('select[name=cooperativa]').change(function(e) {
        var id_cooperativa=$(this).val();
		var tipo_persona=$('select[name=tipo_persona]').val();
		
		$.ajax({
		  url: "<?php echo site_url('nota_cargo/ajax_capacitaciones');?>",
		  type:"POST",
		  dataType:"json",
		  data:{'tipo_persona':tipo_persona,'id_cooperativa':id_cooperativa},
		  success:function(data){
			  $('select[name=id_capacitacion]').html("");
			  $('select[name=id_capacitacion]').html(data.capacitaciones);
			  $('select[name=id_capacitacion]').change();
		  }
		  
		});
		
    });
	
	$('select[name=id_capacitacion]').change(function(e) {
        
		var id_cooperativa=$('select[name=cooperativa]').val();
		var id_capacitacion=$(this).val();
		var tipo_persona=$('select[name=tipo_persona]').val();
		
		$.ajax({
		  url: "<?php echo site_url('nota_cargo/ajax_personas_x_capacitacion');?>",
		  type:"POST",
		  dataType:"json",
		  data:{'tipo_persona':tipo_persona,'id_cooperativa':id_cooperativa,'id_capacitacion':id_capacitacion},
		  success:function(data){
			  $('.participantes').html(data.personas);
			  llenar_precios();
		  }
		  
		});
		
    });
	
	
	$('input[name=cantidad_por]').change(function(e) {
        
		var num=$(this).val();
		
		$.ajax({
		  url: "<?php echo site_url('nota_cargo/ajax_letras');?>",
		  type:"POST",
		  data:{'num':num},
		  success:function(data){
			  
			  $('input[name=cantidad_letras]').val(data);
		  }
		  
		});
		
    });
	
	
	
	$('select[name=tipo_persona]').change();
	
});

function llenar_precios()
{
	var id_capacitacion=$('select[name=id_capacitacion]').val();
	var id_cooperativa=$('select[name=cooperativa]').val();
	var tipo_persona=$('select[name=tipo_persona]').val();
	$.ajax({
		  url: "<?php echo site_url('nota_cargo/ajax_datos_capacitacion');?>",
		  type:"POST",
		  //dataType:"json",
		  data:{'tipo_persona':tipo_persona,'id_cooperativa':id_cooperativa,'id_capacitacion':id_capacitacion},
		  success:function(data){
			  
			  $('input[name=inversion_individual]').val(data);
			  var cantidad=$('.participantes ul li').size();
			  
			  var total=parseFloat(cantidad)*parseFloat(data);
			  
			  $('input[name=inversion_total]').val(total);
			  
		  }
		  
		});
}

function validar_todo()
{
	event.preventDefault();
	var validar_form=true;
	$('.form_nota').find('input[type=text]').each(function(index, element) {
        
		if($(this).val()=="" || $(this).val()==0 )
		{
			validar_form=false;
			$(this).addClass('error_');
		}else{
			$(this).removeClass('error_');
			}
    });
	
	$('.form_nota').find('select').each(function(index, element) {
        
		if($(this).val()=="" || $(this).val()==0 || $(this).val()==null )
		{
			validar_form=false;
			$(this).addClass('error_');
		}else{
			$(this).removeClass('error_');
			}
    });
	
	if(validar_form)
	{
		if(confirm("¿Esta seguro de generar la nota de cargo?"))
		{
			$('.form_nota').submit();
		}else{
			return false;
			}
		
	}
}

function nuevo_registro()
{
	$.ajax({
		  url: "<?php echo site_url('conf_menu/nuevo');?>",
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function editar_registro(id)
{
	$.ajax({
		  url: "<?php echo site_url('conf_menu/editar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
		  
		});
}

function eliminar_registro(id)
{
	if(!confirm('¿Todos los submenus tambien se eliminaran, Seguro de desea el registro,?'))
	{
		return false;
	}

	$.ajax({
		  url: "<?php echo site_url('conf_menu/eliminar');?>/"+id,
		  type:"POST",
		  success:function(data){
			  
			  	if(data=="ok")
			  	{
					alert("Registro Eliminado");
					location.reload();
				}
			/*  
		  	$.fancybox({
		  		content:data,
		  		afterClose:function()
		  		{
		  			location.reload();
		  		}
		  	});*/
		  }
		  
		});
}

</script> 
<style type="text/css">
.lista_participantes
{
	margin:0px;
}
</style>