<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/sitio');?>/style.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url('public/sitio');?>/js/jquery.core.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/sitio');?>/js/jquery.superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/sitio');?>/js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/sitio');?>/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/sitio');?>/js/jquery.scripts.js"></script>
<script>base_url="<?php echo base_url();?>";</script>
</head>
<body>
<div id="wrap">
    <div class="top_corner"></div>
    <div id="main_container">
    
        <div id="header">
            <div id="logo"><?php 
			echo anchor('sitio',img(array('src'=>'public/images_sitio/img/logo_t_asesores.png',
											'height'=>'80'
											)
									)
						);
			?></div>
            
            <a href="make-a-donation.html" class="make_donation"></a>
            <!--
            <div id="menu">
                <ul>                                                                                            
                    <li><a class="current" href="index.html" title="">Home</a></li>
                    <li><a href="about.html" title="">About Company</a></li>
                    <li><a href="#" title="">Projects</a></li>
                    <li><a href="#" title="">Clients</a></li>
                    <li><a href="#" title="">Testimonials</a></li>
                    <li><a href="contact.html" title="">Contact</a></li>
                </ul>
            </div>
            -->
        	<div class="login_home">
            	<h2>Entrar al sistema</h2>
                <div class="form_envio">
                <?php
                echo form_open('sitio/login',array('id'=>'form_datos'));
				?>
                <table>
                	<tr>
                    	<td align="left" valign="middle">Usuario:</td>
                        <td align="left" valign="middle"><input type="text" name="user" class="newsletter_input" /></td>
                    </tr>
                    <tr>
                    	<td align="left" valign="middle">Contraseña:</td>
                        <td align="left" valign="middle"><input type="password" name="pass" class="newsletter_input" /> <input type="submit" name="entrar" class="newsletter_submit" value="Ingresar" /></td>
                    </tr>
                </table>
                 <?php
                echo form_close();
				?>
                </div>
                <div class="cargando_"></div>
                <div class="login_error">
                	<div class="info"></div>
                    <div>
                    	<input id="intentar_nuevo" type="submit" class="newsletter_submit"  value="volver a intentar" />
                    </div>
                </div>
                <script type="text/javascript">
				$(document).ready(function(e){
					
					
					$('#intentar_nuevo').click(function(){
						
						$('.login_error').hide();
						
						$('.form_envio').fadeIn('fast');
						});
					
						$('#form_datos').submit(function(event){
								/*$('.info').html(' ');
								/*$('.login_error').hide();*/
								
								form=$(this);
								$('.form_envio').fadeOut('fast',function(){
										$('.cargando_').show();
										
										$.ajax({
											url:form.attr('action'),
											type:"POST",
											data:form.serialize(),
											dataType:"json",
											success: function(data)
													{
														if(data.error)
														{
															$('.cargando_').hide();
															
															alert(data.mensaje);
															$('.form_envio').fadeIn('fast');
															/*$('.info').html(data.mensaje);*/
															
															/*$('.login_error').fadeIn('fast');*/
														}else{
															
															window.location=data.url;
															
															}
														
													}
										});
										
										
										
										
									});
								
								return false;
							});
					
					});
				</script>
            </div>
        </div>
        