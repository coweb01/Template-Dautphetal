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
 * Beitragsansicht als Tabs für Verzeichniss Organisationen HTML5
 * Widgetkit wird über JLayout eingebunden
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\String\StringHelper;

// first define the template name
$tmpl          = $this->tmpl;
$item          = $this->item;
$menu          = JFactory::getApplication()->getMenu()->getActive();
$app           = JFactory::getApplication();
$template      = $app->getTemplate(); 
$menuparams    = $app->getParams(); //Parameter Menue
$tooltip_class = FLEXI_J30GE ? 'hasTooltip' : 'hasTip';

// Layout Widgetkit Fotogalerie 

$field_galerie  = $this->params->get('select_galerie');

$widgetkit     = new JLayoutFile('templates.widgetkitgalerie', JPATH_ROOT .'/components/com_flexicontent/layouts');

$data          = array(
				  'params' => $this->params,
				  'item'   => $item
);



// Create description field if not already created
FlexicontentFields::getFieldDisplay($item, 'text', $values=null, $method='display');

// Find if description and Galerie is placed via template position
$_text_via_pos    = false;
$_galerie_via_pos = false;

if (isset($item->positions) && is_array($item->positions)) {
	foreach ($item->positions as $posName => $posFields) {
		if ($posName == 'renderonly') continue;
		
		foreach($posFields as $field) {

			if ($field->name=='text') { $_text_via_pos = true; break; }
			if ($field->name=='wk_galerie') { $_galerie_via_poss = true; break; }
		}	
	}
}

// Prepend toc (Table of contents) before item's description (toc will usually float right)
// By prepend toc to description we make sure that it get's displayed at an appropriate place
if (isset($item->toc)) {
	$item->fields['text']->display = $item->toc . $item->fields['text']->display;
}

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
	    		case 0: $img_position  .= '';
	    				$img_style     = '';
	    				break;
	    		case 1: $img_position  .= 'float-md-';
	    				$img_style     = 'thumbnail ';
	    				$img_style    .= ( $this->params->get('item_image_style') ) ? 'img-' . $this->params->get('item_image_style') : '';
	    				break;			
	    		case 2: $img_position  .= 'uk-float-';
	    				$img_style     = 'uk-thumbnail uk-border-';
	    				$img_style    .= ( $this->params->get('item_image_style') ) ? 'border-' . $this->params->get('item_image_style') : '';
	    				break;
			    }

 switch  ( $this->params->get('item_image_position',1) ) {
			    		case 0: $img_position .= "left mr-md-3 mb-3 mt-md-3";
			    				break;
			    		case 1: $img_position .= "right ml-md-3 mb-3 mt-md-3";
			    				break;			
			    		case 2: $img_position .= "none mt-md-3";
			    				break;
			    }

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
			<div class="adminbuttons d-flex">
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
	
	<div class="flexi-item background-primary">

	<?php if ($this->params->get('show_title', 1)) : /*open header container of title*/ ?>
	<header class="group">
	<?php endif; ?>

	<?php if ($this->params->get('show_title', 1)) : ?>
		<!-- BOF item title -->
		<?php echo '<h'.$itemTitleHeaderLevel; ?> >
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
		
		<div class="createdline ">
			
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
	
	
	<?php
	if (isset($item->positions['line1']) || isset($item->positions['line2']) || isset($item->positions['line3']) || isset($item->positions['Bilder'])) : 
	// wenn zusatzfelder vorhanden	?>   
	

	<div class="mt-md-3">
		
        <?php if ( isset($item->positions['line1']) ) : ?>
		<div class="line1">
			<?php foreach ($item->positions['line1'] as $field) : ?>
			<div class="flexi-field field_<?php echo $field->name; ?>">
				<?php if ($field->label) : ?>
				<div class="label label_field_<?php echo $field->name; ?>">
					
					<?php $label_str = $field->label.': ';?>					
					<?php echo $label_str; ?>					
						
				</div>
				<?php endif; ?>
				<div class="value value_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
					<?php echo $field->display; ?>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<?php endif; ?>


        <?php if (!empty($item->fields['prename_1']->display)  || !empty($item->fields['name_1']->display)) :?>
		<div class='flexi-field flexi-name'>
            <span><?php echo $item->fields['prename_1']->display;?></span>
            <?php if (isset($item->fields['name_1'] )) :?>
            <span><?php echo $item->fields['name_1']->display;?></span>
			<?php endif;?>
        </div>
        <?php endif;?>

		<?php if (!empty($item->fields['prename_2']->display)  || !empty($item->fields['name_2']->display)) :?>
		<div class='flexi-field flexi-name'>
            <span><?php echo $item->fields['prename_2']->display;?></span>
            <?php if (isset($item->fields['name_2'] )) :?>
            <span><?php echo $item->fields['name_2']->display;?></span>
			<?php endif;?>
        </div>
		<?php endif;?>



        <?php if ( isset($item->positions['line2']) ) : ?>
		<div class="line2">
		<?php foreach ($item->positions['line2'] as $field) : ?>
			<div class="flexi-field field_<?php echo $field->name; ?>">
				<?php if ($field->label) : ?>
				<div class="label label_field_<?php echo $field->name; ?>">
					
					<?php $label_str = $field->label.': ';?>					
					<?php echo $label_str; ?>					
						
				</div>
				<?php endif; ?>
				<div class="value value_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
					<?php echo $field->display; ?>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<?php endif; ?>	

        <?php if ( isset($item->positions['line3']) ) : ?>
		<div class="line3">
		<?php foreach ($item->positions['line3'] as $field) : ?>
			<div class="flexi-field field_<?php echo $field->name; ?>">
				<?php if ($field->label) : ?>
				<div class="label label_field_<?php echo $field->name; ?>">
					
					<?php $label_str = $field->label.': ';?>					
					<?php echo $label_str; ?>					
						
				</div>
				<?php endif; ?>
				<div class="value value_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
					<?php echo $field->display; ?>
				</div>
			</div>
		<?php endforeach; ?>			
		</div>
		<?php endif; ?>	


		
	</div>

	<?php ?>
	<div class="description mt-3 mb-3">

	<?php // Bild ausgeben ?>
		
	<?php if ($show_img_desc == 1 && isset($html_images)) : ?>
		
		<figure class="<?php echo $img_position; ?>" >
		  	<?php echo $html_images; ?>
		</figure>				  
				
	<?php endif; ?>
	<?php echo $this->fields['text']->display; ?>

	</div>

    <?php if ( isset($item->positions['line4']) ) : ?>
		<div class="line4">
		<?php foreach ($item->positions['line4'] as $field) : ?>
			<div class="flexi-field field_<?php echo $field->name; ?>">
				<?php if ($field->label) : ?>
				<div class="label label_field_<?php echo $field->name; ?>">
					
					<?php $label_str = $field->label.': ';?>					
					<?php echo $label_str; ?>					
						
				</div>
				<?php endif; ?>
				<div class="value value_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
					<?php echo $field->display; ?>
				</div>
			</div>
		<?php endforeach; ?>	
		</div>
	<?php endif; ?>	

	
    
    <?php // widgetkitgalerie JLayout Widgetkit ?>

    <?php if (!$_galerie_via_pos) : ?>
		<?php if ( $field_galerie && FlexicontentFields::getFieldDisplay($item, $field_galerie, null, 'display_large', 'item') ):  // imagegalerie Widgetkit ?>
		  
			<?php echo $widgetkit->render($data);?>	


		<?php endif; ?>
    <?php endif; ?>



	<?php // Bildergalerie einfach 3-spaltig ?>

	<?php if ( isset($item->positions['Bilder']) ) : ?>
		<div class="images value_<?php echo $field->name;?>">
		<?php foreach ($item->positions['Bilder'] as $field) : ?>
				<figure class="col-12 col-xs-6 col-sm-3 value_<?php echo $field->name.' '.(!$field->label ? ' nolabel ' : ''); ?>">
					<?php echo $field->display; ?>
				</figure>
		<?php endforeach; ?>	
		</div>
	<?php endif; ?>	

	<?php endif; ?>

</div>