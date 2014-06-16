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
      
        <div style="width:90%; margin:auto;" id="resultado" >
        <table id="example" class="display">
        	<?php
			$con=0;
            foreach($listado as $valor)
			{
				$con++;
				if($con==1)
				{
					?>
                    <thead>
                    <tr>
                    	<?php
						foreach($valor as $indice=>$valor2)
						{
						?>
							<th><?php echo $indice;?></th>
						<?php
						}
						?>
                    </tr></thead>
                    <tbody>
                    <?php
				}
				?>
                
    			<?php
                if($valor['total']!=0)
				{
				?>
                <tr>
                	<?php
					foreach($valor as $indice=>$valor2)
					{
					?>
                    	<td><?php echo $valor2;?></td>
                    <?php
					}
					?>
                </tr>
                <?php
                }
                
			}
			?>
            </tbody>
        </table>
        	
        </div>
        
    	</div>
    	<!-- end #dashboard --> 
  	</div>
  	
  	<!-- end #sidebar --> 
  
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').dataTable( {
	        <?php echo config_lenguaje_tabla(); ?>
	    } );
		
	} );
</script>

