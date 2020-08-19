 <?php  ?>          
           
 <div id="highlight-<?php echo $countModules;?>" class="base-row <?php echo $bootstrap_rowclass; ?>">  
             
   <?php
                                               
		 if ($module_cols == 1)  { 
		         
				 $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '12 ' : '';
		         $col_class .= $bootstrap_colclass. '12 ';
			
			} elseif ( $module_cols == 2) {
				 $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '12 ' : '';
				 $col_class .= $bootstrap_colclass. '6 '; 
			
			 } else  { 
			     $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '4 ' : '';
				 $col_class .= $bootstrap_colclass. '4 ';
				 
				     }

		  $modules  	= JModuleHelper::getModules($countModules);
		  
		  $style    	= 'default'; 
		  $position 	= $countModules;
		  $count 		= count($modules);
		  $countercol 	= 1;
		  $i = 0; ?>
		 
		  <?php // muss eine zeile rein !!!				
		  foreach($modules as $mod) : 
		  
		  $modparams = $mod->params;  // modulparameter ?>
		  
		  <?php
		  
		
		   if ($count == $i) { $col_class .= ' last'; } 
							
		  // jetzt die module in die divs packen ?>  
		  <div class="base-col <?php echo $col_class; ?>">
			<div class="extension-outer-<?php echo $countModules;?>">
			  <?php echo JModuleHelper::renderModule($modules[$i], array('style' => $style, 'position' => $position )); ?>
			  <div class="clearfix"></div>
			</div>
		  </div>
		  <?php
		  $i++ ;
		  $countercol++;
		  $css_row = $i % $module_cols;
	  
		  if ( $css_row == 0 || $count == $i)  { ?>
		  <?php } ?>
		  
		  <?php endforeach; ?>
  </div> 