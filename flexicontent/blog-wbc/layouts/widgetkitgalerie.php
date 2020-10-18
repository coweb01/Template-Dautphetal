<?php 
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * displaydata: 
 * 		object $this->params
 * 		object $this->item
 *
 */

defined('JPATH_BASE') or die;


extract($displayData);


// Galerie Parameter
$field_galerie       = $params->get('select_galerie');
$galerie_gutter      = $params->get('galerie_gutter',5);
$galerie_delay       = $params->get('galerie_delay',300);
$galerie_cols        = $params->get('galerie_cols',4);
$galerie_image_title = $params->get('galerie_image_title');

FlexicontentFields::getFieldDisplay($item, $field_galerie, null, 'display_large', 'item');
$image_field     = $item->fields[$field_galerie];
$image_arr	     = array();
$count           = count( $image_field->thumbs_src['original']);
for($i=0; $i < $count; $i++) {
	  $image_arr[$i]['medium']       = $image_field->thumbs_src['medium'][$i];
	  $image_arr[$i]['large']        = $image_field->thumbs_src['large'][$i];
	  $image_arr[$i]['original']     = $image_field->thumbs_src['original'][$i]; 
	  
	  //$image_value                   = unserialize($image_field->value[$i]);
 
	  $image_arr[$i]['originalname'] = $image_field->value[$i]['originalname'];
	  $image_arr[$i]['title']        = $image_field->value[$i]['title'];
	  
	  if (isset($image_field->value[$i]['desc'])) {
	  	  	$image_arr[$i]['desc']     = ( $image_field->value[$i]['alt'] > '' ) ? $image_field->value[$i]['desc'] : '';      
	  }
	  if (isset($image_field->value[$i]['alt'])) {
	  		$image_arr[$i]['alt']          = ( $image_field->value[$i]['alt'] > '' ) ? $image_field->value[$i]['alt'] : htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8');
	  }
  }
?>


<div id="wk-grid-<?php echo $item->id; ?>" class="wbc-galerie uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-<?php echo $galerie_cols;?> uk-grid-width-large-1-<?php echo $galerie_cols;?> uk-grid-width-xlarge-1-<?php echo $galerie_cols;?> " data-uk-grid-match="{target:'> div > .uk-panel', row:true}" data-uk-grid="{gutter: '<?php echo $galerie_gutter;?>'}"  data-uk-scrollspy="{cls:'uk-animation-scale-up uk-invisible', target:'> div > .uk-panel', delay:<?php echo $galerie_delay;?>}"> 
    
	<?php foreach ($image_arr as  $image) : ?>
	
	<div>		    
		<div class="uk-panel uk-invisible">
	    	<div class="uk-panel-teaser">
	        	<figure class="uk-overlay uk-overlay-hover uk-cover-background">						
					<img src="<?php echo $image['large'];?>" class="uk-overlay-scale" alt="<?php echo $image['alt'];?>" >
					<div class="uk-overlay-panel uk-overlay-background uk-overlay-fade"></div>
                    <div class="uk-overlay-panel uk-overlay-icon uk-overlay-fade"></div>
					<a class="uk-position-cover" href="<?php echo $image['large'];?>" data-lightbox-type="image" data-uk-lightbox="{group:'<?php echo 'wk-grid'.$item->id;?>'}" alt="<?php echo $image['alt'];?>" <?php echo ($image['title'] > '' ) ? 'title="'. $image['title']. '"' : '' ;?>></a>
											
				</figure>
				<?php if ( $galerie_image_title == 1 && $image['title'] > '' ) :?>
					<div class="wbc-galerie-panel-titel p-3">
						<p class="uk-4 h4 text-center pt-2 pb-2 "><?php echo $image['title'];?></p>
						<?php  echo ( isset( $image['desc'] ) ) ? '<p>'. $image['desc'] .'</p>' : '';?>
					</div>
				<?php endif; ?>	
			</div>
		</div>
	</div>			
	<?php endforeach; ?>

</div>