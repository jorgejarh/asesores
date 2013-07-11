</div><!-- end #content -->
		   
    <div  id="footer" class="clearfix">
    	<p class="left">Fundaci&oacute;n Asesores para el Desarrollo</p>
		<p class="right">© <?php echo date('Y');?> </p>
	</div><!-- end #footer -->
</div><!-- end container -->

</body>
</html>


<script>
	/**
	 * Llama a la vista utilizada para que el usuario cambie su pass
	 * @param  int id_usuario 
	 */
	var cambiar_pass = function( id_usuario ){
		$.ajax({
			url: "<?php echo site_url('users/cambiar_pass_form'); ?>",
		  	type:"post",
		  	data:{id_usuario:id_usuario},
		  	success:function(data){
		  		$.fancybox(data);
		  	}
		});
	}
</script>