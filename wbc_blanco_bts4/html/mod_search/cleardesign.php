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
<div class="mod-search-cleardesign <?php echo $moduleclass_sfx ?>">
	<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline pull-right">
		<?php
		    $output  = '<div class="form-group form-group-sm">';
			$output .= '<label for="mod-search-searchword" class="sr-only">' . $label . '</label> ';


			$output .= '<span class="cleardesign"><i class="fa fa-search"></i> ';
			
			$input_output = '<input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="search-query form-control" type="text" size="' . $width . '" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />';
			$input_output .= '</span>';
			
			if ($button) :
			
				if ($imagebutton) :
					$btn_output = '<button class="button btn-sm btn-primary" onclick="this.form.searchword.focus();"><span class="glyphicon glyphicon-search"></span></button>';
				else :
					$btn_output = '<button class="button btn-sm btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
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
			endif;
   			$output .= '</div>';
			echo $output;
		?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>
