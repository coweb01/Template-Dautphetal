                    
           <?php
           $fcolbootstrap = 12;

			/** Spaltenanzahl im Footer */
			switch ($footercols) {
				case 3: $fcolbootstrap = 4;
				        break;
				case 4: $fcolbootstrap = 3;
					break;
				case 2: $fcolbootstrap = 6;
				        break;
				      
			}

		   $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '12 ' : ' ';
		   $col_class .= $bootstrap_colclass. '12';

            switch  ( $fcolbootstrap )  { 
		         
			     case 6:
				 $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '6' : '';
				 $col_class .= ' ' .$bootstrap_colclass. $fcolbootstrap;
				 break; 
			
			     case 4:
				 $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '6' : '';
				 $col_class .= ' ' .$bootstrap_colclass. $fcolbootstrap; 
			     break;
			
			     case 3: 
			     $col_class  = ( isset($bootstrap_colclass_mobil_tb)) ? $bootstrap_colclass_mobil_tb . '12' : '';
				 $col_class .= ' ' .$bootstrap_colclass. $fcolbootstrap;
				 break;

     		 }
		   
		  $modules  = JModuleHelper::getModules('footer');
		  $style    = 'none'; 
		  $position = 'footer';
		  $count = count($modules);
		  $countercol = 1;
		  $i = 0; ?>
		
          <div class="<?php echo $bootstrap_rowclass; ?>">
		  <?php // muss eine zeile rein !!!				
		  foreach($modules as $mod) : 
		  
		  $modparams = $mod->params;  // modulparameter ?>
		  
		  <?php
			   if ($count == $i) { $col_class .= ' last'; } 
								
			  // jetzt die module in die divs packen ?>  

              <div  id="footer-0<?php echo $i;?>" class="base-col <?php echo $col_class; ?>">
			  <?php echo JModuleHelper::renderModule($modules[$i], array('style' => $style, 'position' => $position )); ?>
			  <div class="clearfix"></div>
			  </div>
			  <?php
			  $i++ ;
			  $countercol++;
			  $css_row = $i % $footercols;
		  
		  if ( $css_row == 0 || $count == $i)  { ?>
		  <div class="clearfix"></div>
		  <?php } ?>
		  
		  <?php endforeach; ?>
          </div>
