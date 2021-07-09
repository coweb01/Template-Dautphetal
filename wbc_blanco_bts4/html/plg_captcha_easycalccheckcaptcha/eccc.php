<?php

/**
 * @copyright
 * @package        EasyCalcCheck Captcha - ECCC for Joomla! 3
 * @author         Viktor Vogel <admin@kubik-rubik.de>
 * @version        3.2.1-PRO - 2020-09-02
 * @link           https://kubik-rubik.de/ecc-easycalccheck-plus
 *
 * @license        GNU/GPL
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') || die('Restricted access');

?>
<input type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $classValue; ?>" value="" required="required" placeholder="<?php echo $placeholder; ?>"/>
<span class="d-block text-sm-left"><?php echo JText::_('WBC_CATPCHA_INFO'); ?></span>
