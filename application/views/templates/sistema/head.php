<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
	<?php date_default_timezone_set('America/El_Salvador'); ?>
	<meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />
	
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>public/css/style.css" />
	<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>public/css/smoothness/jquery-ui-1.7.1.custom.css"  />	
	<!--[if IE 7]><link rel="stylesheet" href="<?php echo base_url();?>public/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" href="<?php echo base_url();?>public/css/ie6.css" type="text/css" media="screen, projection" /><![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/markitup/skins/markitup/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/markitup/sets/default/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/superfish.css" media="screen">
	<!--[if IE]>
		<style type="text/css">
		  .clearfix {
		    zoom: 1;     /* triggers hasLayout */
		    display: block;     /* resets display for IE/Win */
		    }  /* Only IE can see inside the conditional comment
		    and read this CSS rule. Don't ever use a normal HTML
		    comment inside the CC or it will close prematurely. */
		</style>
	<![endif]-->
	<!-- JavaScript -->
   
   <script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.3.2.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/hoverIntent.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/superfish.js"></script>
	<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});

	</script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/excanvas.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.flot.pack.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/markitup/jquery.markitup.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/markitup/sets/default/set.js"></script>
  	<script type="text/javascript" src="<?php echo base_url();?>public/js/custom.js"></script>

	 <!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/excanvas.pack.js"></script><![endif]-->

	 <!--Datatable-->
	<style type="text/css" title="currentStyle">
			@import "<?php echo base_url();?>public/js/datatable/media/css/demo_table.css";
	</style>
	
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>public/js/datatable/media/js/jquery.dataTables.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url();?>public/js/fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/js/fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
</head>
<body>
<div class="container" id="container">
    <div  id="header">
    	<div id="profile_info">
			<img src="<?php echo base_url();?>public/img/avatar.jpg" id="avatar" alt="avatar" />
			<p><strong><?php echo $this->datos_user['nombre_completo']; ?></strong></p>
			<p><a href="<?php echo site_url('portal/salir');?>">Salir</a></p>
			<p class="last_login" style="margin-top:-8px;">Last login: <?php echo date('d/m/Y',strtotime($this->datos_user['ultimo_acceso'])); ?></p>
		</div>
		<div id="logo"><h1><a href="#">Asesores</a></h1></div>
		
    </div><!-- end header -->
	    <div id="content" >
	    <div id="top_menu" class="clearfix">
	    	<ul class="sf-menu"> <!-- DROPDOWN MENU -->
	    	<li class="current" ><a href="<?php echo site_url('portal');?>">Inicio</a></li>
            <?php
            $menu=$this->users_model->obtener_menu($this->datos_user['id_subrol']);
			
			if($menu)
			{//si hay menu
				foreach($menu as $valor)
				{
					$submenu=$this->users_model->obtener_menus_por_id_padre($valor['id_menu'],$this->datos_user['id_subrol']);
					if($submenu)
					{// si hay sub menus
						?>
                        <li>
                        	<!--Esta condicion es para que no redirecciones al login en caso que no haya URL-->
                        	<?php if($valor['url'] != "#"){ ?>
								<a href="<?php echo site_url($valor['url']);?>" class="sf-with-ul" ><?php echo $valor['nombre_menu'];?></a>
							<?php }else{ ?>
								<a href="<?php echo $valor['url'];?>" class="sf-with-ul" ><?php echo $valor['nombre_menu'];?></a>
							<?php } ?>
                            <ul>
                            <?php
                            foreach($submenu as $valor_submenu)
							{// foreach
								?>
								<li>
									<!--Esta condicion es para que no redirecciones al login en caso que no haya URL-->
									<?php if($valor['url'] != "#"){ ?>
										<a href="<?php echo site_url($valor_submenu['url']);?>" class="sf-with-ul" ><?php echo $valor_submenu['nombre_menu'];?></a>
									<?php }else{ ?>
										<a href="<?php echo $valor_submenu['url'];?>" class="sf-with-ul" ><?php echo $valor_submenu['nombre_menu'];?></a>
									<?php } ?>
                                    <?php
                                    $submenu2=$this->users_model->obtener_menus_por_id_padre($valor_submenu['id_menu'],$this->datos_user['id_subrol']);
									if($submenu2)
									{//11
										?>
                                        <ul>
										<?php
										foreach($submenu2 as $valor_submeu2)
										{
											?>
                                            <li>
												<!--Esta condicion es para que no redirecciones al login en caso que no haya URL-->
												<?php if($valor['url'] != "#"){ ?>
													<a href="<?php echo site_url($valor_submeu2['url']);?>" class="sf-with-ul" ><?php echo $valor_submeu2['nombre_menu'];?></a>
												<?php }else{ ?>
													<a href="<?php echo $valor_submeu2['url'];?>" class="sf-with-ul" ><?php echo $valor_submeu2['nombre_menu'];?></a>
												<?php } ?>
                                            </li>
                                            <?php
										}
										?>
                                        </ul>
                                        <?php
									}//11
									?>
                                </li>
								<?php
								
							}//foreach
							?>
                            </ul>
                   		</li>
                        <?php
						
						
					}// fin si hay sub menu
					?>
                    
                    <?php
				}
			}// fin si hay menu
			
			?>
            
            
			<?php
			/*
			$modulos=$this->users_model->obtener_modulos();
			if($modulos)
			{
				
				foreach($modulos as $un_modulo)
				{
					
					$opciones=$this->users_model->obtener_opciones($this->datos_user['id_subrol'],$un_modulo['id_modulo']);
					
					if($opciones)
					{
						?>
						<li>
							<a href="#" class="sf-with-ul" ><?php echo $un_modulo['modulo'];?></a>
							<ul>
								<?php
								foreach($opciones as $una_opcion)
								{
									?>
									<li><a href="<?php echo site_url($una_opcion['url']);?>"><?php echo $una_opcion['opcion'];?></a></li>
									<?php
								}
								?>
							</ul>
						</li>
						<?php
					}
				}
			}
*/
			?>
			
		</ul>
			
	    </div>
		<div id="content_main" class="clearfix">