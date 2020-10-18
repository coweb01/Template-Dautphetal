<?php
/**
 * @version 1.5 stable $Id: category_items.php 1033 2011-12-08 08:58:02Z enjoyman@gmail.com $
 * @package Joomla
 * @subpackage FLEXIcontent
 * @copyright (C) 2009 Emmanuel Danan - www.vistamedia.fr
 * @license GNU/GPL v2
 * 
 * FLEXIcontent is a derivative work of the excellent QuickFAQ component
 * @copyright (C) 2008 Christoph Lukes
 * see www.schlu.net for more information
 *
 * FLEXIcontent is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *  Personenverzeichniss    HTML 5 Variante
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
// first define the template name
$tmpl                  = $this->tmpl;
//var_dump($tmpl);
$app                   = JFactory::getApplication();
$doc                   = JFactory::getDocument();
$template              = $app->getTemplate(); 
$currcatid             = $this->category->id; // Nr. der Hauptkategorie
$rowclass              = '';
$img_style             = '';
$fields_align          = '';
$tmpl_cols_lg          = $this->params->get('tmpl_cols', 1);
$tmpl_cols_md          = $this->params->get('tmpl_cols_sm', 1);
$tmpl_cols_xs          = $this->params->get('tmpl_cols_xs', 1);
$intro_use_image       = $this->params->get('intro_use_image', 1);
$intro_link_image_to   = $this->params->get('intro_link_image_to', 0);
$intro_use_description = $this->params->get('intro_use_description', 1);
$grid_framework        = $this->params->get('grid_framework', 1);

$img_style_intro       = ( $this->params->get('intro_item_image_style') ) ? $this->params->get('intro_item_image_style') : '';

switch  ( $grid_framework  ) {

		case 0: $img_style    = '';   /* Flexicontent */
		        $img_class    = '';
				$img_position = '';
				break;
		case 1: $img_style    = 'img-';   /* bootstrap */
		        $img_class    = 'img-fluid ';
				$img_position = ' float-';
				break;			
		case 2: $img_style    = 'uk-border-';
				$img_class    = 'uk-thumbnail ';
				$img_position = ' uk-align-';   /*  Uikit */
				break;
} 

$inlineStyle = '#flexicontent .itemblock .card-columns {
   		column-count: '. $tmpl_cols_xs .';
		}
@media only screen and (min-width: 769px) {

	#flexicontent .itemblock .card-columns {
   		column-count: '. $tmpl_cols_md .';
		}
}		
@media only screen and (min-width: 992px) {

	#flexicontent .itemblock .card-columns {
   		column-count: '. $tmpl_cols_lg .';
		}
}';
$doc->addStyleDeclaration($inlineStyle);
// Ergaenzung Template Variables webconcept Bootstrap 3 Template

$grid_framework  = $this->params->get('grid_framework', 1);


$arr_cols_gridclasses   	=   array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-4',4=>'col-md-3'),
           					    array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-1-3',4=>'uk-width-large-1-4')
           					  );

$arr_cols_gridclasses_sm    =   array(
								array(1=>'col-md-12',2=>'col-md-6',3=>'col-md-4'),
  								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-1-3')
  								);
$arr_cols_gridclasses_lg    =   array(
								array(1=>'col-xl-12',2=>'col-xl-6',3=>'col-xl-4'),
  								array(1=>'uk-width-xlarge-1-1',2=>'uk-width-xlarge-1-2',3=>'uk-width-xlarge-1-3')
  								);

$arr_cols_gridclasses_xs   	=   array(
								array(1=>'col-12',2=>'col-6',3=>'col-4'),
  								array(1=>'uk-width-small-1-1',2=>'uk-width-small-1-2',3=>'uk-width-small-1-3')
  								);

$arr_cols_gridclasses_dbl  	=   array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-8',4=>'col-md-6'),
								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-2-3',4=>'uk-width-medium-2-4')
								);
$arr_cols_gridclasses_dbl_lg  	= array(
								array(1=>'col-xl-12',2=>'col-xl-6',3=>'col-xl-8',4=>'col-lg-6'),
								array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-2-3',4=>'uk-width-large-2-4')
								);


	if ( $grid_framework == 1 ) :
			$cols_gridclasses         = $arr_cols_gridclasses[0];
			$cols_gridclasses_sm      = $arr_cols_gridclasses_sm[0];
			$cols_gridclasses_xs      = $arr_cols_gridclasses_xs[0];
			$cols_gridclasses_lg      = $arr_cols_gridclasses_lg[0];
			$cols_gridclasses_dbl     = $arr_cols_gridclasses_dbl[0];
			$cols_gridclasses_dbl_lg  = $arr_cols_gridclasses_dbl_lg[0];

    endif;

	if ( $grid_framework == 2 ) :
			$cols_gridclasses         = $arr_cols_gridclasses[1];
			$cols_gridclasses_sm      = $arr_cols_gridclasses_sm[1];
			$cols_gridclasses_lg      = $arr_cols_gridclasses_lg[1];
			$cols_gridclasses_xs      = $arr_cols_gridclasses_xs[1];
			$cols_gridclasses_dbl     = $arr_cols_gridclasses_dbl[1];
			$cols_gridclasses_dbl_lg  = $arr_cols_gridclasses_dbl_lg[1];
    endif;


if ($intro_use_image ) {

    if ( $img_style_intro != 'thumbnail') {
    		$img_style    .= $img_style_intro;
		
		} else {
			if ( $grid_framework == 2 )  { 
	      		$img_style = '';	
	  		} else {
	  			$img_style .= $img_style_intro; }
	} 

    switch  ( $this->params->get('intro_position',1) ) {
    		case 0: $img_position .= "left mr-md-3 mb-3";
    				break;
    		case 1: $img_position .= "right ml-md-3 mb-3";
    				break;			
    		case 2: $img_position .= "none mb-3";
    				break;
    }

	if ( $this->params->get('intro_image') ) {
		$img_size_map   = array('l'=>'large', 'm'=>'medium', 's'=>'small', 'o'=>'original');
		$img_field_size = $img_size_map[ $this->params->get('intro_image_size' , 'l') ];
		$img_field_name = $this->params->get('intro_image');
	}


}


// end webconcept 

// MICRODATA 'itemtype' for ALL items in the listing (this is the fallback if the 'itemtype' in content type / item configuration are not set)
$microdata_itemtype_cat = $this->params->get( 'microdata_itemtype_cat', 'Article' );
?>

<?php

ob_start();
include(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'listings_filter_form_html5.php');
$filter_form_html = trim(ob_get_contents());
ob_end_clean();

if ( $filter_form_html )
{
	echo '
	<div class="fcclear"></div>
	<aside class="group">
		' . $filter_form_html . '
	</aside>';
}

?>

<?php
if ($this->items) :   // sind Beiträge vorhanden 
	$items = & $this->items;
	
	$_read_more_about = JText::_( 'FLEXI_READ_MORE_ABOUT' );
	$tooltip_class = FLEXI_J30GE ? 'hasTooltip' : 'hasTip';
	$_comments_container_params = 'class="fc_comments_count '.$tooltip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_NUM_OF_COMMENTS', 'FLEXI_NUM_OF_COMMENTS_TIP', 1, 1).'"';

	if ( $this->params->get('display_subcategories_items',1) == 0 ) :  // Abfrage ob Unterkategorien mit angezeigt werden sollen, wenn nein
		$cat_items[$currcatid] = array();  // nur Artikel der Haupkategorie sammeln
		
		
		for ($i=0; $i<count($items); $i++) :
			foreach ($items[$i]->cats as $cat) :
				if (isset($cat_items[$cat->id])) :
					$cat_items[$cat->id][] = & $items[$i];
				endif;
			endforeach;
		endfor;
	else :	
	  
	
	$currcatid = $this->category->id; // Nr. der Hauptkategorie
	$cat_items[$currcatid] = array();  //Array init Artikel der Hauptkategorie 
	$sub_cats[$currcatid] = & $this->category; // Artikel in den Unterkategorien sammeln
	
	// $this->categories   = Unterkategorien

	foreach ($this->categories as $subindex => $sub) :  // alle Unterkategorien sammeln
		$cat_items[$sub->id] = array();
		$sub_cats[$sub->id] = & $this->categories[$subindex];		
	endforeach;


	//$items = & $this->items;
	/*$vglcat = 0;
	for ($i=0; $i<count($items); $i++) :
		//var_dump($items[$i]->cats);
		foreach ($items[$i]->cats as $cat) :
			
		  $cat_items[$cat->id] = array();
		  if ($vglcat != $cat->id) :
	      $sub_cats[$cat->id] =  $cat;
		  $vglcat = $cat->id;
		  endif;
		endforeach;
	endfor;*/

	// Artikel der Unterkategorien gruppieren

	for ($i=0; $i<count($items); $i++) :

		foreach ($items[$i]->cats as $cat) :
			if (isset($cat_items[$cat->id])) :
				$cat_items[$cat->id][] = & $items[$i];
			endif;
		endforeach;
		
	endfor;

 endif;

// routine to determine all used columns for this table
	$layout = $this->params->get('clayout', 'default');
	$fbypos	= flexicontent_tmpl::getFieldsByPositions($layout, 'category');
	$columns['line1'] = array();
	$columns['line2'] = array();
	$columns['line3'] = array();
	$columns['line4'] = array();
	$columns['titlezeile'] = array();

	foreach ($this->items as $item) :
		
		if (isset($item->positions['titlezeile']) || !empty($item->positions['titlezeile']) ) :
			foreach ($fbypos['titlezeile']->fields as $f) :
				if (!in_array($f, $columns['titlezeile'])) :
					$columns['titlezeile'][$f] = @$item->fields[$f]->label;
				endif;
			endforeach;
		endif;
		
		if (isset($item->positions['line1'])) :
			foreach ($fbypos['line1']->fields as $f) :
				if (!in_array($f, $columns['line1'])) :
					$columns['line1'][$f] = @$item->fields[$f]->label;
				endif;
			endforeach;
		endif;
		
		if (isset($item->positions['line2'])) :
			foreach ($fbypos['line2']->fields as $f) :
				if (!in_array($f, $columns['line2'])) :
					$columns['line2'][$f] = @$item->fields[$f]->label;
				endif;
			endforeach;
		endif;
		
		if (isset($item->positions['line3'])) :
			foreach ($fbypos['line3']->fields as $f) :
				if (!in_array($f, $columns['line3'])) :
					$columns['line3'][$f] = @$item->fields[$f]->label;
				endif;
			endforeach;
		endif;
		
		if (isset($item->positions['line4'])) :
			foreach ($fbypos['line4']->fields as $f) :
				if (!in_array($f, $columns['line4'])) :
					$columns['line4'][$f] = @$item->fields[$f]->label;
				endif;
			endforeach;
		endif;

		
	endforeach;
/*
$classnum = '';
if ($grid_framework == 0 ) :
	if ($this->params->get('tmpl_cols', 1) == 1) :
	   $classnum = 'one';
	elseif ($this->params->get('tmpl_cols', 1) == 2) :
	   $classnum = 'two';
	endif;
endif;*/
?>

		
<section>
<div class="itemblock">	

<?php


global $globalcats;
$count_cat = -1;
foreach ($cat_items as $catid => $items) :
	
	if(isset( $sub_cats[$catid])) {
		$sub 		        = & $sub_cats[$catid];
		$subcatid 	        = $sub->id;
		$subcatdescription  = $sub->description;
		$subcatimage        = $sub->image;
		$subcattitle        = $sub->title;
	    //var_dump($sub);
	}
	if (count($items)==0) continue;
	if ($catid!=$currcatid) $count_cat++;
	?>
		<div class="category-full">		
        <header class="categorie flexi-cat">

            <?php if ($this->params->get('sub_cat_title', 1)) : ?>  		
			<h2 class="cattitle"><?php echo $subcattitle;?></h2>
	        <?php endif; ?>  	

	        <?php if (!empty($subcatdescription) && $this->params->get('sub_cat_description', 1) && $count_cat > -1 ) : ?>
	        <div class="catdescription">
				<?php	echo $subcatdescription; ?>
			</div>
			<?php endif; ?>
			
			<?php if (!empty($subcatimage) && $this->params->get('show_sub_description_image', 1)) : ?>
			<figure class="catimg">
				<?php $subcatimage; ?>   
			</figure>
			<?php endif; ?>	
	      	
								
		</header>

			
<?php
	if (!$this->params->get('show_title', 1) && $this->params->get('limit', 0) && !count($columns['line2'])) :
		//echo "<span style='font-weight:bold; color:red;'>No columns selected forcing the display of item title. Please:<br>\n
		//1. enable display of item title in category parameters<br>\n
		//2. OR add fields to the category Layout of the template assigned to this category<br>\n
		//3. OR set category parameters to display 0 items per page</span>";
		$this->params->set('show_title', 1);
	endif;
?>



<?php if ( $this->params->get('show_title', 1) || count($columns['line2']) || count($columns['titlezeile']) || count($columns['line1']) || count($columns['line3']) || count($columns['line4']) ) : ?>
		 
		<article class="item item-flex">
        <div class='flexi-itemlist  <?php echo ( $grid_framework > 0 ) ? 'card-columns' : ''; ?> '>


      <?php if ( $grid_framework > 0 ) : 
					
					// grid 3 phone
					$gridclass     = $cols_gridclasses_xs[$tmpl_cols_xs]. ' ';
					
					// grid 3 cols tablet
	     			$gridclass     .= $cols_gridclasses_sm[$tmpl_cols_md] . ' ';

					// grid desktop
					$gridclass     .= $cols_gridclasses[$tmpl_cols_lg];
			endif;?>

	    <?php $count_items = 0;
		 foreach ($items as $item) : // Schleife für Artikel 
		 	if($item->state!=-2) : 
			$count_items ++; 
		
			// MICRODATA document type (itemtype) for each item
			// -- NOTE: category's microdata itemtype is fallback if the microdata itemtype of the CONTENT TYPE / ITEM are not set
			$microdata_itemtype = $item->params->get( 'microdata_itemtype') ? $item->params->get( 'microdata_itemtype') : $microdata_itemtype_cat;
			$microdata_itemtype_code = $microdata_itemtype ? 'itemscope itemtype="http://schema.org/'.$microdata_itemtype.'"' : '';?>
		

			<div class="card flexi-item background-primary " <?php echo $microdata_itemtype_code; ?> style="overflow: hidden;">
			<div class="card-body grid-content <?php echo ($count_items%2 ? 'even' : 'odd'); ?>">
				  
		  <?php if ($this->params->get('show_editbutton', 0)) : ?>
				<?php $editbutton = flexicontent_html::editbutton(  $item, $this->params );?> 
				<?php $statebutton = flexicontent_html::statebutton( $item, $this->params );?>
				<?php $deletebutton = flexicontent_html::deletebutton( $item, $this->params ); ?>
				<?php $approvalbutton = flexicontent_html::approvalbutton( $item, $this->params ); ?>
				
				<?php if ($editbutton || $statebutton || $deletebutton || $approvalbutton) : ?>
					<div class="adminbuttons d-flex">
						<div><?php echo $editbutton;?></div>
						<div><?php echo $statebutton;?></div>
						<?php if ($deletebutton) : ?>
						<div><?php echo $deletebutton;?></div>
						<?php endif; ?>
						<?php if ($approvalbutton) : ?>
						<div><?php echo $approvalbutton;?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
			<?php endif; ?>
            
            <?php if ($item->event->beforeDisplayContent) : ?>
                  <div class='fc_beforeDisplayContent' style='clear:both;'>
                      <?php echo $item->event->beforeDisplayContent; ?>
                  </div>
              <?php endif; ?>
              
			  <?php if ($this->params->get('show_title', 0)) : ?>
              <h3 class="card-title fc_item_title" itemprop="name">
	          	
	            <?php if ($this->params->get('link_titles', 0)) : ?>
	            <a href="<?php echo JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug)); ?>"><?php echo $item->title; ?></a>
	              <?php
	            else :
	              echo $item->title;
	            endif;
	            ?>
              
              </h3>
              <?php endif; ?>

              <?php 
             	$custom_link = null;
             	
             	
				if ($intro_use_image) :


					if (!empty($img_field_name))
					{
												

						// Render method 'display_NNNN_src' to avoid CSS/JS being added to the page
						FlexicontentFields::getFieldDisplay($item, $img_field_name, $values=null, $method='display_'.$img_field_size.'_src', 'category');
						if (isset($item->fields[$img_field_name])) {
							$img_field = $item->fields[$img_field_name];
						}
						$src = str_replace(JURI::root(), '', @ $img_field->thumbs_src[$img_field_size][0] );
						if ( $intro_link_image_to && isset($img_field->value[0]) ) {
							$custom_link = ($v = unserialize($img_field->value[0])) !== false ? @ $v['link'] : @ $img_field->value[0]['link'];
						}
					} else {
						$src = flexicontent_html::extractimagesrc($item);
					}

							
					
					$RESIZE_FLAG = !$this->params->get('intro_image') || !$this->params->get('intro_image_size');
					if ( $src && $RESIZE_FLAG ) {
						// Resize image when src path is set and RESIZE_FLAG: (a) using image extracted from item main text OR (b) not using image field's already created thumbnails
						$w		= '&amp;w=' . $this->params->get('intro_width', 200);
						$h		= '&amp;h=' . $this->params->get('intro_height', 200);
						$aoe	= '&amp;aoe=1';
						$q		= '&amp;q=95';
						$zc		= $this->params->get('intro_method') ? '&amp;zc=' . $this->params->get('intro_method') : '';
						$ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
						$f = in_array( $ext, array('png', 'ico', 'gif') ) ? '&amp;f='.$ext : '';
						$conf	= $w . $h . $aoe . $q . $zc . $f;
						
						$base_url = (!preg_match("#^http|^https|^ftp|^/#i", $src)) ?  JURI::base(true).'/' : '';
						$thumb = JURI::base(true).'/components/com_flexicontent/librairies/phpthumb/phpThumb.php?src='.$base_url.$src.$conf;
					} else {
						// Do not resize image when (a) image src path not set or (b) using image field's already created thumbnails
						$thumb = $src;
					}
				endif;

			$link_url = $custom_link ? $custom_link : JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug, 0, $item));
			$title_encoded = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
				
			
            <?php  // Position Title
			if (isset ( $item->positions['titlezeile'] )) :
				if (count ($columns['titlezeile'] )) : ?>
				<div class="wrap-title">
				<?php foreach ($columns['titlezeile'] as $name => $label) : // alle felder von position auflisten 
					if (isset($item->positions['titlezeile']->{$name}->display)) : ?>
					<div class='flexi-field title-zeile field_<?php echo $item->fields[$name]->name; ?>'>
					<?php $label_str = '';
						if ($item->fields[$name]->parameters->get('display_label', 0)) :
							$label_str = $label.': ';?>
							<div class="label label_field_<?php echo $item->fields[$name]->name; ?>"><?php echo $label_str;?>&nbsp;</div>
						<?php endif; ?>
	
						<?php if (isset($item->positions['titlezeile']->{$name}->display)) :?>
							<div class="value value_<?php echo $item->fields[$name]->name; ?>"><?php echo $item->positions['titlezeile']->{$name}->display; ?></div>
							<?php endif; ?>
					</div>
						<?php endif; ?>
				<?php endforeach; ?>
				</div>
				<?php endif; ?>
            <?php endif; ?>
 

	        <div class="lineinfo image_descr">
	        <?php if ($intro_use_image && $src) : ?>
				<figure class="image <?php echo $img_position; ?>">
					<?php if ($this->params->get('intro_link_image', 1)) : ?>
					<a href="<?php echo $link_url; ?>">
						<img src="<?php echo $thumb; ?>" alt="<?php echo $title_encoded; ?>" class="<?php echo $img_class . $img_style; ?>  <?php echo $tooltip_class;?>" title="<?php echo flexicontent_html::getToolTip($_read_more_about, $title_encoded, 0, 0); ?>"/>
					</a>
					<?php else : ?>
						<img src="<?php echo $thumb; ?>" class="<?php echo $img_class . $img_style;  ?>" alt="<?php echo $title_encoded; ?>" title="<?php echo $title_encoded; ?>" />
					<?php endif; ?>
				</figure>
			<?php endif; ?>
		
				
		<?php
		 if (  ( isset ( $item->positions['titlezeile'] )  && count ($columns['titlezeile']) )
		     || ( isset ( $item->positions['line2'] ) && count ($columns['line2']) )
			 || ( isset ( $item->positions['line1'] ) && count ($columns['line1']) )
			 || ( isset ( $item->positions['line3'] ) && count ($columns['line3']) )
			 || ( isset ( $item->positions['line4'] ) && count ($columns['line4']) )
			  ) : ?>
		  

		  <?php if ( $intro_use_image && $src ) : 
			
				$fields_align = 'left';
				if  ( $grid_framework  == 2 ) { $fields_align = 'uk-align-left'; }
				if  ( $grid_framework  == 1 ) { $fields_align = 'float-md-left mr-md-3 mb-3'; }

		  endif; ?>

		  <div class='flexi-fieldlist <?php echo $fields_align; ?>'>
				
			   <?php
                if ($item->event->afterDisplayTitle) : ?>
                    <div class='fc_afterDisplayTitle' style='clear:both;'>
                    <?php echo $item->event->afterDisplayTitle; ?>
                    </div>
                <?php endif; ?>
			
              
                   <div class="<?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?> ">
                   

              <?php 
              		if ( $grid_framework > 0 ) :

	              		if ( isset ($item->positions['line4']) && !$intro_use_image  ) : 
							
						$rowclass     .= $cols_gridclasses_xs[1]. ' ';					
						$rowclass     .= $cols_gridclasses_sm[2] . ' ';				
						$rowclass      = $cols_gridclasses[2];

						else: 
					    
						$rowclass     .= $cols_gridclasses_xs[1]. ' ';						
						$rowclass     .= $cols_gridclasses_sm[1] . ' ';
						$rowclass      = $cols_gridclasses[1];

				        endif;

		          	endif;?>	

                <div <?php echo $grid_framework > 0 ? 'class="'.$rowclass.'"' : '';?>>
                      <?php if ( isset ( $item->positions['line1'] ) && count ($columns['line1']) ) : ?>
                      <div class="wrap-line1">
                      <?php   // Position Line 1
                      foreach ($columns['line1'] as $name => $label) : // alle felder von position auflisten 
                          if (isset($item->positions['line1']->{$name}->display)) : ?>
                          <div class='flexi-field line-1a field_<?php echo $item->fields[$name]->name; ?>'>
                          <?php $label_str = '';
                              if ($item->fields[$name]->parameters->get('display_label', 0)) :
                                  $label_str = $label.': ';?>
                                  <div class="label label_field_<?php echo $item->fields[$name]->name; ?>"><?php echo $label_str;?>&nbsp;</div>
                              <?php endif; ?>
          
                              <?php if (isset($item->positions['line1']->{$name}->display)) :?>
                                  <div class="value value_<?php echo $item->fields[$name]->name; ?>"><?php echo $item->positions['line1']->{$name}->display; ?></div>
                                  <?php endif; ?>
                          </div>
                              <?php endif; ?>
	                  <?php endforeach; ?>
	                  </div>
	                  <?php endif; ?>
                      
       
                      <?php // Vorname und Name feste Position     ?>
                      <?php
                       if ( isset ( $item->fields['prename_1'] ) || isset ( $item->fields['name_1'] ) ) :
                           if ($item->fields['prename_1']->display || $item->fields['name_1']->display ) :  ?>
                              <div class='flexi-field flexi-name'>
                              <span><?php echo $item->fields['prename_1']->display;?></span>
                              <?php if ($item->fields['name_1'] ) :?>
                              <span><?php echo $item->fields['name_1']->display;?></span>
                              <?php endif;?>
                              </div>
                          <?php endif;?>
                      <?php endif;?>
                       
                      <?php
                       if ( isset ( $item->fields['prename_2'] ) || isset ( $item->fields['name_2'] ) ) :
                           if ($item->fields['prename_2']->display || $item->fields['name_2']->display ) :?>
                              <div class='flexi-field flexi-name'>
                              <span><?php echo $item->fields['prename_2']->display;?></span>
                              <?php if ($item->fields['name_2'] ) :?>
                              <span><?php echo $item->fields['name_2']->display;?></span>
                              <?php endif;?>
                              </div>
                          <?php endif;?>
                      <?php endif;?>
                          
                  
                     <?php if (isset ( $item->positions['line2'] ) && count ($columns['line2']) ) : ?>
                     <div class="wrap-line2">
                      <?php // Position Line 2
                      foreach ($columns['line2'] as $name => $label) : // alle felder von position auflisten
                          if (isset($item->positions['line2']->{$name}->display)) : ?>
                          <div class='flexi-field line-2 field_<?php echo $item->fields[$name]->name; ?>'>
                          <?php $label_str = '';
                              if ($item->fields[$name]->parameters->get('display_label', 0)) :
                                  $label_str = $label.': ';?>
                                  <div class="label label_field_<?php echo $item->fields[$name]->name; ?>"><?php echo $label_str;?>&nbsp;</div>
                              <?php endif; ?>
          
                              <?php if (isset($item->positions['line2']->{$name}->display)) :?>
                                  <div class="value value_<?php echo $item->fields[$name]->name; ?>"><?php echo $item->positions['line2']->{$name}->display; ?></div>
                                  <?php endif; ?>
                          </div>
                          <?php endif; ?>
                      <?php endforeach; ?>
                     </div>
                     <?php endif; ?>
                     
                     <?php  if (  isset ( $item->positions['line3'] ) && count ($columns['line3']) ) : ?>
                     <div class="wrap-line3">
	                 <?php // Position Line 3
	                  foreach ($columns['line3'] as $name => $label) : // alle felder von position auflisten
	                      if (isset($item->positions['line3']->{$name}->display)) : ?>
	                      <div class='flexi-field line-3 field_<?php echo $item->fields[$name]->name; ?>'>
	                      <?php $label_str = '';
	                          if ($item->fields[$name]->parameters->get('display_label', 0)) :
	                              $label_str = $label.': ';?>
	                              <div class="label label_field_<?php echo $item->fields[$name]->name; ?>"><?php echo $label_str;?>&nbsp;</div>
	                          <?php endif; ?>
	      
	                          <?php if (isset($item->positions['line3']->{$name}->display)) :?>
	                              <div class="value value_<?php echo $item->fields[$name]->name; ?>"><?php echo $item->positions['line3']->{$name}->display; ?></div>
	                              <?php endif; ?>
	                      </div>
	                      <?php endif; ?>
	                 <?php endforeach; ?>
	                 </div>
	                 <?php endif; ?>
	                 <div class="clearfix"></div>
	                 </div> <!-- end  1. spalte -->
              
                     <?php if (isset ( $item->positions['line4'] ) && count ($columns['line4']) ) : ?>
                     <div <?php echo $grid_framework > 0 ? 'class="'.$rowclass.'"' : ''?>>
                     <div class="wrap-line4">
                      <?php // Position Line 4
                      foreach ($columns['line4'] as $name => $label) : // alle felder von position auflisten
                          if (isset($item->positions['line4']->{$name}->display)) : ?>
                          <div class='flexi-field line-4 field_<?php echo $item->fields[$name]->name; ?>'>
                          <?php $label_str = '';
                              if ($item->fields[$name]->parameters->get('display_label', 0)) :
                                  $label_str = $label.' ';?>
                                  <div class="label label_field_<?php echo $item->fields[$name]->name; ?>"><?php echo $label_str;?>&nbsp;</div>
                              <?php endif; ?>
          
                              <?php if (isset($item->positions['line4']->{$name}->display)) :?>
                                  <div class="value value_<?php echo $item->fields[$name]->name; ?>"><?php echo $item->positions['line4']->{$name}->display; ?></div>
                                  <?php endif; ?>
                          </div>
                          <?php endif; ?>
                      <?php endforeach; ?>
                      </div>
                      <div class="clearfix"></div>
                      </div>                
                     <?php endif; ?>
    
                     <?php if ($item->event->afterDisplayContent) : ?>
                        <div class='afterDisplayContent clearfix' >
                            <?php echo $item->event->afterDisplayContent; ?>
                        </div> 
                    <?php endif; ?>
                     
                    
                    </div>
                </div>
             <?php endif; //  ende zusatzfelder?>     
               </div>
               
               <?php if ($this->params->get('tmpl_cols') == 2 && $grid_framework == 1 ):  ?>
			  		 <?php if ($count_items%2 != 0) { ?><div class="separator"></div><?php }  ?>
               <?php endif; ?>
                  
			   </div>
			   </div>

			  
          <?php endif; ?> 
	  <?php endforeach; ?>

           </div></article>
		  <?php  endif; ?>
	
		</div>
		
<?php endforeach; ?>

</div></section>

<?php elseif ((($this->params->get('use_filters', 0)) && $this->filters) || ($this->params->get('use_search')) || ($this->params->get('show_alpha', 1))) : ?>
	       <div class="noitems"><?php echo JText::_( 'FLEXI_SELECT_NO_ITEMS_CAT' ); ?></div>
		<?php elseif ($this->getModel()->getState('limit')) : // Check case of creating a category view without items ?>
	       <div class="noitems"><?php echo JText::_( 'FLEXI_NO_ITEMS_CAT' ); ?></div>
<?php endif; ?>
