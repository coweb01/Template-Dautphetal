<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<fieldset id="users-profile-core" class="mb-3">
	    <div class="card">
            <div class="card-body">
            <h3 class="card-title"> <?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?>
                
            </h3>
            <div class="row">
                <div class="col-12 col-sm-4">
                     <span class="font-weight-bold"> <?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?></span>
                </div>
                <div class="col-12 col-sm-8">
                        <?php echo $this->data->name; ?>
                </div>
                <div class="col-12 col-sm-4">
                        <span class="font-weight-bold"><?php echo JText::_('COM_USERS_PROFILE_USERNAME_LABEL'); ?></span>
                </div>
                <div class="col-12 col-sm-8">
                        <?php echo htmlspecialchars($this->data->username); ?>
                </div>
                <div class="col-12 col-sm-4">
                       <span class="font-weight-bold"> <?php echo JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL'); ?></span>
                </div>
                <div class="col-12 col-sm-8">
                        <?php echo JHtml::_('date', $this->data->registerDate); ?>
                </div>
                <div class="col-12 col-sm-4">
                       <span class="font-weight-bold"> <?php echo JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL'); ?></span>
                </div>

                <?php if ($this->data->lastvisitDate != '0000-00-00 00:00:00'){?>
                        <div class="col-12 col-sm-8">
                                <?php echo JHtml::_('date', $this->data->lastvisitDate); ?>
                        </div>
                <?php }
                else
                {?>
                        <div class="col-12 col-sm-8">
                                <?php echo JText::_('COM_USERS_PROFILE_NEVER_VISITED'); ?>
                        </div>
                <?php } ?>

            </div>
            </div>
        </div>
</fieldset>
