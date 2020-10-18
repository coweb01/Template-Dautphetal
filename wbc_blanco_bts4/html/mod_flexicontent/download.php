<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$tooltip_class = FLEXI_J30GE ? 'hasTooltip' : 'hasTip';
$container_id = $module->id . (count($catdata_arr)>1 && $catdata ? '_'.$catdata->id : '');
?>

<div class="default mod_flexicontent_wrapper mod_flexicontent_wrap<?php echo $moduleclass_sfx; ?>" id="mod_flexicontent_default<?php echo $container_id; ?>">
	
	<?php
	// Display FavList Information (if enabled)
	include(JPATH_SITE.'/modules/mod_flexicontent/tmpl_common/favlist.php');
	
	// Display Category Information (if enabled)
	include(JPATH_SITE.'/modules/mod_flexicontent/tmpl_common/category.php');
	
	$ord_titles = array(
		'popular'=>JText::_( 'FLEXI_UMOD_MOST_POPULAR'),  // popular == hits
		'rhits'=>JText::_( 'FLEXI_UMOD_LESS_VIEWED'),
		
		'author'=>JText::_( 'FLEXI_UMOD_AUTHOR_ALPHABETICAL'),
		'rauthor'=>JText::_( 'FLEXI_UMOD_AUTHOR_ALPHABETICAL_REVERSE'),
		
		'published'=>JText::_( 'FLEXI_UMOD_RECENTLY_PUBLISHED_SCHEDULED'),
		'published_oldest'=>JText::_( 'FLEXI_UMOD_OLDEST_PUBLISHED_SCHEDULED'),
		'expired'=>JText::_( 'FLEXI_UMOD_FLEXI_RECENTLY_EXPIRING_EXPIRED'),
		'expired_oldest'=>JText::_( 'FLEXI_UMOD_OLDEST_EXPIRING_EXPIRED_FIRST'),
		
		'commented'=>JText::_( 'FLEXI_UMOD_MOST_COMMENTED'),
		'rated'=>JText::_( 'FLEXI_UMOD_BEST_RATED' ),
		
		'added'=>	JText::_( 'FLEXI_UMOD_RECENTLY_ADDED'),  // added == rdate
		'addedrev'=>JText::_( 'FLEXI_UMOD_RECENTLY_ADDED_REVERSE' ),  // addedrev == date
		'updated'=>JText::_( 'FLEXI_UMOD_RECENTLY_UPDATED'),  // updated == modified
		
		'alpha'=>	JText::_( 'FLEXI_UMOD_ALPHABETICAL'),
		'alpharev'=>JText::_( 'FLEXI_UMOD_ALPHABETICAL_REVERSE'),   // alpharev == ralpha
		
		'id'=>JText::_( 'FLEXI_UMOD_HIGHEST_ITEM_ID'),
		'rid'=>JText::_( 'FLEXI_UMOD_LOWEST_ITEM_ID'),
		
		'catorder'=>JText::_( 'FLEXI_UMOD_CAT_ORDER'),  // catorder == order
		'jorder'=>JText::_( 'FLEXI_UMOD_CAT_ORDER_JOOMLA'),
		'random'=>JText::_( 'FLEXI_UMOD_RANDOM_ITEMS' ),
		'field'=>JText::sprintf( 'FLEXI_UMOD_CUSTOM_FIELD', $orderby_custom_field->label)
	);
	
	$separator = "";
	
	foreach ($ordering as $ord) :
  	echo $separator;
	  if (isset($list[$ord]['featured']) || isset($list[$ord]['standard'])) {
  	  $separator = "<div class='ordering_separator' ></div>";
    } else {
  	  $separator = "";
  	  continue;
  	}
	?>
	<div id="<?php echo 'order_'.( $ord ? $ord : 'default' ) . $module->id; ?>" class="mod_flexicontent">
		
		<?php	if ($ordering_addtitle && $ord) : ?>
		<div class='order_group_title'><?php echo isset($ord_titles[$ord]) ? $ord_titles[$ord] : $ord; ?></div>
		<?php endif; ?>
		
		<?php if (isset($list[$ord]['featured'])) : ?>
		<!-- BOF featured items -->
		<div class="wbc-downloads">
			
			<?php foreach ($list[$ord]['featured'] as $item) : ?>
			<div class="<?php echo $item->is_active_item ? 'fcitem_active' : ''; ?>" >
				

				<!-- BOF item title -->
				<?php ob_start(); ?>

					<?php if ($display_title_feat) : ?>
						<div class="fcitem_title_box">
							<span class="fcitem_title">
							<?php if ($link_title_feat) : ?>
								<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
							<?php else : ?>
								<?php echo $item->title; ?>
							<?php endif; ?>
							</span>
						</div>
					<?php endif; ?>

				<?php $captured_title = ob_get_clean(); $hasTitle = (boolean) trim($captured_title); ?>
				<!-- EOF item title -->


				<?php if ($use_fields_feat && @$item->fields && $fields_feat) : ?>
				<div class="fc_block fcitem_fields">

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


			</div>
			<!-- EOF current item -->
			<?php endforeach; ?>
			
		</div>
		<!-- EOF featured items -->
		<?php endif; ?>
		
		
		<?php if (isset($list[$ord]['standard'])) : ?>
		<!-- BOF standard items -->
		
		<div class="wbc-downloads">
			
			<?php foreach ($list[$ord]['standard'] as $item) : ?>
			<div class="<?php echo $item->is_active_item ? 'fcitem_active' : ''; ?>" >
				
				
				<!-- BOF item title -->
				<?php ob_start(); ?>

					<?php if ($display_title) : ?>
					
						<div class="fcitem_title">
						<?php if ($link_title) : ?>
							<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
						<?php else : ?>
							<?php echo $item->title; ?>
						<?php endif; ?>
						</divn>
						
					<?php endif; ?>

				<?php $captured_title = ob_get_clean(); $hasTitle = (boolean) trim($captured_title); ?>
				<!-- EOF item title -->

				<?php if ($use_fields && @$item->fields && $fields) : ?>
				<div class="fc_block fcitem_fields">

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


			</div>
			<!-- EOF current item -->
			<?php endforeach; ?>
			
		</div>
		<!-- EOF standard items -->
		<?php endif; ?>
		
	</div>
	<?php endforeach; ?>
	
	<?php
	// Display readon of module
	include(JPATH_SITE.'/modules/mod_flexicontent/tmpl_common/readon.php');
	?>
	
</div>