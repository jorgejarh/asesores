<div id="content_main" class="clearfix">
  <div id="main_panel_container" class="left" style="width:900px;">
    <div id="dashboard" style="width:100%;padding-bottom:50px;">
      <h2 class="ico_mug">
        <table style="width:100%;">
          <tr>
            <td><?php echo $title;?></td>
          </tr>
        </table>
      </h2>
      <div class="" style="width:90%; margin:auto;" align="center">
            <?php
            if($modulo['es_calificado']==0)
			{
				?>
                 <button class="cal_mod" onClick="calificar(<?php echo $modulo['id_modulo'];?>);">Calificar Modulo</button> 
                <?php
			}else{
				?>
                <a target="_blank" href="<?php echo site_url($this->nombre_controlador."/ver_resultados/".$modulo['id_modulo']);?>">Ver Resultados</a>
                <?php
				}
			?>
            
           
            
      </div>
    </div>
    <!-- end #dashboard --> 
  </div>
  
  <!-- end #sidebar --> 
  
</div>



<script type="text/javascript">


function calificar(id)
{
	$.ajax({
		  url: "<?php echo site_url($this->nombre_controlador.'/calificar');?>/"+id,
		  type:"POST",
		  success:function(data){

		  	$.fancybox(data);
		  }
	
	});
}
</script> 

<script type="text/javascript">
function imprimir_select(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>
