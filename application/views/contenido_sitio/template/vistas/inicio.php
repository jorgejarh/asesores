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
											'height'=>280));?></li>
                    <?php
				}
				?>
               </ul>
            </div>
            <div id="featured_positioner_desc" class="jcarousel-container">
               <div id="featured_wrapper_desc" class="jcarousel-clip">
                  <!--<ul id="featured_desc" class="jcarousel-list">
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
                  </ul>-->
               </div>

            </div>
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
          
        
        
        </div><!---------------------------------end of middle banner-------------------------------->
        
        
        <div class="center_content">
        
        
         
        <div class="home_section_left">
            <img src="<?php echo base_url('public/sitio');?>/images/icon1.gif" alt="" title="" class="home_section_icon" border="0">
                            
                <h2 class="home_title">What we do</h2>
                <div class="home_subtitle">Consectetur adipisicing elit</div>
    
                <div class="home_section_thumb">
                <img src="<?php echo base_url('public/sitio');?>/images/home_section_thumb1.jpg" alt="" title="" border="0">
                </div>
                <p><span>Lorem ipsum dolor sit ame</span><br>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. 
                <br> <br>
                <span>Lorem ipsum dolor sit ame</span><br>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. 
                </p>
                <a href="" class="more"><img src="<?php echo base_url('public/sitio');?>/images/more.gif" alt="" title="" border="0"></a>
        <div class="clear"></div>
        </div>
        
        
        <div class="home_section_left">
            <img src="<?php echo base_url('public/sitio');?>/images/icon2.gif" alt="" title="" class="home_section_icon" border="0">
                            
                <h2 class="home_title">Who we are</h2>
                <div class="home_subtitle">Tempor incididunt ut labore</div>
    
                <div class="home_section_thumb">
                <img src="<?php echo base_url('public/sitio');?>/images/home_section_thumb2.jpg" alt="" title="" border="0">
                </div>
                <p><span>Lorem ipsum dolor sit ame</span><br>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. 
                <br> <br>
                <span>Lorem ipsum dolor sit ame</span><br>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. 
                </p>
                <a href="" class="more"><img src="<?php echo base_url('public/sitio');?>/images/more.gif" alt="" title="" border="0"></a>
        <div class="clear"></div>
        </div>
        
        <div class="home_section_left">
            <img src="<?php echo base_url('public/sitio');?>/images/icon3.gif" alt="" title="" class="home_section_icon" border="0">
                            
                <h2 class="home_title">Special services</h2>
                <div class="home_subtitle">Sed do eiusmod tempor</div>
    
                <div class="home_section_thumb">
                <img src="<?php echo base_url('public/sitio');?>/images/home_section_thumb3.jpg" alt="" title="" border="0">
                </div>
                <p><span>Lorem ipsum dolor sit ame</span><br>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. 
                <br> <br>
                <span>Lorem ipsum dolor sit ame</span><br>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. 
                </p>
                <a href="" class="more"><img src="<?php echo base_url('public/sitio');?>/images/more.gif" alt="" title="" border="0"></a>
        <div class="clear"></div>
        </div>
        
        <div class="clear"></div>
        </div>