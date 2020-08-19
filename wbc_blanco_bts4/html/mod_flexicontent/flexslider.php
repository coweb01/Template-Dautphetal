<?php 
/**
 * $caching
 * $ordering
 * $count
 * $featured
 *
 * // Display parameters
 * $moduleclass_sfx
 * $layout 
 * $add_ccs
 * $add_tooltips
 * $width
 * $height
 * // standard
 * $display_title
 * $link_title
 * $display_date
 * $display_text
 * $mod_readmore
 * $mod_use_image
 * $mod_link_image
 * // featured
 * $display_title_feat 
 * $link_title_feat 
 * $display_date_feat
 * $display_text_feat 
 * $mod_readmore_feat
 * $mod_use_image_feat 
 * $mod_link_image_feat 
 *
 * // Fields parameters
 * $use_fields 
 * $display_label 
 * $fields 
 * // featured
 * $use_fields_feat
 * $display_label_feat 
 * $fields_feat 
 *
 * // Custom parameters
 * $custom1 
 * $custom2 
 * $custom3 
 * $custom4 
 * $custom5 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base(true) . 'media/mod_flexicontent/css/wbc-flexslider.css', 'text/css' ); 	// original Flexslider CSS
$doc->addScript(JURI::base(true) . 'media/mod_flexicontent/js/jquery.flexslider.js');


// params Flexslider --------------------------------------------------------------*/
$flexdirection          = $params->get('direction', 'vertical'); // richtung flexslider 1=vertikal ; 0=default
$smoothHeight           = ( $flexdirection == 'vertical') ? 'false' : 'true';
$slideritems			= $params->get('slideritems', 3); // Anzahl der Beitraeg in einem Slide
$sliderSpeed			= $params->get('sliderSpeed', 2000); // Slidergeschwindikeit Anzeigedauer der einzelnen Slides 
$animationSpeed			= $params->get('animationSpeed', 500); // Geschwindigkeit der Sliderwechsel
$Controlnav			    = $params->get('Controlnav', true); // Anzeige Navigation slides 
$DirectionNav			= $params->get('DirectionNav', true); // Anzeige Navigation rechts links


$js  = "jQuery(window).load(function() {\n";
 	
$js .= "jQuery('#flexslider_";
$js .=  $module->id;
$js .=  "').flexslider({\n";
$js .=  "animation: 'slide',
        easing:'easeInQuart',
 		direction: '";
$js .=  $flexdirection . "',\n" ;

$js .= "slideshowSpeed: "; 
$js .=  $sliderSpeed . ",\n";

$js .=  "animationSpeed: ";
$js .=  $animationSpeed . ",\n";
  			
$js .= 	"directionNav: ";
$js .=  $DirectionNav . ",\n"; 

$js .= 	"controlNav: ";
$js .=  $Controlnav . ", \n"; 

$js .=  "pauseOnHover: true,
    	initDelay: 0,
    	randomize: false,";
$js .= 	"smoothHeight: ";
$js .=  $smoothHeight . ",\n";
$js .=  "touch: true,
        keyboardNav: true,
		allowOneSlide: true
    });";
$js .= '});';    
$doc->addScriptDeclaration($js);

// end flexslider -----------------------------------------------*/

$mod_width_feat 	    = (int)$params->get('mod_width', 110);
$mod_height_feat 	    = (int)$params->get('mod_height', 110);
$mod_width 				= (int)$params->get('mod_width', 80);
$mod_height 			= (int)$params->get('mod_height', 80);

$force_width_feat='';//"width='$mod_width_feat'";
$force_height_feat='';//"height='$mod_height_feat'";
$force_width='';//"width='$mod_width'";
$force_height='';//"height='$mod_height'";

$hide_label_onempty_feat = (int)$params->get('hide_label_onempty_feat', 0);
$hide_label_onempty      = (int)$params->get('hide_label_onempty', 0);
//$slider                  = count($list);
//$slider                  = $slider + count($list["standard"]);



?>

    
	<?php
	// Display FavList Information (if enabled)
	//include(JPATH_SITE.'/modules/mod_flexicontent/tmpl_common/favlist.php');
	
	// Display Category Information (if enabled)
	//include(JPATH_SITE.'/modules/mod_flexicontent/tmpl_common/category.php');
	
	$ord_titles = array(
		'popular'=>JText::_( 'FLEXI_MOST_POPULAR'),
		'commented'=>JText::_( 'FLEXI_MOST_COMMENTED'),
		'rated'=>JText::_( 'FLEXI_BEST_RATED' ),
		'added'=>	JText::_( 'FLEXI_RECENTLY_ADDED'),
		'addedrev'=>JText::_( 'FLEXI_RECENTLY_ADDED_REVERSE' ),
		'updated'=>JText::_( 'FLEXI_RECENTLY_UPDATED'),
		'alpha'=>	JText::_( 'FLEXI_ALPHABETICAL'),
		'alpharev'=>JText::_( 'FLEXI_ALPHABETICAL_REVERSE'),
		'id'=>JText::_( 'FLEXI_HIGHEST_ITEM_ID'),
		'rid'=>JText::_( 'FLEXI_LOWEST_ITEM_ID'),
		'catorder'=>JText::_( 'FLEXI_CAT_ORDER'),
		'random'=>JText::_( 'FLEXI_RANDOM' ),
		'field'=>JText::_( 'FLEXI_CUSTOM_FIELD' ),
		 0=>'Default' );
	
	$separator = "";
	$rowtoggler = 0;
	$item_columns = $params->get('item_columns', 1);
	$twocols = $item_columns == 2;
	$class_slide = "active";
	// Carousel items --> ?>
    
    <?php 
	foreach ($ordering as $ord) :
  	echo $separator;
	  if (isset($list[$ord]['featured']) || isset($list[$ord]['standard'])) {
  	  $separator = "<div class='ordering_seperator' ></div>";
    } else {
  	  $separator = "";
  	  continue;
  	}
	
	
	?>
<div class="flexslider flexslider-<?php echo $flexdirection;?>" id="flexslider_<?php echo $module->id ?>">
    <div class="controller">
    <span class="slide-theme">
  	<span class="slide-theme-side slide-top-left"></span>
  	<span class="slide-theme-side slide-top-right"></span>
  	<span class="slide-theme-side slide-bottom-left"></span>
  	<span class="slide-theme-side slide-bottom-right"></span>
    </span>
    </div>
    <ul class="slides">
	
	<?php if (isset($list[$ord]['featured'])) :?>


			<?php $i          = 1;
			      $slide      = 1;
				  $slides     = array();?>		
			

			<?php foreach ($list[$ord]['featured'] as $item) : ?>
			
				<?php if( $slideritems > 1 && $i <= $slideritems ) : 
						$slides[$slide][$i] = $item;
						$i++;
				 	else: 	
				 		$slide++;
				 		$i = 1;
				 		$slides[$slide][$i] = $item;
	        	 	endif; ?>

			<?php endforeach; ?>


			
			<?php foreach ($slides as $key => $data) : ?>
	    	
	    	<li>	    	    
	        <?php foreach ( $data as $item ) : ?>			
			<!-- BOF featured  item content -->	
			    <div class="item-data row pt-2 pb-2" > 
					<?php if ($display_title_feat) : ?>
					<div class="fc_block col-12" >
						<div class="fc_inline_block fcitem_title">
							<?php if ($link_title_feat) : ?>
							<h2><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h2>
							<?php else : ?>	
							<h2><?php echo $item->title; ?></h2>
							<?php endif; ?>
						</div>
				    </div>
					<?php endif; ?>
					
					<?php if ($mod_use_image_feat && $item->image_rendered) : ?>

					<div class="image-container image_featured col-12 col-4">
						<?php if ($mod_link_image_feat) : ?>
							<a href="<?php echo $item->link; ?>"><?php echo $item->image_rendered; ?></a>
						<?php else : ?>
							<?php echo $item->image_rendered; ?>
						<?php endif; ?>
					</div>
					
					<?php elseif ($mod_use_image_feat && $item->image) : ?>
					
					<div class="image-container image_featured col-12 col-4">
						<?php if ($mod_link_image_feat) : ?>
							<a href="<?php echo $item->link; ?>"><img <?php echo $force_height_feat." ".$force_width_feat; ?> src="<?php echo $item->image; ?>" alt="<?php echo flexicontent_html::striptagsandcut($item->fulltitle, 60); ?>" /></a>
						<?php else : ?>
							<img class="img-fluid" <?php echo $force_height_feat." ".$force_width_feat; ?> src="<?php echo $item->image; ?>" alt="<?php echo flexicontent_html::striptagsandcut($item->fulltitle, 60); ?>" />
						<?php endif; ?>
					</div>
					
					<?php endif; ?>
					
					<?php if ($display_date_feat || $display_text_feat || $display_hits_feat || $display_voting_feat || $display_comments_feat || $mod_readmore_feat || ($use_fields_feat && @$item->fields && $fields_feat)) : ?>
					<div class="content_container content_featured col">
						
						<?php if ($display_date_feat && $item->date_created) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_date created icon-calendar">
								<?php echo $item->date_created; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_date_feat && $item->date_modified) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_date modified icon-calendar">
								<?php echo $item->date_modified; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_hits_feat && @ $item->hits_rendered) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_hits">
								<?php echo $item->hits_rendered; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_voting_feat && @ $item->voting) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_voting">
								<?php echo $item->voting;?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_comments_feat) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_comments">
								<?php echo $item->comments_rendered; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_text_feat && $item->text) : ?>
						<div class="fcitem_text">
							<p><?php echo $item->text; ?></p>
						</div>
						<?php endif; ?>
						
						<?php if ($use_fields_feat && @$item->fields && $fields_feat) : ?>
						<div class="fcitem_fields">
							
						<?php foreach ($item->fields as $k => $field) : ?>
							<?php if ( $hide_label_onempty_feat && !strlen($field->display) ) continue; ?>
							<div class="field_block field_<?php echo $k; ?>">
								<?php if ($display_label_feat) : ?>
								<div class="field_label"><?php echo $field->label . $text_after_label_feat; ?></div>
								<?php endif; ?>
								<div class="field_value"><?php echo $field->display; ?></div>
							</div>
						<?php endforeach; ?>
							
						</div>
						<?php endif; ?>
						
						<?php if ($mod_readmore_feat) : ?>
						<div class="fc_block">
							<div class="fcitem_readon">
								<a href="<?php echo $item->link; ?>" class="readon readon btn btn-outline-secondary"><?php echo JText::_('FLEXI_MOD_READ_MORE'); ?></a>
							</div>
						</div>
						<?php endif; ?>
						
						
						
					</div>
					<?php endif; ?>
					
		  		</div>
				
	  		<?php endforeach; ?>
			</li>
			<!--  ****************************************************  EOF current slide -->
			<?php endforeach;?>  
			
			
	<?php endif; ?>
		
	
	<?php if (isset($list[$ord]['standard'])) : ?>
		


		<?php $i          = 1;
		      $slide      = 1;
			  $slides     = array();	
		?>	

		<?php foreach ($list[$ord]['standard'] as $item) : ?>
		
			<?php if( $slideritems > 1 && $i <= $slideritems ) : 
					$slides[$slide][$i] = $item;
					$i++;
			 	else: 	
			 		$slide++;
			 		$i = 1;
			 		$slides[$slide][$i] = $item;
        	 	endif; ?>

		<?php endforeach; ?>

		<!-- BOF standard items -->

	    <?php foreach ($slides as $key => $data) : ?>
	    	<li>	    	    
	       <?php foreach ( $data as $item ) : ?>
	           <div class="item-data row pt-2 pb-2" > 
                 					<?php if ($display_title) : ?>
					<div class="fc_block col-12" >
						<div class="fc_inline_block fcitem_title">
							<?php if ($link_title) : ?>
							<h2><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h2>
							<?php else : ?>	
						  <h2><?php echo $item->title; ?></h2>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
					

					<?php if ($mod_use_image && $item->image_rendered) : ?>
					<div class="image-container image_standard col-12 col-sm-4">
						<?php if ($mod_link_image) : ?>
							<a href="<?php echo $item->link; ?>"><?php echo $item->image_rendered; ?></a>
						<?php else : ?>
							<?php echo $item->image_rendered; ?>
						<?php endif; ?>
					</div>
					
					<?php elseif ($mod_use_image && $item->image) : ?>
					
					<div class="image-container image_standard col-12 col-sm-4">
						<?php if ($mod_link_image) : ?>
							<a href="<?php echo $item->link; ?>"><img <?php echo $force_height." ".$force_width; ?> src="<?php echo $item->image; ?>" alt="<?php echo flexicontent_html::striptagsandcut($item->fulltitle, 60); ?>" /></a>
						<?php else : ?>
							<img class="img-fluid" <?php echo $force_height." ".$force_width; ?> src="<?php echo $item->image; ?>" alt="<?php echo flexicontent_html::striptagsandcut($item->fulltitle, 60); ?>" />
						<?php endif; ?>
					</div>
					
					<?php endif; ?>
					
				<?php if ($display_date || $display_text || $display_hits || $display_voting || $display_comments || $mod_readmore || ($use_fields && @$item->fields && $fields)) : ?>
					<div class="content_standard col">
						
						<?php if ($display_date && $item->date_created) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_date created icon-calendar">
								<?php echo $item->date_created; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_date && $item->date_modified) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_date modified icon-calendar ">
								<?php echo $item->date_modified; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_hits && @ $item->hits_rendered) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_hits">
								<?php echo $item->hits_rendered; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_voting && @ $item->voting) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_voting">
								<?php echo $item->voting;?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_comments) : ?>
						<div class="fc_block">
							<div class="fc_inline fcitem_comments">
								<?php echo $item->comments_rendered; ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if ($display_text && $item->text) : ?>
						<div class="fcitem_text">
							<p><?php echo $item->text; ?></p>
						</div>
						<?php endif; ?>
						
						<?php if ($use_fields && @$item->fields && $fields) : ?>
						<div class="fcitem_fields">
							
						<?php foreach ($item->fields as $k => $field) : ?>
							<?php if ( $hide_label_onempty && !strlen($field->display) ) continue; ?>
							<div class="field_block field_<?php echo $k; ?>">
								<?php if ($display_label) : ?>
								<div class="field_label"><?php echo $field->label . $text_after_label; ?></div>
								<?php endif; ?>
								<div class="field_value"><?php echo $field->display; ?></div>
							</div>
							<?php endforeach; ?>
							
						</div>
						<?php endif; ?>
						
						<?php if ($mod_readmore) : ?>
						<div class="mt-3 fc_block">
							<div class="fcitem_readon">
								<a href="<?php echo $item->link; ?>" class="readon btn btn-outline-secondary"><?php echo JText::_('FLEXI_MOD_READ_MORE'); ?></a>
							</div>
						</div>
						<?php endif; ?>

						
						
					</div> 
					<?php endif; ?>
					
				</div>

				<div class="mb-3 mt-3 wbc-line"></div> 
			<?php endforeach; ?>
			</li>
			<!--  ****************************************************  EOF current slide -->
			<?php endforeach;?>  
			
	
	<?php endif; ?>

	<?php endforeach; ?>
	
	</ul>
    
    
</div>

	<?php
	// Display readon of module
	include(JPATH_SITE.'/modules/mod_flexicontent/tmpl_common/readon.php');
	?>

	
