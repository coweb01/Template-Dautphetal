<?php
/**
 * @package          Joomla.Plugin
 * @subpackage       Content.Jtf
 *
 * @author           Claudia Oerter das webconcept
 * @copyright    (c) 2017 JoomTools.de - All rights reserved.
 * @license          GNU General Public License version 3 or later
 */

defined('JPATH_BASE') or die;

extract($displayData);


/**
 * Layout variables
 * ---------------------
 * @var   array   $options  Optional parameters.
 * @var   string  $label    he html code for the label (not required if $options['hiddenLabel'] is true).
 * @var   string  $input    The input field html code.
 */

if (!empty($options['showonEnabled']))
{
	JHtml::_('jquery.framework');
	JHtml::_('script', 'jui/cms.js', array('version' => 'auto', 'relative' => true));
	JHtml::_('script', 'plugins/content/jtf/assets/js/showon.min.js', array('version' => 'auto'));
}

$container  = array();
$gridlabel  = '';
$gridfield  = '';
$fieldclass = '';

if ($options['optionlabelclass'] > '') {
	$fieldclass = $options['optionlabelclass'];

}


if (!empty($options['gridgroup']))
{
	$container[] = ' class="' . $options['gridgroup'] . ' ' .$fieldclass .'"';
}

if (!empty($options['rel']))
{
	$container[] = $options['rel'];
}

if (!empty($options['hiddenLabel']))
{
	$options['gridlabel'] = !empty($options['gridlabel'])
		? $options['gridlabel'] . ' jtfhp'
		: 'jtfhp';
}

if (!empty($options['gridlabel']))
{
	$gridlabel = ' class="' . $options['gridlabel'] . '"';
}

if (!empty($options['gridfield']))
{
	//$gridfield = ' class="' . $options['gridfield'] . '"';
    $gridfield = ' class="col"';

}

if ( !empty( $container ) ) {

?>

<div<?php echo implode(' ', $container); ?>>

	<?php if (empty($input)) : ?>
		<?php echo $label; ?>
	<?php else : ?>
		<div<?php echo $gridlabel; ?>>
			<?php echo $label; ?>
		</div>


		<div<?php echo $gridfield; ?>>

			<?php if (!empty($options['icon']))
			{ ?>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="<?php echo $options['icon'];?>"></i></div>
					</div>
					<?php echo $input; ?>

				</div>

				<?php /*echo $this->sublayout('icon_prepend',
					array(
						'icon'  => $options['icon'],
						'input' => $input,
					)
				); */

			}
			else
			{
				echo $input;
			} ?>

		</div>

	<?php endif; ?>

</div>

<?php } else { 

   echo $input;
}

?>