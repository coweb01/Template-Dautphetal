<?php
/**
 * @package      Joomla.Plugin
 * @subpackage   Content.Jtf
 *
 * @author       Guido De Gobbis <support@joomtools.de>
 * @copyright    (c) 2017 JoomTools.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   string  $id             Form attribute id and name.
 * @var   \JForm  $form           JForm object instance.
 * @var   string  $enctype        Set form attribute enctype, if file field is set.
 * @var   string  $formClass      Classes for the form.
 * @var   string  $frwkCss        Css styles needed for selected css-framework.
 * @var   string  $controlFields  Form hidden control fields.
 * @var   string  $fillouttime    Minimum time to wait before submit form.
 */

$invalidColor            = '#ff0000';
$invalidBackgroundColor  = '#f2dede';
$role                    = '';
$frwk                    = $form->framework[0];

if ($frwk == 'bs3')
{
	$role = ' role="form"';
}

if ($fillouttime > 0)
{
	$jtfBadgeClass           = [];
	$jtfBadgeClass['uikit3'] = 'uk-badge';
	$jtfBadgeClass['uikit']  = 'uk-badge uk-badge-notification';
	$jtfBadgeClass['bs4']    = 'badge badge-dark';
	$jtfBadgeClass['bs3']    = 'badge';
	$jtfBadgeClass['joomla'] = 'badge badge-inverse';

	JFactory::getDocument()->addScriptDeclaration("
		if (typeof jtfttf === 'undefined') {
			var jtfttf = {},
				jtfBadgeClass = {};
		}
		
		jtfttf['" . $id . "'] = " . $fillouttime . ";
		jtfBadgeClass['" . $id . "'] = '" . $jtfBadgeClass[$frwk] . "';
	");
	JHtml::_('script', 'plugins/content/jtf/assets/js/timeToFill.min.js', array('version' => 'auto'));
}

JFactory::getDocument()->addStyleDeclaration(
	".invalid:not(label) { 
		border-color: " . $invalidColor . " !important;
		background-color: " . $invalidBackgroundColor . " !important;
	}
	.invalid { color: " . $invalidColor . " !important; }
	.inline { display: inline-block !important; }"
);

?>
<div class="jtf wbc-form">
	<form name="<?php echo $id; ?>"
		  id="<?php echo $id; ?>"
		  action="<?php echo JRoute::_("index.php"); ?>"
		  method="post"
		  class="<?php echo $formClass; ?>"
		<?php echo $role ?>
		<?php echo $enctype ?>
	>

		

		<?php foreach ($form->getFieldsets() as $fieldset) :
			$fieldsetClass = !empty($fieldset->class)
				? ' class="' . $fieldset->class . '"' : '';
			$fieldsetLabelClass = !empty($fieldset->labelClass)
				? ' class="' . $fieldset->labelClass . '"' : '';
			$fieldsetDescClass = !empty($fieldset->descClass)
				? ' class="' . $fieldset->descClass . '"' : ''; ?>

			<fieldset<?php echo $fieldsetClass; ?>>

				<?php if (!empty($fieldset->label)
					&& strlen($legend = trim(JText::_($fieldset->label)))
				) : ?>
					<legend<?php echo $fieldsetLabelClass; ?>><?php echo $legend; ?></legend>
				<?php endif; ?>

				<?php if (!empty($fieldset->description)
					&& strlen($desc = trim(JText::_($fieldset->description)))
				) : ?>
					<p<?php echo $fieldsetDescClass; ?>><?php echo $desc; ?></p>
				<?php endif; ?>

				
					<?php foreach ($form->getFieldset($fieldset->name) as $field)
					{
						echo $field->renderField();
					}
					?>
					

			</fieldset>
		<?php endforeach;

		// Set control fields to evaluate Form
		echo $controlFields;
		echo JHtml::_('form.token');
		?>

	</form>
</div>
