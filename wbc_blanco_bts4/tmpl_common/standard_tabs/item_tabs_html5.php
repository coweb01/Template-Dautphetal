<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
// first define the template name

$tmpl            = $this->tmpl;
$grid_framework  = $this->params->get('grid_framework', 1);
//$use_item_image  = $this->params->get('use_item_image', 1);
//$img_field_name  = $this->params->get('select_item_image');
//$lightbox        = $this->params->get('item_image_lightbox', 1);
//$img_size_map    = array('l'=>'large', 'm'=>'medium', 's'=>'small', 'o'=>'original');
//$img_field_size  = $img_size_map[ $this->params->get('image_size' , 'm') ];

// Fotogalerie 

$field_galerie  = $this->params->get('select_galerie');
$tabcount  = 6; 
$prefixtab = 'subtitle_tab';
for ($tc=1; $tc<=$tabcount; $tc++) :
 

 // prüfen ob die Galerie als Widgetkit ausgewählt ist und das Feld zusätzlich auf einer Position sitzt.
 $tabpos_name = $prefixtab.$tc;
 
 if ( isset($this->item->positions[$tabpos_name] ))  :   
   
    foreach ($this->item->positions[$tabpos_name] as $field) : 

      if ( $field_galerie == $field->name) :
         $d = $field->name;
         unset($this->item->positions[$tabpos_name]->$d);
      endif;

    endforeach;

    $arr = (array)$this->item->positions[$tabpos_name];
      if (!$arr) {
         
         unset($this->item->positions[$tabpos_name]);
   }
   
  endif;

endfor;

// Bild im Fliesstext

$show_img_desc  = $this->params->get('use_item_image',0);
$img_field_name = $this->params->get('select_item_image');
$img_position   = '';
$img_style      = '';
$image_size     = $this->params->get('item_image_size','m');

if ($show_img_desc == 1 ) : 
  if ($img_field_name && FlexicontentFields::getFieldDisplay($this->item, $img_field_name, null, 'display_'. $image_size, 'item')) :  // Bild in Beitragtext einbinden 

      $html_images     = FlexicontentFields::getFieldDisplay($this->item, $img_field_name, null, 'display_' .$image_size, 'item');      
  endif;
endif;


$img_position   = '';
$img_style      = '';
$css_icon       = '';

$tab_data    = '';
$tab_data_uk = '';
$tab_data    = '';
$tab_pane    = '';

switch  ( $grid_framework  ) { /** CSS fuer Bilder  und Tabs **/

  case 0: 
          $img_style    = '';   /* Flexicontent */
          $img_class    = '';
          $img_position = '';
          break;

  case 1:
          $img_style        = 'img-';   /* bootstrap 4 */
          $img_class        = 'img-fluid ';
          $img_position     = ' float-';
          
          $tabset           = 'nav nav-tabs flex-column flex-sm-row';
          $tab              = 'flex-sm-fill nav-item ';
          $tab_data         =  ' data-toggle="tab" '; 
          $tab_active       = ' active';
          $tab_pane         = 'tab-pane fade';
          break;  

  case 2: 
          $img_style    = 'uk-border-';
          $img_class    = 'uk-thumbnail ';
          $img_position = ' uk-align-';   /*  Uikit */

          $tabset       = 'uk-tab';
          $tab_data_uk  = ' data-uk-tab';
          $tab          = '';
          $tab_active   = ' uk-active';
          break;
  } 

 switch  ( $this->params->get('item_image_position',1) ) {
              case 0: $img_position .= "left";
                  break;
              case 1: $img_position .= "right";
                  break;      
              case 2: 
                  $img_position = ( $grid_framework == 2 ) ? "uk-align-center" : "centered";
                  break;
          }

$img_position        .= ' item-image';
$count_active        = 0;
$count_active_cont   = 0;
$createtabs          = false;
// Find if at least one tabbed position is used
for ($tc=1; $tc<=$tabcount; $tc++) :
  $createtabs = ( $createtabs ||  isset($this->item->positions[$prefixtab.$tc]) ) ? true : false;
endfor;  

/* BOF Bootstrap4 tabs */
if ($createtabs === true) :
	
	 $navtabs =  '<ul class="' .$tabset.'" ' . $tab_data_uk . ' role="tablist">';
	  for ($tc=1; $tc<=$tabcount; $tc++) :
		  //if (isset($item->positions['subtitle_tab'.$tc])):
         if (isset($this->item->positions['subtitle_tab'.$tc])):	
      		   $tabpos_name = $prefixtab.$tc;

      		   $tabpos_label = JText::_($this->params->get($prefixtab.$tc.'_label', $tabpos_name));

             if ( $count_active == 0 ) {
                  $tabpanel_active =  $tab_active;
                  $count_active++;
                } else {
                  $tabpanel_active = '';
         }

    		 $css_icon = ( $this->params->get($prefixtab.$tc.'_icon') > '' ) ? '<i class="' . $this->params->get('subtitle_tab'.$tc.'_icon') . '"></i> ' : '';
    			  					  
  		   $navtabs .= '<li role="presentation" class="' .$tab;
         $navtabs .= ( $grid_framework == 2 ) ? $tabpanel_active : '';         
         $navtabs .= '"><a href="#'. $tabpos_name.'" class="mootools-noconflict nav-link ';
         $navtabs .= ( $grid_framework == 1 ) ? $tabpanel_active : '';
         $navtabs .= '" role="tab" '. $tab_data . '>'.$css_icon .$tabpos_label.'</a></li>';
  		  endif;
	  endfor;
	  $navtabs .= '</ul>';  ?>
	  
      <div class="wbc-tabs mt-5" role="tabpanel">
      <?php echo $navtabs; ?>
        <div class="tab-content"> 
        <?php // Tabs erstellen ende 
     
        for ($tc=1; $tc<=$tabcount; $tc++) :


            $tabpos_name          = 'subtitle_tab'.$tc;            
            $tabpos_label         = JText::_($this->params->get($prefixtab.$tc.'_label', $tabpos_name));
            $tab_id               = 'fc_'.$tabpos_name;
			      $tabpanel_first_class = '';
            
            if ( $count_active_cont == 0 && isset($this->item->positions[$tabpos_name])) {
             
                $tabpanel_first_class  = $grid_framework == 1 ? 'show' : '';
                $tabpanel_first_class .= $tab_active;
                $count_active_cont++;
              } else {
               
                $tabpanel_first_class  = '';
              }
      
			 
			  if (isset($this->item->positions[$tabpos_name])): ?>
         <div role="tabpanel" class="<?php echo  $tab_pane . $tabpanel_first_class; ?>" id="<?php echo 'subtitle_tab'.$tc;?>"> 
                               	
              <?php foreach ($this->item->positions[$tabpos_name] as $field) : ?>
              
              <?php if ( $field_galerie != $field->name  && $field->name != 'wk_galerie ') : // nur anzeigen wenn Galerie nicht auf separater Postition ist ?>  
            

                  <?php if ( $field->name == "text" ): ?>  
                       
                       <?php if ( $show_img_desc == 1 && isset($html_images) ) : 
                        // Bild in Beitragtext einbinden?>                    
                            <figure class="<?php echo $img_position; ?>" >
                                <?php echo $html_images; ?>
                            </figure>                   
                        <?php endif; ?>
                      <?php echo $field->display; ?>
                      
                  <?php endif; ?>
                
              
                  <?php if ( $field->name != "text" ) : ?>
                    <div class="flexi_fields field_<?php echo $field->name; ?>">
                        <?php if ($field->label) : ?>
                        <span class="label label_field_<?php echo $field->name; ?>">
                          <?php echo $field->label; ?></span>
                        <?php endif; ?>
                        <div class="value value_<?php echo $field->name; ?>">
                          <?php echo $field->display; ?>
                        </div>
                    </div>
                  <?php endif;?>

              <?php endif; ?>
              <?php endforeach; ?>
          </div> <!-- of tabpanel -->
             
          <?php endif; /*EOF subtitle_tab block*/ ?>
        
        <?php endfor; ?>
        </div>
    </div>	<!-- eof Tabpanel -->
<?php
endif;
/* EOF Bootstrap4 Tabs */
?>



