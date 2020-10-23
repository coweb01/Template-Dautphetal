<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\CMS\Factory;
$user             = Factory::getUser();
$noAccessBuerger  = true;
//var_dump($user);

if ( $user ) :
	$userlevels = ( $user->getAuthorisedViewLevels());
	
	foreach ( $userlevels as $level ) :
		if ( $level == 6 || $level == 7 || $level == 3 )  :
			$noAccessBuerger = false;
			break; 
		endif;	
	endforeach;	
endif; 

$page_classes  = '';
$page_classes .= $this->pageclass_sfx ? ' page'.$this->pageclass_sfx : '';
$page_classes .= ' fccategory fccat'.$this->category->id;
$menu = JFactory::getApplication()->getMenu()->getActive();
if ($menu) $page_classes .= ' menuitem'.$menu->id; 

?>
<div id="flexicontent" class="flexicontent <?php echo $page_classes; ?>" >

<?php if (JRequest::getCmd('print')) : ?>
<!-- BOF buttons -->

	<?php if ($this->params->get('print_behaviour', 'auto') == 'auto') : ?>
		<script type="text/javascript">jQuery(document).ready(function(){ window.print(); });</script>
	<?php	elseif ($this->params->get('print_behaviour') == 'button') : ?>
		<input type='button' id='printBtn' name='printBtn' value='<?php echo JText::_('Print');?>' class='btn btn-info' onclick='this.style.display="none"; window.print(); return false;'>
	<?php endif; ?>

<?php else : ?>
	<?php
	if ( $noAccessBuerger == false ) : // anzeige des Addbuttons nur Gruppe Rathausadmin, Superuser, Special
		$_add_btn   =  flexicontent_html::addbutton( $this->params, $this->category);
	endif; 

	$_print_btn = flexicontent_html::printbutton( $this->print_link, $this->params );
	$_mail_btn  = flexicontent_html::mailbutton( 'category', $this->params, $this->category->slug );
	$_csv_btn   = flexicontent_html::csvbutton( 'category', $this->params, $this->category->slug );
	$_feed_btn  = flexicontent_html::feedbutton( 'category', $this->params, $this->category->slug );
	?>

	<?php if ( isset($_add_btn) || isset($_csv_btn) ) : ?>
	
		<?php if ($this->params->get('btn_grp_dropdown')) : ?>
		
		<div class="buttons btn-group">
		  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
		    <span class="<?php echo $this->params->get('btn_grp_dropdown_class', 'icon-options'); ?>"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
		    <?php echo $_add_btn   ? '<li>'.$_add_btn.'</li>' : ''; ?>
		    <?php echo $_csv_btn  ? '<li>'.$_csv_btn.'</li>' : ''; ?>
		  </ul>
		</div>
		
	  <?php else : ?>
	  
		<div class="admin-button buttons">
	    <?php echo $_add_btn; ?>	    
	    <?php echo $_csv_btn; ?>    
		</div>

		<?php endif; ?>
<!-- EOF buttons -->
		
	<?php endif; ?>
	
<?php endif; ?>

<?php if ($this->params->get('show_page_heading', 1)) : ?>
<!-- BOF page title -->	
	<header class="group">
		<h1 class="componentheading">
			<?php echo $this->params->get( 'page_heading' ) ?>
		</h1>
<!-- EOF page title -->
<?php endif; ?>

<!-- BOF author description -->
<?php if (@$this->authordescr_item_html) echo $this->authordescr_item_html; ?>
<!-- EOF author description -->

<?php if ($this->params->get('show_page_heading', 1)) echo '</header>'; ?>

<?php if ($this->category->id || (count($this->categories) && $this->params->get('show_subcategories'))) echo '<section class="group">'; ?>

<?php if ( $this->category->id > 0) : /* Category specific data may not be not available, e.g. for -author- layout view */ ?>
<!-- BOF category info -->

		<?php
		// Only show this part if some category info is to be printed
		if (
			$this->params->get('show_cat_title', 1) ||
			($this->params->get('show_description_image', 1) && $this->category->image) ||
			($this->params->get('show_description', 1) && $this->category->description)
		) :
			echo $this->loadTemplate('category_html5');
		endif;
		?>
<!-- EOF category info -->
<?php endif; ?>
	
<?php 
	// Only show this part if subcategories are available
	if ( count($this->categories) && $this->params->get('show_subcategories') ) : ?>
	<!-- BOF sub-categories info -->

	<?php echo file_exists(dirname(__FILE__).DS.'category_subcategories_html5.php') ?  $this->loadTemplate('subcategories_html5') : 'FILE MISSING: category_subcategories_html5.php <br/>';?>
	<!-- EOF sub-categories info -->

<?php endif; ?>
	
<?php 
	// Only show this part if subcategories are available
	if ( count($this->peercats) && $this->params->get('show_peercategories') ) : ?>
	
	<!-- BOF peer-categories info -->

	<?php echo file_exists(dirname(__FILE__).DS.'category_peercategories_html5.php') ?  $this->loadTemplate('peercategories_html5') : 'FILE MISSING: category_peercategories_html5.php <br/>'; ?>
	
	<!-- EOF peer-categories info -->

	<?php endif; ?>


<?php if ($this->category->id || (count($this->categories) && $this->params->get('show_subcategories')))  echo '</section>'; ?>

<!-- BOF item list display -->
<?php
	echo $this->loadTemplate('items_html5');
	

	//echo  empty($this->items) && $this->getModel()->getState('limit') ? '<span class="fc_return_msg">'.JText::sprintf('FLEXI_CLICK_HERE_TO_RETURN', '"JavaScript:window.history.back();"').'</span>' : "";
?>
<!-- BOF item list display -->

<!-- BOF pagination -->
<?php
	// If customizing via CSS rules or JS scripts is not enough, then please copy the following file here to customize the HTML too
	include('pagination.php');
?>
<!-- EOF pagination -->

</div>

<?php if ($_feed_btn || $_mail_btn || $_print_btn ) { ?>
<div id="bookmark" class="buttons">
<?php echo $_print_btn; ?>
<?php echo $_mail_btn; ?>
<?php echo $_feed_btn; ?>
</div>
<?php } ?>