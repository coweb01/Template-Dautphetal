<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="form-inline">
	<?php if ($params->get('pretext')) : ?>
		<div class="pretext">
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<div class="userdata">
		<div id="form-login-username" class="form-group">
			
				<?php if (!$params->get('usetext', 0)) : ?>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text hasTooltip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>"><i class="fas fa-user"></i></span>
							<label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
						</div>
						<input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>" />
					</div>
				<?php else : ?>
					<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
					<input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>" />
				<?php endif; ?>
			
		</div>
		<div id="form-login-password" class="form-group">
			
				<?php if (!$params->get('usetext', 0)) : ?>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"><i class="fas fa-key"></i>
							</span>
								<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
							</label>
						</div>
						<input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
					</div>
				<?php else : ?>
					<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
					<input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
				<?php endif; ?>
			
		</div>
		<?php if (count($twofactormethods) > 1) : ?>
		<div id="form-login-secretkey" class="form-group">
			
				<?php if (!$params->get('usetext', 0)) : ?>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>"><i class="fas fa-star"></i>
							</span>
							<label for="modlgn-secretkey" class="sr-only"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
							</label>
						</div>
						<input id="modlgn-secretkey" autocomplete="one-time-code" type="text" name="secretkey" class="form-control input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
						<span class="input-group-append width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
							<span class="input-group-text"><i class="fas fa-question-circle"></i></span>
						</span>
				</div>
				<?php else : ?>
					<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
					<input id="modlgn-secretkey" autocomplete="one-time-code" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
					<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
						<i class="fas fa-question-circle"></i>
					</span>
				<?php endif; ?>

			
		</div>
		<?php endif; ?>
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember" class="form-check">
			<label for="modlgn-remember" class="form-check-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?></label> 
			<input id="modlgn-remember" type="checkbox" name="remember" class="form-check-input" value="yes"/>
		</div>
		<?php endif; ?>
		<div id="form-login-submit" class="form-group">
			
				<button type="submit" tabindex="0" name="Submit" class="btn btn-primary login-button"><?php echo JText::_('JLOGIN'); ?></button>
			
		</div>
		<?php
			$usersConfig = JComponentHelper::getParams('com_users'); ?>
			<ul class="nav flex-column mt-3 mb-3">
			<?php if ($usersConfig->get('allowUserRegistration')) : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
			<?php echo JText::_('MOD_LOGIN_REGISTER'); ?> <i class="fas fa-chevron-right"></i></a>
				</li>
			<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
					<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
					<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
				</li>
			</ul>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
