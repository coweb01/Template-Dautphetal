<?php
/**
 * HTML5 Template
 * @version 1.5 stable $Id: category_items_html5.php 0001 2012-09-23 14:00:28Z Rehne $
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

 * Template fuer ein Downloadverzeichniss 
 * Bootstrap 4 Card Layout 
 * Author: c.oerter
 * www.das-webconcept.de
 * Stand: 10/2020
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
// first define the template name
$tmpl         = $this->tmpl;
$user         = JFactory::getUser();
$app          = JFactory::getApplication();
$template     = $app->getTemplate(); 
//$tmpl_cols    = $this->params->get('tmpl_cols', 1);
//$tmpl_cols_sm = $this->params->get('tmpl_cols_sm', 1);

// Ergaenzung Template Variables webconcept Bootstrap 4 Template

$grid_framework  = $this->params->get('grid_framework', 1);

/*$arr_cols_gridclasses   	=   array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-4',4=>'col-lg-3'),
           					    array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-1-3',4=>'uk-width-large-1-4')
           					  );

$arr_cols_gridclasses_sm    =   array(
								array(1=>'col-md-12',2=>'col-md-6',3=>'col-md-4',4=>'col-md-3'),
  								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-1-3')
  								);

$arr_cols_gridclasses_lg    =   array(
								array(1=>'col-xl-12',2=>'col-xl-6',3=>'col-xl-4',4=>'col-lg-3'),
  								array(1=>'uk-width-xlarge-1-1',2=>'uk-width-xlarge-1-2',3=>'uk-width-xlarge-1-3')
  								);


$arr_cols_gridclasses_xs   	=   array(
								array(1=>'col-12',2=>'col-6',3=>'col-4',4=>'col-3'),
  								array(1=>'uk-width-small-1-1',2=>'uk-width-small-1-2',3=>'uk-width-small-1-3')
  								);

$arr_cols_gridclasses_dbl  	=   array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-8',4=>'col-lg-6'),
								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-2-3',4=>'uk-width-medium-2-4')
								);
$arr_cols_gridclasses_dbl_lg  	= array(
								array(1=>'col-xl-12',2=>'col-xl-6',3=>'col-xl-8',4=>'col-xl-6'),
								array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-2-3',4=>'uk-width-large-2-4')
								);


if ( $grid_framework == 1 ) : // bootstrap
		$cols_gridclasses         = $arr_cols_gridclasses[0];
		$cols_gridclasses_sm      = $arr_cols_gridclasses_sm[0];
		$cols_gridclasses_xs      = $arr_cols_gridclasses_xs[0];
		$cols_gridclasses_lg      = $arr_cols_gridclasses_lg[0];
		$cols_gridclasses_dbl     = $arr_cols_gridclasses_dbl[0];
		$cols_gridclasses_dbl_lg  = $arr_cols_gridclasses_dbl_lg[0];

endif;
/*
/*if ( $grid_framework == 2 ) : // uikit
		$cols_gridclasses         = $arr_cols_gridclasses[1];
		$cols_gridclasses_sm      = $arr_cols_gridclasses_sm[1];
		$cols_gridclasses_lg      = $arr_cols_gridclasses_lg[1];
		$cols_gridclasses_xs      = $arr_cols_gridclasses_xs[1];
		$cols_gridclasses_dbl     = $arr_cols_gridclasses_dbl[1];
		$cols_gridclasses_dbl_lg  = $arr_cols_gridclasses_dbl_lg[1];
endif;*/


// end webconcept 

switch  ( $grid_framework  ) {

		case 0: $position    = '';   /* Flexicontent */
				break;
		case 1: $position = ' float-';   /* bootstrap */
				break;			
		case 2: $position = ' uk-align-';   /*  Uikit */
				break;
}

?>

<?php
	ob_start();
	
	// Form for (a) Text search, Field Filters, Alpha-Index, Items Total Statistics, Selectors(e.g. per page, orderby)
	// If customizing via CSS rules or JS scripts is not enough, then please copy the following file here to customize the HTML too
    include(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'listings_filter_form.php');
	
	$filter_form_html = trim(ob_get_contents());
	ob_end_clean();
	if ( $filter_form_html ) {
		echo '<aside class="group">'."\n".$filter_form_html."\n".'</aside>';
	}
?>

<div class="clear"></div>

<?php
$items = & $this->items;

// -- Check matching items found
if (!$items) {
	// No items exist
	if ($this->getModel()->getState('limit')) {
		// Not creating a category view without items
		echo '<div class="noitems group">' . JText::_( 'FLEXI_NO_ITEMS_FOUND' ) . '</div>';
	}
	return;
}


// -- Decide whether to show the item edit options
if ( $user->id ) :
	
	$show_editbutton = $this->params->get('show_editbutton', 1);
	foreach ($items as $item) :
	
		if ( $show_editbutton ) :
			if ($item->editbutton = flexicontent_html::editbutton( $item, $this->params )) :
				$item->editbutton = '<div class="fc_edit_link_nopad">'.$item->editbutton.'</div>';
			endif;
			if ($item->statebutton = flexicontent_html::statebutton( $item, $this->params )) :
				$item->statebutton = '<div class="fc_state_toggle_link_nopad">'.$item->statebutton.'</div>';
			endif;
		endif;
		
		if ($item->approvalbutton = flexicontent_html::approvalbutton( $item, $this->params )) :
			$item->approvalbutton = '<div class="fc_approval_request_link_nopad">'.$item->approvalbutton.'</div>';
		endif;
		
	endforeach;
	
endif;

// -- Find all categories used by items
$currcatid = $this->category->id;
$cat_items[$currcatid] = array();
$sub_cats[$currcatid] = & $this->category;
foreach ($this->categories as $subindex => $sub) :
	$cat_items[$sub->id] = array();
	$sub_cats[$sub->id] = & $this->categories[$subindex];
endforeach;

// -- Group items into categories
for ($i=0; $i<count($items); $i++) :
	foreach ($items[$i]->cats as $cat) :
		if (isset($cat_items[$cat->id])) :
			$cat_items[$cat->id][] = & $items[$i];
		endif;
	endforeach;
endfor;



?>

<div class="download-block">	

<?php
$show_itemcount   = $this->params->get('show_itemcount', 1);
$show_subcatcount = $this->params->get('show_subcatcount', 0);
$itemcount_label   = ($show_itemcount==2   ? JText::_('FLEXI_ITEM_S') : '');
$subcatcount_label = ($show_subcatcount==2 ? JText::_('FLEXI_CATEGORIES') : '');

global $globalcats;
$count_cat = -1;
foreach ($cat_items as $catid => $items) :
	$sub = & $sub_cats[$catid];
	if (count($items)==0) continue;
	if ($catid!=$currcatid) $count_cat++;
?>

<!-- <div> -->
	
	<section class="flexi-cat mt-5">	
		
		<?php if ($catid!=$currcatid ) : ?>
		<header class="flexi-cat">

			<?php if (!empty($sub->image) && $this->params->get(($catid!=$currcatid? 'show_description_image_subcat' : 'show_description_image'), 1)) : ?>
				<!-- BOF subcategory image -->
				<figure class="catimg">
					<?php echo $sub->image; ?>
				</figure>
				<!-- EOF subcategory image -->
			<?php endif; ?>
			
			<?php if ($catid!=$currcatid) { ?> 
				<h3><a class='fc_cat_title' href="<?php echo JRoute::_( FlexicontentHelperRoute::getCategoryRoute($sub->slug) ); ?>"> <?php } 
				else { echo "<span class='fc_cat_title'>"; } ?>
				<!-- BOF subcategory title -->
				<?php echo $sub->title; ?>
				<!-- EOF subcategory title -->
			<?php if ($catid!=$currcatid) { ?> </a></h3> <?php } 
				else { echo "</span>"; } ?>

			<?php if ($catid!=$currcatid) : ?>
				<!-- BOF subcategory assigned/subcats_count  -->
				<?php
				$infocount_str = '';
				if ($show_itemcount)   $infocount_str .= (int) $sub->assigneditems . $itemcount_label;
				if ($show_subcatcount) $infocount_str .= ($show_itemcount ? ' / ' : '').count($sub->subcats) . $subcatcount_label;
				if ($infocount_str) $infocount_str = ' (' . $infocount_str . ')';
				?>
				<!-- EOF subcategory assigned/subcats_count -->
			<?php endif; ?>

			<?php if ($this->params->get(($catid!=$currcatid? 'show_description_subcat' : 'show_description'), 1)) : ?>
				<!-- BOF subcategory description  -->
				<div class="catdescription group">
					<?php	echo flexicontent_html::striptagsandcut( $sub->description, $this->params->get(($catid!=$currcatid? 'description_cut_text_subcat' : 'description_cut_text'), 120) ); ?>
				</div>
				<!-- EOF subcategory description -->
			<?php endif; ?>
			
		</header>
		<?php endif; ?>

		<?php if ( $items ) : ?>
			<!-- BOF subcategory items -->
		
			<div class="flexi-itemlist  <?php echo ( $grid_framework > 0 ) ? 'card-columns' : ''; ?>">
		
			<?php foreach ($items as $i => $item) : 
				
				if($item->state!=-2) : 
				
				$fc_item_classes = 'flexi-item';
				
				$markup_tags = '<span class="fc_mublock">';
				foreach($item->css_markups as $grp => $css_markups) {
					if ( empty($css_markups) )  continue;
					$fc_item_classes .= ' fc'.implode(' fc', $css_markups);
					
					$ecss_markups  = $item->ecss_markups[$grp];
					$title_markups = $item->title_markups[$grp];
					foreach($css_markups as $mui => $css_markup) {
						$markup_tags .= '<span class="fc_markup mu' . $css_markups[$mui] . $ecss_markups[$mui] .'">' .$title_markups[$mui]. '</span>';
					}
				}
				$markup_tags .= '</span>';
				?>

				<div id="card download_list_cat_<?php echo $catid; ?>item_<?php echo $i; ?>" class="<?php echo $fc_item_classes; ?>">
					
					<div class="card-body flexi-fieldlist background-secondary">

					  	<?php if ($item->event->beforeDisplayContent) : ?>
						  	<!-- BOF beforeDisplayContent -->
							<aside class="fc_beforeDisplayContent group">
								<?php echo $item->event->beforeDisplayContent; ?>
							</aside>
						  	<!-- EOF beforeDisplayContent -->
						<?php endif; ?>

				
					

				   		<div class="flexi-field">
                        
                            <aside class="adminbuttons <?php echo  $position; ?>-right"> 
                              <div class="<?php echo $position;?>left"><?php echo @ $item->editbutton; ?></div>
                              <div class="<?php echo $position;?>left"><?php echo @ $item->statebutton; ?></div>
                              <div class="<?php echo $position;?>left"><?php echo @ $item->approvalbutton; ?></div>
							</aside>
                            	
					
							<?php if ($this->params->get('show_title', 1)) : ?>
								<!-- BOF item title -->
								<?php if ($this->params->get('link_titles', 0)) : ?>
					   			<h4><a class="card-title fc_item_title" href="<?php echo JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug, 0, $item)); ?>">
										<?php echo $item->title; ?>
									</a></h4>
				   			<?php else : ?>
									<h4 class="card-title fc_item_title"><?php echo $item->title; ?></h4>
								<?php endif; ?>
								<!-- BOF item title -->
							<?php endif; ?>
							
							
							<?php echo $markup_tags; ?>
					
							<?php if ($item->event->afterDisplayTitle) : ?>
								<!-- BOF afterDisplayTitle -->
								<div class="fc_afterDisplayTitle">
									<?php echo $item->event->afterDisplayTitle; ?>
								</div>
								<!-- EOF afterDisplayTitle -->
							<?php endif; ?>
							
						 </div> 
							
							<?php if (isset($item->positions['aftertitle'])) : ?>
								<!-- BOF aftertitle block -->
								<?php foreach ($item->positions['aftertitle'] as $field) : ?>
								<div class="flexi-field">
									<?php if ($field->label) : ?>
									<span class="flexi label field_<?php echo $field->name; ?>"><?php echo $field->label; ?></span>
									<?php endif; ?>
									<div class="flexi value field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
								</div>
								<?php endforeach; ?>
								<!-- EOF aftertitle block -->
							<?php endif; ?>
							
							
							<?php if (isset($item->positions['aftertitle_nolabel'])) : ?>
								<!-- BOF aftertitle_nolabel block -->
								<?php foreach ($item->positions['aftertitle_nolabel'] as $field) : ?>
								<div class="flexi-field">
									<div class="flexi value field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
								</div>
								<?php endforeach; ?>
								<!-- EOF aftertitle_nolabel block -->
							<?php endif; ?>
							
							
							<?php if (isset($item->positions['aftertitle2'])) : ?>
								<!-- BOF aftertitle block -->
								<?php foreach ($item->positions['aftertitle2'] as $field) : ?>
								<div class="flexi-field">
									<?php if ($field->label) : ?>
									<span class="flexi label field_<?php echo $field->name; ?>"><?php echo $field->label; ?></span>
									<?php endif; ?>
									<div class="flexi value field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
								</div>
								<?php endforeach; ?>
								<!-- EOF aftertitle block -->
							<?php endif; ?>
							
							
							<?php if (isset($item->positions['aftertitle_nolabel2'])) : ?>
								<!-- BOF aftertitle_nolabel block -->
								<?php foreach ($item->positions['aftertitle_nolabel2'] as $field) : ?>
								<div class="flexi-field">
									<div class="flexi value field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
								</div>
								<?php endforeach; ?>
								<!-- EOF aftertitle_nolabel block -->
							<?php endif; ?>
							
							
							<?php if (isset($item->positions['aftertitle3'])) : ?>
								<!-- BOF aftertitle block -->
								<?php foreach ($item->positions['aftertitle3'] as $field) : ?>
								<div class="flexi-field">
									<?php if ($field->label) : ?>
									<span class="flexi label field_<?php echo $field->name; ?>"><?php echo $field->label; ?></span>
									<?php endif; ?>
									<div class="flexi value field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
								</div>
								<?php endforeach; ?>
								<!-- EOF aftertitle block -->
							<?php endif; ?>
							
							
							<?php if (isset($item->positions['aftertitle_nolabel3'])) : ?>
								<!-- BOF aftertitle_nolabel block -->
								<?php foreach ($item->positions['aftertitle_nolabel3'] as $field) : ?>
								<div class="flexi-field">
									<div class="flexi value field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
								</div>
								<?php endforeach; ?>
								<!-- EOF aftertitle_nolabel block -->
							<?php endif; ?>
							
						</div>


					<?php if ($item->event->afterDisplayContent) : ?>
						<!-- BOF afterDisplayContent -->
						<aside class="fc_afterDisplayContent group">
							<?php echo $item->event->afterDisplayContent; ?>
						</aside>
						<!-- EOF afterDisplayContent -->
					<?php endif; ?>

				</div>
				<?php endif; ?>
			<?php endforeach; ?>

			</div>
		
			<!-- EOF subcategory items -->
		<?php endif; ?>

	</section>
  
<!-- </div> -->


<?php endforeach; ?>

</div>

