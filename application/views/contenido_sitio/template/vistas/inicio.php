<div class="middle_banner">
  <div class="featured_slider"> 
    <!-- begin: sliding featured banner -->
    <div id="featured_border" class="jcarousel-container">
      <div id="featured_wrapper" class="jcarousel-clip">
        <ul id="featured_images" class="jcarousel-list">
          <?php
                foreach($imagenes as $valor)
				{
					?>
          <li><?php echo img(array('src'=>'public/images_sitio/slider/'.$valor['nombre_archivo'],
											'width'=>965,
											'height'=>175));?></li>
          <?php
				}
				?>
        </ul>
      </div>
      <!--<div id="featured_positioner_desc" class="jcarousel-container">
        <div id="featured_wrapper_desc" class="jcarousel-clip">
          <ul id="featured_desc" class="jcarousel-list">
            <?php
					foreach($imagenes as $valor)
					{
						?>
            <li>
              <div>
                <p><?php echo $valor['texto_aparecer'];?></p>
              </div>
            </li>
            <?php
					}
					?>
          </ul>
        </div>
      </div>-->
      <ul id="featured_buttons" class="clear_fix">
        <?php
				for($i=1;$i<=count($imagenes);$i++)
				{
					?>
        <li><?php echo $i;?></li>
        <?php
				}
				?>
      </ul>
    </div>
    <!-- end: sliding featured banner --> 
  </div>
</div>
<!---------------------------------end of middle banner-------------------------------->

<div class="center_content">
  <div class="home_section_left"> <img src="<?php echo base_url('public/sitio');?>/images/icon1.gif" alt="" title="" class="home_section_icon" border="0">
    <h2 class="home_title">Capacitación</h2>
    <div class="home_subtitle">Capacitación</div>
    <div class="home_section_thumb"><!-- <img src="<?php echo base_url('public/sitio');?>/capacitacion.fw.png" alt="" title="" border="0"> --></div>
    
    <p><span>- Diplomados Especializados</span></p>
    <p><span>- Círculos ejecutivos</span></p>
    <p><span>- Seminarios y cursos especializados</span></p>
    <p><span>- Capacitaciones locales</span></p>
    <p><span>- Congresos y conferencias</span></p>
    <!--<a href="" class="more"><img src="<?php echo base_url('public/sitio');?>/images/more.gif" alt="" title="" border="0"></a>-->
    <div class="clear"></div>
  </div>
  <div class="home_section_left"> <img src="<?php echo base_url('public/sitio');?>/images/icon2.gif" alt="" title="" class="home_section_icon" border="0">
    <h2 class="home_title">Asesoría</h2>
    <div class="home_subtitle">Asesoría</div>
    <div class="home_section_thumb"> <!--<img src="<?php echo base_url('public/sitio');?>/asesorias.fw.png" alt="" title="" border="0"> --></div>
    <p><span>- Elaboración de diagnosticos</span></p>
    <p><span>- Elaboracion de planes de trabajo</span></p>
    <p><span>- Apoyo en el proceso de tomas de deciciones</span></p>
    <p><span>- Asesoría en aspectos legales y normativos</span></p>
    
    <!--<a href="" class="more"><img src="<?php echo base_url('public/sitio');?>/images/more.gif" alt="" title="" border="0"></a>-->
    <div class="clear"></div>
  </div>
  <div class="home_section_left"> <img src="<?php echo base_url('public/sitio');?>/images/icon3.gif" alt="" title="" class="home_section_icon" border="0">
    <h2 class="home_title">Consultoarías</h2>
    <div class="home_subtitle">Consultoarías</div>
    <div class="home_section_thumb"><!-- <img src="<?php echo base_url('public/sitio');?>/consultorias.fw.png" alt="" title="" border="0"> --></div>
    <p><span>- Consultoría Administrativa y Financiera</span></p>
    <p><span>- Consultoría de Recursos Humanos</span></p>
    <p><span>- Planificación estratégica</span></p>
    <p><span>- Esudio de Mercados</span></p>
    <p><span>- Otras Consultorías Especializadas</span></p>
    <!--<a href="" class="more"><img src="<?php echo base_url('public/sitio');?>/images/more.gif" alt="" title="" border="0"></a>-->
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>