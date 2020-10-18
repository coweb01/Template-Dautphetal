<?php
/**
 * HTML5 Template
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
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\String\StringHelper;

// first define the template name
$tmpl           = $this->tmpl;
$item           = $this->item;
$menu           = JFactory::getApplication()->getMenu()->getActive();
$app            = JFactory::getApplication();
$template       = $app->getTemplate(); 
$menuparams     = $app->getParams(); //Parameter Menue
$tooltip_class  = FLEXI_J30GE ? 'hasTooltip' : 'hasTip';

// Layout Widgetkit Fotogalerie 

$field_galerie  = $this->params->get('select_galerie');

$widgetkit     = new JLayoutFile('templates.widgetkitgalerie', JPATH_ROOT .'/components/com_flexicontent/layouts');

$data          = array(
				  'params' => $this->params,
				  'item'   => $item
);



// Create description field if not already created
FlexicontentFields::getFieldDisplay($item, 'text', $values=null, $method='display');

// Find if description and Gallerie is placed via template position
$_text_via_pos = false;
$_galerie_via_pos = false;
if (isset($item->positions) && is_array($item->positions)) {
	foreach ($item->positions as $posName => $posFields) {
		if ($posName == 'renderonly') continue;
		foreach($posFields as $field)
		 if ($field->name== 'wk_galerie') {$_galerie_via_pos = true;}
		 if ($field->name=='text') { $_text_via_pos = true; }
	}
}


// Prepend toc (Table of contents) before item's description (toc will usually float right)
// By prepend toc to description we make sure that it get's displayed at an appropriate place
if (isset($item->toc)) {
	$item->fields['text']->display = $item->toc . $item->fields['text']->display;
}

// Set the class for controlling number of columns in custom field blocks
switch ($this->params->get( 'columnmode', 2 )) {
	case 0: $columnmode = 'singlecol'; break;
	case 1: $columnmode = 'doublecol'; break;
	default: $columnmode = 'variablecol'; break;
}
// ***********
// DECIDE TAGS 
// ***********

// Fix parameter Titel nicht gesetzt, wenn Beitrag über Frontend angelegt.
// Flexicontent Version 3.3.1.1

if  ($this->params->get('show_title') === false ) { 
	$this->params->set('show_title',JComponentHelper::getParams( 'com_flexicontent' )->get('show_title')); 
}

// ende FIX


$page_heading_shown =
	$menuparams->get( 'show_page_heading', 1 ) &&
	$menuparams->get('page_heading') != $item->title ||
	$this->params->get('show_title', 1);

// Main container
$mainAreaTag = $page_heading_shown ? 'section' : 'article';

// SEO, header level of title tag
$itemTitleHeaderLevel = $page_heading_shown ? '2' : '1'; 





$page_classes  = 'flexicontent';
$page_classes .= $this->pageclass_sfx ? ' page'.$this->pageclass_sfx : '';
$page_classes .= ' fcitems fcitem'.$item->id;
$page_classes .= ' fctype'.$item->type_id;
$page_classes .= ' fcmaincat'.$item->catid;
if ($menu) $page_classes .= ' menuitem'.$menu->id; 

// Grid Framework Haupttemplate
$grid = $this->params->get( 'grid_framework', 0 );

// Widgetkit Fotogalerie 

$field_galerie  = $this->params->get('select_galerie');


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

	if (isset($item->positions) && is_array($item->positions)) {
		foreach ($item->positions as $posName => $posFields) {
			
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

switch  ( $grid ) {

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
$img_style    .= ' fc_field_image';
$lightbox      = $this->params->get('item_image_lightbox', 1);


// SEO
$microdata_itemtype = $this->params->get( 'microdata_itemtype');
$microdata_itemtype_code = $microdata_itemtype ? 'itemscope itemtype="http://schema.org/'.$microdata_itemtype.'"' : '';
?>

<?php echo '<'.$mainAreaTag; ?> id="flexicontent" class="<?php echo $page_classes; ?>" <?php echo $microdata_itemtype_code; ?> >
	
	<?php echo ( ($mainAreaTag == 'section') ? '<header>' : ''); ?>
	
  <?php if ($item->event->beforeDisplayContent) : ?>
		<!-- BOF beforeDisplayContent -->
		<?php echo ( ($mainAreaTag == 'section') ? '<aside' : '<div'); ?> class="fc_beforeDisplayContent group">
			<?php echo $item->event->beforeDisplayContent; ?>
		<?php echo ( ($mainAreaTag == 'section') ? '</aside>' : '</div>'); ?>
		<!-- EOF beforeDisplayContent -->
	<?php endif; ?>
	
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
		$pdfbutton = flexicontent_html::pdfbutton( $item, $this->params );
		$mailbutton = flexicontent_html::mailbutton( FLEXI_ITEMVIEW, $this->params, $item->categoryslug, $item->slug, 0, $item );
		$printbutton = flexicontent_html::printbutton( $this->print_link, $this->params );
		$editbutton = flexicontent_html::editbutton( $item, $this->params );
		$statebutton = flexicontent_html::statebutton( $item, $this->params );
		$deletebutton = flexicontent_html::deletebutton( $item, $this->params );
		$approvalbutton = flexicontent_html::approvalbutton( $item, $this->params );
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
			<div class="adminbuttos d-flex">
				<?php echo $editbutton; ?>				
				<?php echo $statebutton; ?>
				<?php echo $deletebutton; ?>
				<?php echo $approvalbutton; ?>
			</div>
			<?php endif; ?>
			<!-- EOF buttons -->
			
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ( $page_heading_shown ) : ?>
		<!-- BOF page heading -->
		<header>
		<h1 class="componentheading">
			<?php echo $menuparams->get('page_heading'); ?>
		</h1>
		</header>
		<!-- EOF page heading -->
	<?php endif; ?>

	<?php echo ( ($mainAreaTag == 'section') ? '</header>' : ''); ?>
	
	<?php echo ( ($mainAreaTag == 'section') ? '<article>' : ''); ?>
	
	<?php if ($this->params->get('show_title', 1)) : /*open header container of title*/ ?>
	<header class="group">
	<?php endif; ?>
	
	<?php if ($this->params->get('show_title', 1)) : ?>
		<!-- BOF item title -->
		<?php echo '<h'.$itemTitleHeaderLevel; ?>>
			<span class="fc_item_title" itemprop="name">
			<?php
				echo ( StringHelper::strlen($item->title) > (int) $this->params->get('title_cut_text',200) ) ?
					StringHelper::substr($item->title, 0, (int) $this->params->get('title_cut_text',200)) . ' ...'  :  $item->title;
			?>
			</span>
		<?php echo '</h'.$itemTitleHeaderLevel; ?>>
		<!-- EOF item title -->
	<?php endif; ?>
	
   <?php if ($item->event->afterDisplayTitle) : ?>
		<!-- BOF afterDisplayTitle -->
		<div class="fc_afterDisplayTitle group">
			<?php echo $item->event->afterDisplayTitle; ?>
		</div>
		<!-- EOF afterDisplayTitle -->
	<?php endif; ?>

	<?php if ((intval($item->modified) !=0 && $this->params->get('show_modify_date')) || ($this->params->get('show_author') && ($item->creator != "")) || ($this->params->get('show_create_date')) || (($this->params->get('show_modifier')) && (intval($item->modified) !=0))) : ?>
	<!-- BOF item basic/core info -->
	<div class="iteminfo group">
		
		<div class="createdline">
			
			<?php if (($this->params->get('show_author')) && ($item->creator != "")) : ?>
			<div class="createdby">
				<?php FlexicontentFields::getFieldDisplay($item, 'created_by', $values=null, $method='display'); ?>
				<?php echo JText::sprintf('FLEXI_WRITTEN_BY', $this->fields['created_by']->display); ?>
			</div>
			<?php endif; ?>
			
			<?php if (($this->params->get('show_author')) && ($item->creator != "") && ($this->params->get('show_create_date'))) : ?>
			::
			<?php endif; ?>
	
			<?php if ($this->params->get('show_create_date')) : ?>
			<div class="created">
				<?php FlexicontentFields::getFieldDisplay($item, 'created', $values=null, $method='display'); ?>
				<?php echo '['.JHTML::_('date', $this->fields['created']->value[0], JText::_('DATE_FORMAT_LC2')).']'; ?>		
			</div>
			<?php endif; ?>
			
		</div>
		
		<div class="modifiedline">
			
			<?php if (($this->params->get('show_modifier')) && ($item->modifier != "")) : ?>
			<div class="modifiedby">
				<?php FlexicontentFields::getFieldDisplay($item, 'modified_by', $values=null, $method='display'); ?>
				<?php echo JText::_('FLEXI_LAST_UPDATED').' '.JText::sprintf('FLEXI_BY', $this->fields['modified_by']->display); ?>
			</div>
			<?php endif; ?>
	
			<?php if (($this->params->get('show_modifier')) && ($item->modifier != "") && ($this->params->get('show_modify_date'))) : ?>
			::
			<?php endif; ?>
			
			<?php if (intval($item->modified) !=0 && $this->params->get('show_modify_date')) : ?>
				<div class="modified">
				<?php FlexicontentFields::getFieldDisplay($item, 'modified', $values=null, $method='display'); ?>
				<?php echo '['.JHTML::_('date', $this->fields['modified']->value[0], JText::_('DATE_FORMAT_LC2')).']'; ?>
				</div>
			<?php endif; ?>
			
		</div>
		
	</div>
	<!-- EOF item basic/core info -->
	<?php endif; ?>
	
	<?php if ($this->params->get('show_title', 1)) : /*close header container of title*/ ?>
	</header>
	<?php endif; ?>
	
	<?php if (isset($item->positions['imagegaleriebefore'])) :  // imagegalerie?>
		<div class="images value_<?php echo $field->name;?>">
		<?php foreach ($item->positions['imagegaleriebefore'] as $field) : ?>
				
					<?php echo $field->display; ?>
				
		<?php endforeach; ?>	
		</div>
	<?php endif; ?>

	
	<?php if (isset($item->positions['beforedescription'])) : ?>
	<!-- BOF beforedescription block -->
	<div class="customblock beforedescription group">
		<?php foreach ($item->positions['beforedescription'] as $field) : ?>
		<div class="flexi element field_<?php echo $field->name; ?> <?php echo $columnmode; ?>">
			<?php if ($field->label) : ?>
			<div class="flexi label field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
			<?php endif; ?>
			<div class="flexi value field_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
				<?php echo $field->display; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<!-- EOF beforedescription block -->
	<?php endif; ?>
	
	<?php if (!$_text_via_pos): ?>
	<div class="description group">
	
	<?php if ($show_img_desc == 1 && isset($html_images)) : 
	// Bild in Beitragtext einbinden?>
		
		  <figure class="<?php echo $img_position; ?>" >
		  	<?php echo $html_images; ?>
		  </figure>			 
		  
				
	<?php endif; ?>
	
	<div class="text "><?php echo $this->fields['text']->display; ?></div>
	
	</div>
	<?php endif; ?>

	<?php if (isset($item->positions['afterdescription'])) : ?>
	<!-- BOF afterdescription block -->
	<div class="customblock afterdescription group">
		<?php foreach ($item->positions['afterdescription'] as $field) : ?>
		<div class="flexi element field_<?php echo $field->name; ?> <?php echo $columnmode; ?>">
			<?php if ($field->label) : ?>
			<div class="flexi label field_<?php echo $field->name; ?>"><?php echo $field->label; ?></div>
			<?php endif; ?>
			<div class="flexi value field_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
				<?php echo $field->display; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<!-- EOF afterdescription block -->
	<?php endif; ?>
	

	<?php if (($this->params->get('show_vote', 1)) || ($this->params->get('show_favs', 1)))  : ?>
	<!-- BOF item rating, favourites -->
	<aside class="itemactions group">
		<?php if ($this->params->get('show_vote', 1)) : ?>
		<div class="voting">
		<?php FlexicontentFields::getFieldDisplay($item, 'voting', $values=null, $method='display'); ?>
		<?php echo $this->fields['voting']->display; ?>
		</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_favs', 1)) : ?>
		<div class="favourites">
			<?php FlexicontentFields::getFieldDisplay($item, 'favourites', $values=null, $method='display'); ?>
			<?php echo $this->fields['favourites']->display; ?>
		</div>
		<?php endif; ?>
	</aside>
	<!-- EOF item rating, favourites -->
	<?php endif; ?>
	

	<?php if (isset($item->positions['imagegalerieafter'])) :  // imagegalerie?>
		<div class="images value_<?php echo $field->name;?>">
		<?php foreach ($item->positions['imagegalerieafter'] as $field) : ?>
				
					<?php echo $field->display; ?>
				
		<?php endforeach; ?>	
		</div>
	<?php endif; ?>

    
    <?php // widgetkitgalerie ?>
    <?php if (!$_galerie_via_pos) : ?>
		<?php if ( $field_galerie && FlexicontentFields::getFieldDisplay($item, $field_galerie, null, 'display_large', 'item') ):  // imagegalerie Widgetkit ?>
		
			<?php echo $widgetkit->render($data);?>	


		<?php endif; ?>
    <?php endif; ?>


	<div class="custommap group">
   	<?php 
        $c = new stdClass();   
		$c->text = '';
		//$c->text .= '{some_plugin_code}';
		if (isset($item->fields['google_map01']->display)) {
			$c->text   .= $item->fields['google_map01']->display; 
			
			$c->title   = $item->title;
			$c->slug    = $item->slug;
			$c->catid   = $item->catid;
			$c->catslug = $item->categoryslug;
			$c->id      = $item->id;
			$c->state   = $item->state;	
			
			$dispatcher = &JDispatcher::getInstance();
			JPluginHelper::importPlugin('content');		
			$results = $dispatcher->trigger('onPrepareContent', array (&$c, &$this->params, 0));  

			// STEP 5. Output the created HTML
			echo $c->text; 

		}
		?> 
    </div>

	<?php if (($this->params->get('show_tags', 1)) || ($this->params->get('show_category', 1)))  : ?>
	<!-- BOF item categories, tags -->
	<div class="itemadditionnal group">
		<?php if ($this->params->get('show_category', 1)) : ?>
		<div class="categories">
			<?php FlexicontentFields::getFieldDisplay($item, 'categories', $values=null, $method='display'); ?>
			<div class="flexi label"><?php echo $this->fields['categories']->label; ?></div>
			<div class="flexi value"><i class="icon-folder-open"></i> <?php echo $this->fields['categories']->display; ?></div>
		</div>
		<?php endif; ?>

		<?php FlexicontentFields::getFieldDisplay($item, 'tags', $values=null, $method='display'); ?>
		<?php if ($this->params->get('show_tags', 1) && $this->fields['tags']->display) : ?>
		<div class="tags">
			<div class="flexi label"><?php echo $this->fields['tags']->label; ?></div>
			<div class="flexi value"><i class="icon-tags"></i> <?php echo $this->fields['tags']->display; ?></div>
		</div>
		<?php endif; ?>
	</div>
	<!-- EOF item categories, tags  -->
	<?php endif; ?>

    
    <?php echo ( ($mainAreaTag == 'section') ? '</article>' : ''); ?>

	<?php if ($item->event->afterDisplayContent) : ?>
	<!-- BOF afterDisplayContent -->
	<?php echo ( ($mainAreaTag == 'section') ? '<footer' : '<div'); ?> class="fc_afterDisplayContent group">
		<?php echo $item->event->afterDisplayContent; ?>
	<?php echo ( ($mainAreaTag == 'section') ? '</footer>' : '</div>'); ?>
	<!-- EOF afterDisplayContent -->
	<?php endif; ?>
	
<?php echo '</'.$mainAreaTag.'>'; ?>

<?php if ($pdfbutton || $mailbutton || $printbutton ) : ?>
<div id="bookmark" class="buttons">	
	<?php echo $pdfbutton; ?>
	<?php echo $mailbutton; ?>
	<?php echo $printbutton; ?>
</div>		
<?php endif; ?>	