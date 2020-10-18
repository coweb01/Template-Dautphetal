<?php
/**
 * @version 1.5 stable $Id: item.php 1370 2012-07-08 01:24:53Z ggppdk $
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
 * Personenverzeichnis HTML5
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\String\StringHelper;

// first define the template name
$tmpl                  = $this->tmpl; // for backwards compatiblity
$item                  = $this->item;
$app                   = JFactory::getApplication();
$template      		   = $app->getTemplate(); 
$menuparams    		   = $app->getParams(); //Parameter Menue
$grid_framework        = $this->params->get('grid_framework', 1 );
$top_cols              = $this->params->get('top_cols', 2 );
$bottom_cols           = $this->params->get('bottom_cols', 2);

// Ergaenzung Template Variables webconcept Bootstrap 3 Template


$arr_cols_gridclasses   	=  array(
								array(1=>'col-md-12',2=>'col-md-6',3=>'col-md-4',4=>'col-md-3'),
           					    array(1=>'uk-width-large-1-1',2=>'uk-width-large-1-2',3=>'uk-width-large-1-3',4=>'uk-width-large-1-4')
           					  );

$arr_cols_gridclasses_sm    = array(
								array(1=>'col-sm-12',2=>'col-sm-6',3=>'col-sm-4'),
  								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-1-3')
  								);
$arr_cols_gridclasses_lg    = array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-4'),
  								array(1=>'uk-width-xlarge-1-1',2=>'uk-width-xlarge-1-2',3=>'uk-width-xlarge-1-3')
  								);

$arr_cols_gridclasses_xs   	= array(
								array(1=>'col-xs-12',2=>'col-xs-6',3=>'col-xs-4'),
  								array(1=>'uk-width-small-1-1',2=>'uk-width-small-1-2',3=>'uk-width-small-1-3')
  								);

$arr_cols_gridclasses_dbl  	= array(
								array(1=>'col-md-12',2=>'col-md-6',3=>'col-md-8',4=>'col-md-6'),
								array(1=>'uk-width-medium-1-1',2=>'uk-width-medium-1-2',3=>'uk-width-medium-2-3',4=>'uk-width-medium-2-4')
								);
$arr_cols_gridclasses_dbl_lg  	= array(
								array(1=>'col-lg-12',2=>'col-lg-6',3=>'col-lg-8',4=>'col-lg-6'),
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


// end webconcept 


$page_classes  = '';
$page_classes .= $this->pageclass_sfx ? ' page'.$this->pageclass_sfx : '';
$page_classes .= ' items item'.$item->id;
$page_classes .= ' type'.$item->type_id;

if ((isset($item->positions['image'])) && (isset($item->positions['top']))) {
	$cols_topblock = '2';
} else { $cols_topblock = '1'; }

//***********
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
	$menuparams->get('page_heading'); /* != $item->title &&
	$this->params->get('show_title', 1);*/

// Main container
$mainAreaTag = $page_heading_shown ? 'section' : 'article';

// SEO, header level of title tag
$itemTitleHeaderLevel = $page_heading_shown ? '2' : '1'; 

// SEO
$microdata_itemtype = $this->params->get( 'microdata_itemtype');
$microdata_itemtype_code = $microdata_itemtype ? 'itemscope itemtype="http://schema.org/'.$microdata_itemtype.'"' : '';
?>


<div id="flexicontent" class="flexicontent" >


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
		<h1>
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
		<div class='fc_afterDisplayTitle' style='clear:both;'>
			<?php echo $item->event->afterDisplayTitle; ?>
		</div>
  <?php endif; ?>
		
    <section>
	<?php if (isset($item->positions['subtitle1'])) : ?>
	<div class="flexi lineinfo subtitle1 <?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
        <div class="<?php echo $cols_gridclasses[1];?>">
        	<div class="bg">
			  <?php foreach ($item->positions['subtitle1'] as $field) : ?>
	          <div class="flexi element">
	              <?php if ($field->label) : ?>
	              <label class="flexi label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></label>
	              <?php endif; ?>
	              <div class="flexi value value_field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
	          </div>
			<?php endforeach; ?>
			</div>
		</div>
    </div>
	<?php endif; ?>
	
	<?php if (isset($item->positions['subtitle2'])) : ?>
	<div class="flexi lineinfo subtitle2 <?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
        <div class="<?php echo $cols_gridclasses[1];?>">
        	<div class="bg">
				<?php foreach ($item->positions['subtitle2'] as $field) : ?>
	            <div class="flexi element">
	                <?php if ($field->label) : ?>
	                <label class="label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></label>
	                <?php endif; ?>
	                <div class="flexi value value_field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
	            </div>
				<?php endforeach; ?>
			</div>
		</div>
    </div>
	<?php endif; ?>
	
	<?php if (isset($item->positions['subtitle3'])) : ?>
	<div class="flexi lineinfo subtitle3 <?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
        <div class="<?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
        <div class="<?php echo $cols_gridclasses[1];?>">
			<div class="bg">
				<?php foreach ($item->positions['subtitle3'] as $field) : ?>
				<div class="flexi element">
					<?php if ($field->label) : ?>
					<label class="flexilabel_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></label>
					<?php endif; ?>
					<div class="flexi value value_field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
    </div>
	<?php endif; ?>
	
	<div class="clearfix"></div>
	<?php if ((isset($item->positions['image'])) || (isset($item->positions['top']))) : ?>
	
    <div class="flexi topblock <?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">  
		<?php if (isset($item->positions['image'])) : ?>
			<?php foreach ($item->positions['image'] as $field) : ?>
		<figure class="<?php echo $cols_gridclasses_xs[1] .' '. $cols_gridclasses_sm[$cols_topblock] .' '. $cols_gridclasses[$cols_topblock];?> flexi image field_<?php echo $field->name; ?>">
			<?php echo $field->display; ?>
			<div class="clear"></div>
		</figure>
			<?php endforeach; ?>
		<?php endif; ?>
        
		<?php if (isset($item->positions['top'])) : ?>
		<div class="<?php echo $cols_gridclasses_xs[1] .' '. $cols_gridclasses_sm[$cols_topblock] .' '. $cols_gridclasses[$cols_topblock];?>">
          <div class="flexi infoblock <?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
              <ul class="flexi <?php echo $cols_gridclasses_xs[1] .' '. $cols_gridclasses_sm[$top_cols] .' '. $cols_gridclasses[$top_cols];?>">
                  <?php foreach ($item->positions['top'] as $field) : ?>
                  <li class='flexi'>
                      <div class="flexi_field_<?php echo $field->name; ?>">
                          <?php if ($field->label) : ?>
                          <label class="flexi label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></label>
                          <?php endif; ?>
                          <div class="flexi value value_field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
                      </div>
                  </li>
                  <?php endforeach; ?>
              </ul>
          </div>
        </div>
		<?php endif; ?>
	
	</div>
	<?php endif; ?>
	
	<div class="clearfix"></div>
	
	<?php if (isset($item->toc)) : ?>
		<?php echo $item->toc; ?>
	<?php endif; ?>
	
	<?php if (isset($item->positions['description'])) : ?>
	<div class="<?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>" >
      <div class="description <?php echo $cols_gridclasses_xs[1] .' '. $cols_gridclasses_sm[1] .' '. $cols_gridclasses[1];?>>
          <?php foreach ($item->positions['description'] as $field) : ?>
			  <div class="field_<?php echo $field->name; ?>">
				<?php if ($field->label) : ?>
                <label class="flexi label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></label>
                <?php endif; ?>
                <div class="flexi value value_field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
              </div>
          <?php endforeach; ?>
      </div>
    </div>
	<?php endif; ?>
	
	<div class="clearfix"></div>
	
	<?php if (isset($item->positions['bottom'])) : ?>
	<div class="flexi infoblock <?php echo ( $grid_framework == 0 ) ? $classnum : ''; ?> <?php echo ($grid_framework == 2) ? 'uk-grid' : '';?> <?php echo ( $grid_framework == 1 ) ? 'row' : ''; ?>">
		<ul class="flexi <?php echo $cols_gridclasses_xs[1] .' '. $cols_gridclasses_sm[$bottom_cols] .' '. $cols_gridclasses[$bottom_cols];?>">
			<?php foreach ($item->positions['bottom'] as $field) : ?>
			<li class='flexi'>
				<div class="flexi_field_<?php echo $field->name; ?>">
					<?php if ($field->label) : ?>
					<label class="flexi label_field_<?php echo $field->name; ?>"><?php echo $field->label; ?></label>
					<?php endif; ?>
					<div class="flexi_value value_field_<?php echo $field->name; ?>"><?php echo $field->display; ?></div>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
    
    </section>
    
	

<?php if ($item->event->afterDisplayContent) : ?>
	<div class='fc_afterDisplayContent' style='clear:both;'>
		<?php echo $item->event->afterDisplayContent; ?>
	</div>
<?php endif; ?>

	
</div>
  
<?php if ($pdfbutton || $mailbutton || $printbutton ) : ?>
<div id="bookmark" class="buttons">	
	<?php echo $pdfbutton; ?>
	<?php echo $mailbutton; ?>
	<?php echo $printbutton; ?>
</div>		
<?php endif; ?>	