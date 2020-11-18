<?php
/**
 * @version 1.5 stable $Id: item_html5.php 0001 2012-09-23 14:00:28Z Rehne $
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
 * Beitragsansicht Tab HTML5
 * Author C.Oerter
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\String\StringHelper;
// first define the template name
$tmpl            = $this->tmpl; // for backwards compatiblity
$app             = JFactory::getApplication();
$template        = $app->getTemplate(); 
$menu            = $app->getMenu()->getActive();
$menuparams      = $app->getParams(); //Parameter Menue
$bottom_cols     = $this->params->get('bottom_cols', 1);

// Grid Framework Haupttemplate

$grid_framework  = $this->params->get('grid_framework', 1);



// Layout Widgetkit Fotogalerie 

$field_galerie  = $this->params->get('select_galerie');

$widgetkit     = new JLayoutFile('templates.widgetkitgalerie', JPATH_ROOT .'/components/com_flexicontent/layouts');

$data          = array(
				  'params' => $this->params,
				  'item'   => $this->item
);


// Widgetkit Fotogalerie 

$field_galerie  = $this->params->get('select_galerie');

// Find if Gallerie is placed via template position
$_galerie_via_pos = false;
if (isset($this->item->positions) && is_array($this->item->positions)) {
	foreach ($this->item->positions as $posName => $posFields) {
		if ($posName == 'renderonly') continue;
		foreach($posFields as $field)
		 if ($field->name== 'wk_galerie') {$_galerie_via_pos = true;}
	}
}


// Bild im Fliesstext

$show_img_desc  = $this->params->get('use_item_image',0);
$img_field_name = $this->params->get('select_item_image');
$img_position   = '';
$img_style      = '';
$image_size     = $this->params->get('item_image_size','m');
$img_sizes      = array('l'=>'large', 'm'=>'medium', 's'=>'small', 'o'=>'original');
$image_size     = $img_sizes[$image_size];
 
 // Bild in Beitragtext einbinden 
if ($show_img_desc == 1 ) : 
	if ($img_field_name && FlexicontentFields::getFieldDisplay($this->item, $img_field_name, null, 'display_'. $image_size, 'item')) : 

		  $html_images     = FlexicontentFields::getFieldDisplay($this->item, $img_field_name, null, 'display_' .$image_size, 'item');
	endif;
endif;

if ($show_img_desc == 1 ) {

	if (isset($this->item->positions) && is_array($this->item->positions)) {
		foreach ($this->item->positions as $posName => $posFields) {
			
			foreach($posFields as $fieldName => $field) {
			

			if ($field->name==$img_field_name && $posName != 'renderonly') { 
				$fieldOnPosition = $posName;
				
				unset($posFields->{$field->name}); // das feld aus dem array entfernen
				
				break;
			  }
			} 
		}
	}
}

switch  ( $grid_framework ) {

	    		case 0: $img_position  = '';
	    				$img_style     = '';
	    				break;
	    		case 1: $img_position  = 'float-md-';
	    				$img_style     = 'thumbnail ';
	    				$img_style    .= ( $this->params->get('item_image_style') ) ? 'img-' . $this->params->get('item_image_style') : '';
	    				break;			
	    		case 2: $img_position  = 'uk-float-';
	    				$img_style     = 'uk-thumbnail uk-border-';
	    				$img_style    .= ( $this->params->get('item_image_style') ) ? 'border-' . $this->params->get('item_image_style') : '';
	    				break;
			    }

 switch  ( $this->params->get('item_image_position',1) ) {
			    		case 0: $img_position .= "left mr-md-3 mb-3 mt-xs-3";
			    				break;
			    		case 1: $img_position .= "right ml-md-3 mb-3 mt-xs-3";
			    				break;			
			    		case 2: $img_position .= "none mt-xs-3";
			    				break;
			    }


$img_position .= ' item-image';


// Ergaenzung Template Variables webconcept Bootstrap 4 Template


$arr_cols_gridclasses   	=  array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-4',4=>'col-lg-3'),
           					    array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-1-3',4=>'uk-width-large-1-4')
           					  );
$arr_cols_gridclasses_lg   	=  array(
								array(1=>'col-xl-12',2=>'col-xl-6',3=>'col-xl-4',4=>'col-xl-3'),
           					    array(1=>'uk-width-xlarge-1-1',2=>'uk-width-xlarge-1-2',3=>'uk-width-xlarge-1-3',4=>'uk-width-xlarge-1-4')
           					  );

$arr_cols_gridclasses_sm    = array(
								array(1=>'col-md-12',2=>'col-md-6',3=>'col-md-4'),
  								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-1-3')
  								);

$arr_cols_gridclasses_xs   	= array(
								array(1=>'col-12',2=>'col-6',3=>'col-4'),
  								array(1=>'uk-width-small-1-1',2=>'uk-width-small-1-2',3=>'uk-width-small-1-3')
  								);

$arr_cols_gridclasses_dbl  	= array(
								array(1=>'col-md-12',2=>'col-md-6',3=>'col-md-8',4=>'col-md-6'),
								array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-2-3',4=>'uk-width-large-2-4')
								);


	if ( $grid_framework == 1 ) : // Bootstrap
			$cols_gridclasses     = $arr_cols_gridclasses[0];
    endif;

	if ( $grid_framework == 2 ) : // UIKIT
			$cols_gridclasses     = $arr_cols_gridclasses[1];
    endif;

	if ( $grid_framework > 0 ) : 
		// grid desktop
		$gridclass        = $cols_gridclasses[$bottom_cols];
		else: 
			if ($bottom_cols == 1) :
				 $classnum = 'one';
			elseif ($bottom_cols == 2) :
				 $classnum = 'two';
			endif;
	endif;		


$page_classes  = '';
$page_classes .= $this->pageclass_sfx ? ' page'.$this->pageclass_sfx : '';
$page_classes .= ' items item'.$this->item->id;
$page_classes .= ' type'.$this->item->type_id;


// Fix Parameter Titel nicht gesetzt, wenn Beitrag über Frontend angelegt.
// Flexicontent Version 3.3.1.1

if  ($this->params->get('show_title') === false ) { 
	$this->params->set('show_title',JComponentHelper::getParams( 'com_flexicontent' )->get('show_title')); 
}

// ende FIX


$mainAreaTag = ( $menuparams->get( 'show_page_heading', 1 ) && $menuparams->get('page_heading') != $this->item->title && $this->params->get('show_title', 1) ) ? 'section' : 'article';
//$mainAreaTag = ( $this->params->get( 'show_page_heading', 1 ) && $this->params->get('page_heading') != $this->item->title && $this->params->get('show_title', 1) ) ? 'section' : 'article';

// SEO
$itemTitleHeaderLevel = ( $menuparams->get( 'show_page_heading', 1 ) && $menuparams->get('page_heading') != $this->item->title && $this->params->get('show_title', 1) ) ? '2' : '1'; 

$tabsHeaderLevel =	( $itemTitleHeaderLevel == 2 ) ? '3' : '2';
// Note:in Some editors like Dreamweaver will automatically set a closing tag > after </h when opening the document. So look for h>  and replaced it with h

?>


<?php echo '<'.$mainAreaTag; ?> id="flexicontent" class="wbc-flexicontent <?php echo $page_classes; ?> group" >
	
    <?php echo ( ($mainAreaTag == 'section') ? '<header>' : ''); ?>
  	
	<?php if ($this->item->event->beforeDisplayContent) : /* BOF beforeDisplayContent */ ?>
		<?php echo ( ($mainAreaTag == 'section') ? '<aside' : '<div'); ?> class="fc_beforeDisplayContent group">
			<?php echo $this->item->event->beforeDisplayContent; ?>
		<?php echo ( ($mainAreaTag == 'section') ? '</aside>' : '</div>'); ?>
	<?php endif; /* EOF beforeDisplayContent */ ?>
	
<?php if (JRequest::getCmd('print')) : ?>
		<!-- BOF Print handling -->
		<?php if ($this->params->get('print_behaviour', 'auto') == 'auto') : ?>
			<script type="text/javascript">jQuery(document).ready(function(){ window.print(); });</script>
		<?php	elseif ($this->params->get('print_behaviour') == 'button') : ?>
			<input type='button' id='printBtn' name='printBtn' value='<?php echo JText::_('Print');?>' class='btn btn-info' onclick='this.style.display="none"; window.print(); return false;'>
		<?php endif; ?>
		<!-- EOF Print handling -->
		
	<?php else : ?>
	
		<?php
		$pdfbutton = flexicontent_html::pdfbutton( $this->item, $this->params );
		$mailbutton = flexicontent_html::mailbutton( FLEXI_ITEMVIEW, $this->params, $this->item->categoryslug, $this->item->slug, 0, $this->item );
		$printbutton = flexicontent_html::printbutton( $this->print_link, $this->params );
		$editbutton = flexicontent_html::editbutton( $this->item, $this->params );
		$statebutton = flexicontent_html::statebutton( $this->item, $this->params );
		$deletebutton = flexicontent_html::deletebutton( $this->item, $this->params );
		$approvalbutton = flexicontent_html::approvalbutton( $this->item, $this->params );
		?>
		
		<?php if ($editbutton || $deletebutton || $statebutton || $approvalbutton) : ?>
		
			<!-- BOF buttons -->
			<?php if ($this->params->get('btn_grp_dropdown')) : ?>
			
			<div class="buttons btn-group">
			  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
			    <span class="<?php echo $this->params->get('btn_grp_dropdown_class', 'icon-options'); ?>"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <?php echo $editbutton   ? '<li>'.$editbutton.'</li>' : ''; ?>
			    <?php echo $deletebutton   ? '<li>'.$deletebutton.'</li>' : ''; ?>
			    <?php echo $approvalbutton  ? '<li>'.$approvalbutton.'</li>' : ''; ?>
			  </ul>
		    <?php echo $statebutton; ?>
			</div>

			<?php else : ?>
			<div class="adminbuttons buttons">
				<?php echo $editbutton; ?>
				<?php echo $statebutton; ?>
				<?php echo $deletebutton; ?>				
				<?php echo $approvalbutton; ?>
			</div>
			<?php endif; ?>
			<!-- EOF buttons -->
			
		<?php endif; ?>
	<?php endif; ?>	
	<div class="clearen"></div>
	
	
	<?php if ( $menuparams->get( 'show_page_heading', 1 ) ) : /* BOF page title */ ?>
    
	<header>
    <h1 class="componentheading">
		<?php echo $menuparams->get('page_heading'); ?>
	</h1>
    </header>
	<?php endif; /* EOF page title */ ?>
    
    <?php echo ( ($mainAreaTag == 'section') ? '</header>' : ''); ?>
	
    <?php echo ( ($mainAreaTag == 'section') ? '<article>' : ''); ?>
    
   	<?php if ($this->params->get('show_title', 1) ||  $this->params->get( 'category_title', 1 )) : /* BOF item title */ ?>
    <header class="group">
	<?php if ( $this->params->get( 'show_cat_title', 0) == 1) : /* category  title */ ?>
   	<h2 class="cattitle"><?php echo $this->item->category_title; ?></h2>
   	<?php endif; ?>
    
    <?php if ( $this->params->get( 'show_title', 1 ) ) : /* BOF page title */ ?>
	   		<h3 class="fc_item_title">
	  	 	 <?php
		 	 if ( mb_strlen($this->item->title, 'utf-8') > $this->params->get('title_cut_text',200) ) :
		 	   	echo mb_substr ($this->item->title, 0, $this->params->get('title_cut_text',200), 'utf-8') . ' ...';
		 	  else :
		 	   	echo $this->item->title;
		 	  endif;
		 	 ?>
	    	</h3>
	    <?php endif;   
	endif; /* EOF title */?>

    <?php if ($this->item->event->afterDisplayTitle) : /* BOF afterDisplayTitle */ ?>
		<div class="fc_afterDisplayTitle group">
			<?php echo $this->item->event->afterDisplayTitle; ?>
		</div>
	<?php endif; /* EOF afterDisplayTitle */ ?>
	
	<?php if (isset($this->item->positions['subtitle1'])) : /* BOF subtitle1 block */ ?>
	<div class="flexi lineinfo subtitle1 group">
		<?php foreach ($this->item->positions['subtitle1'] as $field) : ?>
		<div class="flexi-field field_<?php echo $field->name; ?>">
			<?php if ($field->label) : ?>
			<div class="label label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
			<?php endif; ?>
			<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; /* EOF subtitle1 block */ ?>
	
	<?php if (isset($this->item->positions['subtitle2'])) : /* BOF subtitle2 block */ ?>
	<div class="flexi lineinfo subtitle2 group">
		<?php foreach ($this->item->positions['subtitle2'] as $field) : ?>
		<div class="flexi-field field_<?php echo $field->name; ?>">
			<?php if ($field->label) : ?>
			<div class="label label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
			<?php endif; ?>
			<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; /* EOF subtitle2 block */ ?>
	
	<?php if (isset($this->item->positions['subtitle3'])) : /* BOF subtitle3 block */ ?>
	<div class="flexi lineinfo subtitle3 group">
		<?php foreach ($this->item->positions['subtitle3'] as $field) : ?>
		<div class="flexi-field field_<?php echo $field->name; ?>">
			<?php if ($field->label) : ?>
			<div class="label label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
			<?php endif; ?>
			<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; /* EOF subtitle3 block */ ?>
    
    <?php if ($this->params->get('show_title', 1)) : ?>
    </header>
    <?php endif; ?>
    
    
	<?php echo $this->loadTemplate('tabs_html5'); ?>

	
	<?php if (isset($this->item->positions['description']) || $show_img_desc == 1 ) : /* BOF description */ ?>
	<div class="description group">
    

	<?php if (isset($this->item->positions['description']) ) : ?>

		<?php foreach ($this->item->positions['description'] as $field) : ?>
	    
	    <?php if ($field->name == "text") :?>
	    	<?php if ($show_img_desc == 1 && isset($html_images)) : 
	    	// Bild in Beitragtext einbinden?>
				
				  <figure class="<?php echo $img_position; ?>" >
				  	<?php echo $html_images; ?>
				  </figure>			 
				  <?php	echo $field->display; ?>		  
				
			<?php endif; ?>

	    <?php else: 
	    	echo $field->display; ?>	
	    <?php endif ?>	
		
		<?php endforeach; ?>
	<?php endif; ?>

    </div>
	<?php endif; /* EOF description */ ?>
    

    
	<?php if ( isset($this->item->positions['bottom']) || isset($this->item->positions['bottom-nolabel']) ) : ?>

	<footer class="flexi infoblock <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
		
		<?php if( isset ($this->item->positions['bottom-nolabel'] ) ) : ?>
		<div class="flexi flexi-bottom-nolabel <?php echo ( $grid_framework > 0 ) ?  $gridclass  : $classnum; ?>">
			<?php foreach ($this->item->positions['bottom-nolabel'] as $field) : ?>
			<div class='flexi-field field_<?php echo $field->name; ?>'>
				
					<?php if ($field->label) : ?>
					<div class="label label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
					<?php endif; ?>
					<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
				
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php if( $this->item->positions['bottom'] ) : ?>
		<div class="flexi flexi-bottom <?php echo ( $grid_framework > 0 ) ?  $gridclass  : $classnum; ?>">
			<?php foreach ($this->item->positions['bottom'] as $field) : ?>

			<div class='flexi-field field_<?php echo $field->name; ?>'>
				
					<?php if ($field->label) : ?>
					<div class="label label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
					<?php endif; ?>
					<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
				
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

	</footer>

	<?php endif; ?>


    
    <?php // widgetkitgalerie JLayout Widgetkit ?>

    <?php //if(!$_galerie_via_pos) : ?>
		<?php if ( $field_galerie && FlexicontentFields::getFieldDisplay($item, $field_galerie, null, 'display_large', 'item') ):  // imagegalerie Widgetkit ?>
		  
			<?php echo $widgetkit->render($data);?>	


		<?php endif; ?>
    <?php// endif; ?>

    
    <?php echo ( ($mainAreaTag == 'section') ? '</article>' : ''); ?>

  	<?php if ($this->item->event->afterDisplayContent) : /* BOF afterDisplayContent */ ?>
	<?php echo ( ($mainAreaTag == 'section') ? '<footer' : '<div'); ?> class="fc_afterDisplayContent group">
        <?php echo $this->item->event->afterDisplayContent; ?>
    <?php echo ( ($mainAreaTag == 'section') ? '</footer>' : '</div>'); ?>
  	<?php endif; /* EOF afterDisplayContent */ ?>
    
<?php echo '</'.$mainAreaTag.'>'; ?>


<?php if ($pdfbutton || $mailbutton || $printbutton ) : ?>
<div id="bookmark" class="buttons">	
	<?php echo $pdfbutton; ?>
	<?php echo $mailbutton; ?>
	<?php echo $printbutton; ?>
</div>		
<?php endif; ?>	
