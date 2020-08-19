<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="mod-search search<?php echo $moduleclass_sfx ?>">
	<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline my-2 ">
		<?php
		    $output_pos  = "input-group-append";
			$output_pos  = ($button_pos == 'left') ? 'input-group-append' : 'input-group-prepend';
		    $output      = '<div class="input-group mb-3">';
			$output     .= '<label for="mod-search-searchword" class="sr-only">' . $label   . '</label> ';


			$output .= '<div class="input-group">';
			
			$input_output = '<input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="search-query form-control" type="text" size="' . $width . '" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />';
			
			if ($button) :
			
				if ($imagebutton) :
					$btn_output = '<div class="'. $output_pos .'"><button class="button btn-sm btn btn-outline-secondary" onclick="this.form.searchword.focus();"><span class="fa fa-search"></span></button></div>';
				else :
					$btn_output = '<div class="'. $output_pos .'"><button class="button btn-sm btn btn-outline-secondary" onclick="this.form.searchword.focus();">' . $button_text . '</button></div>';
				endif;
				
				switch ($button_pos) :
					case 'right' :
						$output .= $input_output;
						$output .= $btn_output;
						break;

					case 'left' :
					default :
						$output .= $btn_output;
						$output .= $input_output;
						break;
				endswitch;
			else : 
			    $output .= $input_output;
				$output .= '<span class="input-group-addon" id="search-img"><i class="fa fa-search"></i></span>';

			endif;
   			$output .= '</div></div>';
			echo $output;
		?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>
