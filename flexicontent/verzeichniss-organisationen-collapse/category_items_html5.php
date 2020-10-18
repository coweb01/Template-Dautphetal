
<?php
/**
 * @version 1.5 stable $Id: category_items.php 1033 2011-12-08 08:58:02Z enjoyman@gmail.com $
 * @package Joomla
 * @subpackage FLEXIcontent
 * @copyright 2020 das-webconcept.de Claudia Oerter
 * @license GNU/GPL v2
 * 
 * Verzeichniss der Organisationen Kategorieansicht für Adressen und Beitragstext
 * Basistemplate Flexicontent FAQ
 * bootstrap 4 Collapse
 * 
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
// first define the template name
$tmpl                  = $this->tmpl;
$user                  = JFactory::getUser();
$classnum              = ''; 
$class_fields          = 'flexi-fieldlist fields';
$class_fields         .= $this->params->get('fields_class', "left");
$img_style 			   = '';
$tmpl_cols_md          = $this->params->get('tmpl_cols', 1);
$tmpl_cols_lg		   = $this->params->get('tmpl_cols', 1);	
$tmpl_cols_sm          = $this->params->get('tmpl_cols_sm', 1);
$tmpl_cols_xs          = $this->params->get('tmpl_cols_xs', 1);
$intro_use_image       = $this->params->get('intro_use_image', 1);
$intro_link_image_to   = $this->params->get('intro_link_image_to', 0);
$intro_use_description = $this->params->get('intro_use_description', 1);
$grid_framework        = $this->params->get('grid_framework', 1);
$app       			   = JFactory::getApplication();
$template              = $app->getTemplate(); 
$showfirst             = $this->params->get('show_first', 0);


$tooltip_class = FLEXI_J30GE ? 'hasTooltip' : 'hasTip';

// Collapse Show
$doc                = JFactory::getDocument();
$doc->addScript($this->baseurl. '/components/com_flexicontent/templates/verzeichniss-organisationen-collapse/js/wbc_collapse.js', array('version' => 'auto' ));

// Ergaenzung Template Variables webconcept Bootstrap 4 Template


$arr_cols_gridclasses   	=   array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-4',4=>'col-lg-3'),
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


$arr_cols_gridclasses_xs   	= 	array(
								array(1=>'col-12',2=>'col-6',3=>'col-4'),
  								array(1=>'uk-width-small-1-1',2=>'uk-width-small-1-2',3=>'uk-width-small-1-3')
  								);

$arr_cols_gridclasses_dbl  	= 	array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-8',4=>'col-md-6'),
								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-2-3',4=>'uk-width-medium-2-4')
								);
$arr_cols_gridclasses_dbl_lg  	= array(
								array(1=>'col-xl-12',2=>'col-xl-6',3=>'col-xl-8',4=>'col-lg-6'),
								array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-2-3',4=>'uk-width-large-2-4')
								);



$cols_gridclasses         = $arr_cols_gridclasses[0];
$cols_gridclasses_sm      = $arr_cols_gridclasses_sm[0];
$cols_gridclasses_xs      = $arr_cols_gridclasses_xs[0];
$cols_gridclasses_lg      = $arr_cols_gridclasses_lg[0];
$cols_gridclasses_dbl     = $arr_cols_gridclasses_dbl[0];
$cols_gridclasses_dbl_lg  = $arr_cols_gridclasses_dbl_lg[0];




// grid 3 phone
$gridclass     = $cols_gridclasses_xs[$tmpl_cols_xs]. ' ';

// grid 3 cols tablet
$gridclass     .= $cols_gridclasses_sm[$tmpl_cols_sm] . ' ';

// grid desktop
$gridclass     .= $cols_gridclasses[$tmpl_cols_md] . ' ';
$gridclass     .= $cols_gridclasses_lg[$tmpl_cols_lg];


  	
?>

<?php
 
ob_start();
include(JPATH_SITE.DS.'templates'.DS.$template.DS.'tmpl_common'.DS.'listings_filter_form_html5.php');
$filter_form_html = trim(ob_get_contents());
ob_end_clean();

if ( $filter_form_html )
{
	echo '
	<aside class="group">
		' . $filter_form_html . '
	</aside>';
}
?>


<?php 
$itemfields = 0; // zaehler ob felder
$items	= $this->items;

$count 	= count($items);

if ($count) :
	$currcatid = $this->category->id;
	$cat_items[$currcatid] = array();
	$sub_cats[$currcatid] = & $this->category;
	foreach ($this->categories as $subindex => $sub) :
		$cat_items[$sub->id] = array();
		$sub_cats[$sub->id] = & $this->categories[$subindex];
	endforeach;
	
	$items = & $this->items;
	for ($i=0; $i<count($items); $i++) :
		foreach ($items[$i]->cats as $cat) :
			if (isset($cat_items[$cat->id])) :
				$cat_items[$cat->id][] = & $items[$i];
			endif;
		endforeach;
	endfor;

	// routine to determine all used columns for this table
	$layout 	= $this->params->get('clayout', 'default');
	$fbypos		= flexicontent_tmpl::getFieldsByPositions($layout, 'category');

?>

<section>
<div  class="<?php echo ( $grid_framework == 1 ) ? 'container-fluid' : '';?> listing <?php echo !isset($classnum) ? '' : $classnum ; ?>">

<?php
if ($this->params->get('intro_use_image', 1) && $this->params->get('intro_image')) {
	$img_size_map   = array('l'=>'large', 'm'=>'medium', 's'=>'small', 'o'=>'original');
	$img_field_size = $img_size_map[ $this->params->get('intro_image_size' , 'l') ];
	$img_field_name = $this->params->get('intro_image');
}

global $globalcats;
$count_cat = -1;
if ($this->params->get('display_subcategories_items') == 1):
endif;


foreach ($cat_items as $catid => $items) :


	$sub = & $sub_cats[$catid];
	if (count($items)==0) continue;
	if ($catid!=$currcatid) $count_cat++;

?>


	<div class="categorie-item-list">
        
		<?php if (
		  	 $this->params->get('show_sub_cat_title', 1) ||
			($this->params->get('sub_cat_description', 1) && $this->category->description)
		     ) : ?>
			
            <header class="flexi-cat group">
			<?php if ($this->params->get('show_sub_cat_title', 1) ) : // wenn Kategorietitel angezeigt werden soll?>
			<p class="h3 subcattitle"><?php echo $this->escape($sub->title); ?></p>
			<?php endif;  ?>

			<?php if ($this->params->get('sub_cat_description', 1) && $sub->description || $this->params->get('show_cat_title', 1)) : ?>
			<div class='description cat<?php echo $sub->id ?>'> 
				<?php if ($this->params->get('sub_cat_description', 1) && $sub->description ) : // wenn Beschreibung angezeigt werden soll ?>
				<?php echo $sub->description; ?>
            	<?php endif; ?>
			</div>
				<?php endif; ?>
			</header>
		<?php endif; ?>
			

		 
        <div id="wbcAccordion" class="accordion wbc-itemlist row">		

			<?php $count_items = 0; ?>

			<?php foreach ($items as $item) : // Schleife für Artikel

				$introtxt = '';  

				// Find if name and prename  is placed via template position
				$prename_via_pos = false;
				$name_via_pos    = false;
				$prename2_via_pos = false;
				$name2_via_pos    = false;
				
				if (isset($item->positions) && is_array($item->positions)) {
					foreach ($item->positions as $posName => $posFields) {

						if ($posName == 'renderonly') continue;

						foreach($posFields as $field)
							
								if  ($field->name == 'prename_1' ) {								
											$prename_via_pos = true;
								}

								if  ($field->name == 'name_1' ) {								
											$name_via_pos = true;
								}

								if  ($field->name == 'prename_2' ) {								
											$prename2_via_pos = true;
								}

								if  ($field->name == 'name_2' ) {								
											$name2_via_pos = true;
						}
										
							
					}
				}


			    if($item->state!=-2) :
					$count_items ++; 
                		

                	?>
					<div class='<?php  echo ( $grid_framework > 0 ) ? $gridclass : ''; ?>'>
		                <div class="card wbc-item ">

							<div class="card-header" id="heading_<?php echo $item->id;?>">
				    			<h3 class="wbc_item_title mb-0">
			    					<button class="btn btn-default btn-link btn-block text-left" data-toggle="collapse" data-target="#collapse_<?php echo $item->id;?>" aria-expanded="true" aria-controls="collapse_<?php echo $item->id;?>" type="button" >

			    						<?php
			    						if ( isset ($item->positions['collapse']) ) :?>	              
											<?php foreach ($item->positions['collapse']  as $field) : // alle felder von position  collapse auflisten ?>
												
												<?php if (isset($field->display) || ($field->display) > '') : ?>
											 	<span class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?> </span>
												<?php endif;?>
						 				 	<?php endforeach; ?>
						 				<?php else : ?>
						 				    <?php echo $item->title; ?>							                   
										<?php endif; ?>

			    						<span class="acc-icon float-right d-inline-block"></i></span>
			    					
			    					</button>
				    			</h3>    			
							</div>
							<div id="collapse_<?php echo $item->id;?>" class="collapse <?php echo ($count_items == 1 && $showfirst == 1) ? 'show' :'';?>" aria-labelledby="heading_<?php echo $item->id;?>" data-parent="#wbcAccordion">	
								<div class="card-body">	
										<?php if ($item->event->afterDisplayTitle) : ?>
											<div class='fc_afterDisplayTitle'>
											<?php echo $item->event->afterDisplayTitle; ?>
											</div>
										<?php endif; ?>

									  	<?php if ($this->params->get('show_editbutton', 1)) : ?>
											<?php $editbutton = flexicontent_html::editbutton( $item, $this->params ); ?>
											<?php $statebutton = flexicontent_html::statebutton( $item, $this->params ); ?>
										<?php endif; ?>			
										<?php $deletebutton = flexicontent_html::deletebutton( $item, $this->params ); ?>
										<?php $approvalbutton = flexicontent_html::approvalbutton( $item, $this->params ); ?>

									
										<?php if ( $editbutton || $statebutton || $deletebutton || $approvalbutton ) : ?>
											<div class="adminbuttons d-flex">
												<?php if ($editbutton) : ?>
														<div class="fc_edit_link"><?php echo $editbutton;?></div>
												<?php endif; ?>

												<?php if ($statebutton) : ?>
														<div class="fc_state_toggle_link"><?php echo $statebutton;?></div>
												<?php endif; ?>
												<?php if ($deletebutton) : ?>
													<div class="fc_delete_link"><?php echo $deletebutton;?></div>
												<?php endif; ?>
												<?php if ($approvalbutton) : ?>
													<div class="fc_approval_request_link"><?php echo $approvalbutton;?></div>
												<?php endif; ?>
											</div>
										<?php endif; ?>


										<?php if ($item->event->beforeDisplayContent) : ?>
												<div class='fc_beforeDisplayContent'>
													<?php echo $item->event->beforeDisplayContent; ?>
												</div>
											<?php endif; ?>
							              <?php 
										  
							              if ($this->params->get('intro_use_image', 1)) :
							                  if (!empty($img_field_name)) :
							                      // render method 'display_NNNN_src' to avoid CSS/JS being added to the page
							                      /* $src = */FlexicontentFields::getFieldDisplay($item, $img_field_name, $values=null, $method='display_'.$img_field_size.'_src');
							                      $img_field = & $item->fields[$img_field_name];
							                      $src = str_replace(JURI::root(), '', @ $img_field->thumbs_src[$img_field_size][0] );
							                  else :
							                      $src = flexicontent_html::extractimagesrc($item);
							                  endif;
							                      
							                  $RESIZE_FLAG = !$this->params->get('intro_image') || !$this->params->get('intro_image_size');
							                  if ( $src && $RESIZE_FLAG ) {
							                      // Resize image when src path is set and RESIZE_FLAG: (a) using image extracted from item main text OR (b) not using image field's already created thumbnails
							                      $w		= '&amp;w=' . $this->params->get('intro_width', 200);
							                      $h		= '&amp;h=' . $this->params->get('intro_height', 200);
							                      $aoe	    = '&amp;aoe=1';
							                      $q		= '&amp;q=95';
							                      $zc		= $this->params->get('intro_method') ? '&amp;zc=' . $this->params->get('intro_method') : '';
							                      $ext = pathinfo($src, PATHINFO_EXTENSION);
							                      $f = in_array( $ext, array('png', 'ico', 'gif') ) ? '&amp;f='.$ext : '';
							                      $conf	= $w . $h . $aoe . $q . $zc . $f;
							                      
							                      $base_url = (!preg_match("#^http|^https|^ftp|^/#i", $src)) ?  JURI::base(true).'/' : '';
							                      $thumb = JURI::base(true).'/components/com_flexicontent/librairies/phpthumb/phpThumb.php?src='.$base_url.$src.$conf;
							                  } else {
							                      // Do not resize image when (a) image src path not set or (b) using image field's already created thumbnails
							                      $thumb = $src;
							                  }
							                endif;
							             
													
							 				if ($this->params->get('intro_use_image', 1) && $src) : 
											$itemfields ++;?>
							                <figure class="image <?php echo $this->params->get('intro_position') ? ' float-md-right ml-md-3 mb-3 mt-md-3' : ' float-md-left mr-md-3 mb-3 mt-md-3'; ?>">
							                    <?php if ($this->params->get('intro_link_image', 1)) : ?>
							                        <a href="<?php echo JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug, 0, $item)); ?>" class="<?php echo $tooltip_class;?>" title="<?php echo JText::_( 'FLEXI_READ_MORE_ABOUT' ) . '::' . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>">
							                            <img class="<?php echo $img_style; ?>img-fluid" src="<?php echo $thumb; ?>" alt="<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>" />
							                        </a>
							                    <?php else : ?>
							                        <img class="<?php echo $img_style; ?>img-fluid" src="<?php echo $thumb; ?>" alt="<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>" />
							                    <?php endif; ?>
							                </figure>
											<?php
							                endif; // case source ?>


										
											<?php
											if (isset($item->positions['line1']) || isset($item->positions['line2']) || isset($item->positions['line3']) || isset($item->positions['line4']) || !empty($item->fields['prename_1']->display)  || !empty($item->fields['name_1']->display)

												) :  // wenn zusatzfelder vorhanden	   ?>
											<div class="mt-md-3 <?php echo $class_fields;?>">
											
							                <?php if ( isset($item->positions['line1']) ) : ?>
											<div class="line1">
											<?php foreach ($item->positions['line1'] as $field) : // alle felder von position line1  auflisten  ?> 
											<?php
												if (isset($field->display) || ($field->display) > '' ) : ?>
														<div class='flexi-field field_<?php echo $field->name; ?>'>
														<?php $label_str = '';
															if ($item->fields[$field->name]->parameters->get('display_label', 0)) :
																$label_str = $field->label.': ';?>
																<div class="label label_field_<?php echo $field->name; ?>"><?php echo $label_str;?></div>
														<?php endif; ?>
														<?php if (isset($field->display)) :?>
															<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
														</div>
												   <?php endif; ?>
												<?php endif;?>
											<?php endforeach; ?>
							                </div>
							                <?php endif; ?>

											<?php /* feste Position Felder Name und Vorname */ ?>

							                <?php if ( !empty($item->fields['prename_1']->display) && ($prename_via_pos    == false ) || 
							                		  !empty($item->fields['name_1']->display) && ($name_via_pos == false) ) :?>

											<div class='flexi-field flexi-name'>
							                    <span><?php echo $item->fields['prename_1']->display;?></span>
							                    <?php if (isset($item->fields['name_1'] )) :?>
							                    <span><?php echo $item->fields['name_1']->display;?></span>
												<?php endif;?>
							                </div>
							                <?php endif;?>

											<?php if ( !empty($item->fields['prename_2']->display) && ($prename2_via_pos == false) || 
												  !empty($item->fields['name_2']->display) && ($name2_via_pos == false ) ) :?>

											<div class='flexi-field flexi-name'>
							                    <span><?php echo $item->fields['prename_2']->display;?></span>
							                    <?php if (isset($item->fields['name_2'] )) :?>
							                    <span><?php echo $item->fields['name_2']->display;?></span>
												<?php endif;?>
							                </div>
											<?php endif;?>

											<?php
											if  ( isset($item->positions['line2']) ) : ?>
											<div class="line2">
											<?php foreach ($item->positions['line2'] as $field) : // alle felder von position  line2 auflisten
											
												if (isset($field->display) || ($field->display) > '') : ?>
														<div class='flexi-field field_<?php echo $field->name; ?>'>
														<?php $label_str = '';
															if ($item->fields[$field->name]->parameters->get('display_label', 0)) :
																$label_str = $field->label.': ';?>
																<div class="label label_field_<?php echo $field->name; ?>"><?php echo $label_str;?></div>
														<?php endif; ?>
								
														<?php if (isset($field->display)) :?>
														<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
														</div>
												   <?php endif; ?>
												<?php endif;?>
											<?php endforeach; ?>
							                </div>
							                <?php endif; ?>
											
							                <?php
											if (isset($item->positions['line3'])) :?>
							                <div class="line3">
												<?php foreach ($item->positions['line3'] as $field) : // alle felder von position  line3 auflisten ?>
													<?php if (isset($field->display)  || ($field->display) > '') : ?>
														<div class='flexi-field field_<?php echo $field->name; ?>'>
														<?php $label_str = '';
														
														if ($item->fields[$field->name]->parameters->get('display_label', 0)) :
															$label_str = $field->label.': '; ?>
														<div class="label label_field_<?php echo $field->name; ?>"><?php echo $label_str;?></div>
														<?php endif; ?>
													 	<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?> </div>
														</div>
							                	
													<?php endif;?>
							 				 	<?php endforeach; ?>
							                 </div>     
											<?php endif; ?>

											
							                </div >
											<?php endif; // ende fieldsfloat ?>
										
							                

											<?php // Description 
											if ( FlexicontentFields::getFieldDisplay($item, 'text', $values=null, $method='display')  ) :
												
												echo '<div class="description">' .$item->fields['text']->display . '</div>';
												
											endif;
											?>
										<div class="clearfix"></div>					 
							    			
						    		
						                
								        <?php if ($item->event->afterDisplayContent) : ?>
										<div class='afterDisplayContent'>
											<?php echo $item->event->afterDisplayContent; ?>
										</div> 
										<?php endif; ?>

										<?php
										
										if ( isset ($item->positions['line4']) ) :?>
						                 <div class="line4">
											<?php foreach ($item->positions['line4']  as $field) : // alle felder von position  line4 auflisten ?>
												
												<?php if (isset($field->display) || ($field->display) > '') : ?>
												<div class='flexi-field field_<?php echo $field->name; ?>'>
												<?php $label_str = '';
												if ($item->fields[$field->name]->parameters->get('display_label', 0)) :
													$label_str = $field->label.': '; ?>
												<div class="label label_field_<?php echo $field->name; ?>"><?php echo $label_str;?></div>
												<?php endif; ?>
											 	<div class="value value_<?php echo $field->name; ?>"><?php echo $field->display; ?> </div>
												</div>
												<?php endif;?>
						 				 	<?php endforeach; ?>
						                  </div>     
										<?php endif; ?>

								</div>		
				   			</div>	
			            
						 </div>			
				 </div> <?php // end flexi-item ?> 
				
             
               
              <?php endif; ?>
			<?php endforeach; ?>
		</div>
		

		</div> <?php /* full */?>
<?php endforeach; //  1. foreach?>

</div ></section> <?php /* FAQblock */?>

<div class="clearfix"></div>
<?php elseif ((($this->params->get('use_filters', 0)) && $this->filters) || ($this->params->get('use_search')) || ($this->params->get('show_alpha', 1))) : ?>
	       <div class="noitems"><?php echo JText::_( 'FLEXI_SELECT_NO_ITEMS_CAT' ); ?></div>
		<?php elseif ($this->getModel()->getState('limit')) : // Check case of creating a category view without items ?>
	       <div class="noitems"><?php echo JText::_( 'FLEXI_NO_ITEMS_CAT' ); ?></div>
<?php endif; ?>
