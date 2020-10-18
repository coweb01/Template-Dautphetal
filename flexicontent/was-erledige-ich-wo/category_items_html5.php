<?php
/**
 * @version 1.5 stable $Id: category_items.php 1224 2012-04-01 03:09:16Z ggppdk $
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
 * 
 *
 *  Was erledige-ich-wo Verzechniss für Kommunen HTML5
 *  Author: webconcept
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
// first define the template name
$tmpl = $this->tmpl;
$user = JFactory::getUser();
$app       = JFactory::getApplication();
$template  = $app->getTemplate(); 

$firstletter = "";
$firstletterBefore = "";
$classcol = ""; 

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

$layout     = $this->params->get('clayout', 'default');
$fbypos     = flexicontent_tmpl::getFieldsByPositions($layout, 'category');
$positions  = array(1=>'zeile1', 2=>'zeile2', 3=>'zeile3_sp', 4=>'zeile4');

if ($this->items) :
// routine to determine all used columns for zeile1
	
	$columns = array();

	foreach ($this->items as $item) :
		//  Felder Zeile 1,2,4
		for ($i = 1; $i <= 4; $i++) :
			$position = $positions[$i];
			if (isset($item->positions[$position])) :
				foreach ($fbypos[$position]->fields as $f) :
					if (!in_array($f, $columns)) :
						$columns[$position][$f] = @$item->fields[$f]->label;
					endif;
				endforeach;
			endif;
		endfor;

		// Felder Zeile 3
		$spcount = 4;	
		$col = 0;	
					
		for ($i=1; $i<=$spcount; $i++) :
			if (isset($item->positions['zeile3_sp'.$i])) :
		        $zeile3 = true;
		        //$columns['zeile2_sp'.$i] =  array();
		    	$position = $positions[3];
				
				foreach ($fbypos[$position.$i]->fields as $f) :
			      if (!in_array($f, $columns) ) :
					$columns[$position.$i][$f] = @$item->fields[$f]->label;
				  endif;
				endforeach;	
		   endif; 				
		endfor;

    
	endforeach;

?>
<?php
$items = & $this->items;

// Decide whether to show the edit column
$buttons_exists = false;

if ( $user->id ) :
	
	$show_editbutton = $this->params->get('show_editbutton', 1);
	foreach ($items as $item) :
	
		if ( $show_editbutton ) :
			if ($item->editbutton = flexicontent_html::editbutton( $item, $this->params )) :
				$buttons_exists = true;
				$item->editbutton = '<div class="fc_edit_link_nopad">'.$item->editbutton.'</div>';
			endif;
			if ($item->statebutton = flexicontent_html::statebutton( $item, $this->params )) :
				$buttons_exists = true;
				$item->statebutton = '<div class="fc_state_toggle_link_nopad">'.$item->statebutton.'</div>';
			endif;
		endif;
		
		if ($item->approvalbutton = flexicontent_html::approvalbutton( $item, $this->params )) :
			$buttons_exists = true;
			$item->approvalbutton = '<div class="fc_approval_request_link_nopad">'.$item->approvalbutton.'</div>';
		endif;
		if ($item->deletebutton = flexicontent_html::deletebutton( $item, $this->params )) :
			$buttons_exists = true;
			$item->deletebutton = '<div class="fc_delete_link_nopad">'.$item->deletebutton.'</div>';
		endif;
	endforeach;
	
endif;
?>

<?php
	if (!$this->params->get('show_title', 1) && $this->params->get('limit', 0) && !count($columns)) :
		
		$this->params->set('show_title', 1);
	endif;
?>

	<?php if ($this->params->get('show_title', 1) || count($columns)) : ?>
        
	<div id="verzeichnis-liste">
        <?php if ($this->params->get('show_field_labels_row',1)) : ?>
        <header> 
			<ul class="header-flexilst">
			<li class="beschriftung <?php echo $name; ?>" >
			<?php echo 'Stichwort'; ?></li>
	        </ul>
	        <div class="clear"></div> 
        </header>
        <?php endif; ?>
        
     	<article>
			<div class="items-flexilst">
	<?php $row = 1;?>		
	<?php foreach ($this->items as $item) : 				
		if($item->state!=-2) : ?>
			<ul class="flexi-row <?php echo $row%2 ? 'odd' : 'even' ?>">
				<li class="flexi-item zeile1">
				<?php foreach ($columns['zeile1'] as $name => $label) : ?>
               
				<?php if ( $buttons_exists ) : ?>
					<div class="adminbuttons d-flex">
					<?php echo @ $item->editbutton; ?>
					<?php echo @ $item->statebutton; ?>
					<?php echo @ $item->approvalbutton; ?>
                    </div>
				<?php endif; ?>
					   
			   
			   
			    <?php  $classfirst = "";?>
				<?php if ($name == "title") {
	                    $string =   $item->title;				    	
						$firstletter =  mb_substr($string,0,1,"UTF-8");
					   } // 1. Buchstaben aus titel ermitteln
					
					if ($firstletter != $firstletterBefore) { 
					$classfirst = "ersterB";
					$firstletterBefore = $firstletter; ?>
					<div class="ersterB"><p><?php echo $firstletter; ?></p></div> 
					<?php } // Ende 
                ?>
					<div class="<?php echo $name; ?> zeile1 ">
					<?php if (isset($item->positions['zeile1']->{$name}->display)) :?>
						<?php echo $item->positions['zeile1']->{$name}->display;?>
						<?php else : ?><span>&nbsp;</span>
					<?php endif; ?>
					</div>
				<?php endforeach; ?>
                </li>
                
                <?php if ( isset($item->positions['zeile2']) )  : ?>
                <li class="flexi-item zeile2">
                
                <?php $i=0;
                    foreach ($columns['zeile2'] as $name => $label) : ?>
					<?php if ($i==0) { ?> <div class="title-zeile2">&nbsp;</div><?php } ?>
                    <?php $classcol = "item-col".$i; ?>
					<?php if (isset($item->positions['zeile2']->{$name}->display)) :?>
							<div class="field-<?php echo $name; ?> <?php echo $classcol; ?>">
								<?php echo $item->positions['zeile2']->{$name}->display;?>
							</div>
						<?php endif; ?>
                    <?php $i++; ?>
				<?php endforeach; ?>
                
				</li>
				<?php endif;?>	
 				
 				<?php if (isset( $zeile3 )  ) : ?>
                <li class="flexi-item zeile3 row">
							<?php $spcount   = 4; ?>
							<?php $position  = $positions[3]; ?>

							<?php for ($i=1; $i<=$spcount; $i++) : ?>
							  <div class="col col-12 col-12 col-md-6 col-lg-3">
								 <?php if ( isset ($columns[$position.$i] ) ) : ?>
                                	<?php foreach ($columns[$position.$i] as $name => $label) : // zeile 2 ?>
										<?php if (isset($item->positions[$position.$i]->{$name}->display)) :?>
                                            <?php echo $item->positions[$position.$i]->{$name}->display;?>
                                   		 <?php endif; ?>
                                	<?php endforeach; ?>
                                <?php endif; ?>
							  </div>
                            <?php endfor; ?>
                </li> <!-- Ende Zeile 3 -->
                <?php endif; ?>

                <?php if ( isset($item->positions['zeile4']) )  : ?>
                <li class="flexi-item zeile4">
                
                <?php 
                foreach ($columns['zeile4'] as $name => $label) : ?>
					
					<?php if (isset($item->positions['zeile4']->{$name}->display)) :?>
							<div class="field-<?php echo $name; ?>">
								<?php echo $item->positions['zeile4']->{$name}->display;?>
							</div>
					<?php endif; ?>
                   
				<?php endforeach; ?>
                
				</li>
				<?php endif;?>	
 				<?php $row++;?>
 			</ul>	
 		<?php endif;?>
	<?php endforeach; // ende Schleife Items?>

			</div>
        </article>
	</div>		
	<?php endif;  // Ende Items vorhanden?> 

<?php elseif ($this->getModel()->getState('limit')) : // Check case of creating a category view without items ?>
	<div class="noitems"><?php echo JText::_( 'FLEXI_NO_ITEMS_CAT' ); ?></div>
<?php endif; ?>
