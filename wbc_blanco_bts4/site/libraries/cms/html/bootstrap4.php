<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class for Bootstrap elements.
 *
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @since       3.0
 */
abstract class JHtmlBootstrap4
{
	/**
	 * @var    array  Array containing information for loaded files
	 * @since  3.0
	 */
	protected static $loaded = array();


	/**
	 * Add javascript support for Bootstrap accordians and insert the accordian
	 *
	 * @param   string  $selector  The ID selector for the tooltip.
	 * @param   array   $params    An array of options for the tooltip.
	 *                             Options for the tooltip can be:
	 *                             - parent  selector  If selector then all collapsible elements under the specified parent will be closed when this
	 *                                                 collapsible item is shown. (similar to traditional accordion behavior)
	 *                             - toggle  boolean   Toggles the collapsible element on invocation
	 *                             - active  string    Sets the active slide during load
	 *
	 * @return  string  HTML for the accordian
	 *
	 * @since   3.0
	 */
	public static function startAccordion($selector = 'myAccordian', $params = array())
	{
		$sig = md5(serialize(array($selector, $params)));

		if (!isset(static::$loaded[__METHOD__][$sig]))
		{
			// Include Bootstrap framework
			//static::framework();

			// Setup options object
			$opt['parent'] = isset($params['parent']) ? (boolean) $params['parent'] : false;
			$opt['toggle'] = isset($params['toggle']) ? (boolean) $params['toggle'] : true;
			$opt['active'] = isset($params['active']) ? (string) $params['active'] : '';

			$options = JHtml::getJSObject($opt);

			// Attach accordion to document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($){
					$('#$selector').collapse($options);
				})(jQuery);"
			);

			// Set static array
			static::$loaded[__METHOD__][$sig] = true;
			static::$loaded[__METHOD__]['active'] = $opt['active'];
		}

		return '<div id="' . $selector . '" class="accordion">';
	}

	/**
	 * Close the current accordion
	 *
	 * @return  string  HTML to close the accordian
	 *
	 * @since   3.0
	 */
	public static function endAccordion()
	{
		return '</div>';
	}

	/**
	 * Begins the display of a new accordion slide.
	 *
	 * @param   string  $selector  Identifier of the accordion group.
	 * @param   string  $text      Text to display.
	 * @param   string  $id        Identifier of the slide.
	 * @param   string  $class     Class of the accordion group.
	 *
	 * @return  string  HTML to add the slide
	 *
	 * @since   3.0
	 */
	public static function addSlide($selector, $text, $id, $class = '')
	{
		$in = (static::$loaded['JHtmlBootstrap4::startAccordion']['active'] == $id) ? ' in' : '';
		$class = (!empty($class)) ? ' ' . $class : '';

		$html = '<div class="card' . $class . '">'
			. '<div class="card-heading">'
			. '<h4 class="mb-0"><a href="#' . $id . '" data-parent="#' . $selector . '" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">'
			. $text
			. '</a></h4>'
			. '</div>'
			. '<div id="' . $id . '" class="collapse' . $in . '" >'
			. '<div class="card-body">';

		return $html;
	}

	/**
	 * Close the current slide
	 *
	 * @return  string  HTML to close the slide
	 *
	 * @since   3.0
	 */
	public static function endSlide()
	{
		return '</div></div></div>';
	}


	/**
	 * Creates a tab pane
	 *
	 * @param   string  $selector  The pane identifier.
	 * @param   array   $params    The parameters for the pane
	 *
	 * @return  string
	 *
	 * @since   3.1
	 */
	public static function startTabSet($selector = 'myTab', $params = array())
	{
		$sig = md5(serialize(array($selector, $params)));

		if (!isset(static::$loaded[__METHOD__][$sig]))
		{
			// Include Bootstrap framework
			//JHtml::_('bootstrap.framework');

			// Setup options object
			$opt['active'] = (isset($params['active']) && $params['active']) ? (string) $params['active'] : '';

			// Attach tabs to document
			JFactory::getDocument()
				->addScriptDeclaration(JLayoutHelper::render('libraries.cms.html.bootstrap.starttabsetscript', array('selector' => $selector)));

			// Set static array
			static::$loaded[__METHOD__][$sig] = true;
			static::$loaded[__METHOD__][$selector]['active'] = $opt['active'];
		}

		return JLayoutHelper::render('libraries.cms.html.bootstrap.starttabset', array('selector' => $selector));
	}

	/**
	 * Close the current tab pane
	 *
	 * @return  string  HTML to close the pane
	 *
	 * @since   3.1
	 */
	public static function endTabSet()
	{
		return JLayoutHelper::render('libraries.cms.html.bootstrap.endtabset');
	}

	/**
	 * Begins the display of a new tab content panel.
	 *
	 * @param   string  $selector  Identifier of the panel.
	 * @param   string  $id        The ID of the div element
	 * @param   string  $title     The title text for the new UL tab
	 *
	 * @return  string  HTML to start a new panel
	 *
	 * @since   3.1
	 */
	public static function addTab($selector, $id, $title)
	{
		static $tabScriptLayout = null;
		static $tabLayout = null;

		$tabScriptLayout = $tabScriptLayout === null ? new JLayoutFile('libraries.cms.html.bootstrap.addtabscript') : $tabScriptLayout;
		$tabLayout = $tabLayout === null ? new JLayoutFile('libraries.cms.html.bootstrap.addtab') : $tabLayout;

		$active = (static::$loaded['JHtmlBootstrap::startTabSet'][$selector]['active'] == $id) ? ' active' : '';

		// Inject tab into UL
		JFactory::getDocument()
			->addScriptDeclaration($tabScriptLayout->render(array('selector' => $selector, 'id' => $id, 'active' => $active, 'title' => $title)));

		return $tabLayout->render(array('id' => $id, 'active' => $active));
	}

	/**
	 * Close the current tab content panel
	 *
	 * @return  string  HTML to close the pane
	 *
	 * @since   3.1
	 */
	public static function endTab()
	{
		return JLayoutHelper::render('libraries.cms.html.bootstrap.endtab');
	}

	/**
	 * Creates a tab pane
	 *
	 * @param   string  $selector  The pane identifier.
	 * @param   array   $params    The parameters for the pane
	 *
	 * @return  string
	 *
	 * @since   3.0
	 * @deprecated  4.0	Use JHtml::_('bootstrap.startTabSet') instead.
	 */
	public static function startPane($selector = 'myTab', $params = array())
	{
		$sig = md5(serialize(array($selector, $params)));

		if (!isset(static::$loaded['JHtmlBootstrap::startTabSet'][$sig]))
		{
			// Include Bootstrap framework
			//JHtml::_('bootstrap.framework');

			// Setup options object
			$opt['active'] = isset($params['active']) ? (string) $params['active'] : '';

			// Attach tab to document
			JFactory::getDocument()->addScriptDeclaration(
				'jQuery(function($){
					$(' . json_encode('#' . $selector . ' a') . ').click(function (e) {
						e.preventDefault();
						$(this).tab("show");
					});
				});'
			);

			// Set static array
			static::$loaded['JHtmlBootstrap::startTabSet'][$sig] = true;
			static::$loaded['JHtmlBootstrap::startTabSet'][$selector]['active'] = $opt['active'];
		}

		return '<div class="tab-content" id="' . $selector . 'Content">';
	}

	/**
	 * Close the current tab pane
	 *
	 * @return  string  HTML to close the pane
	 *
	 * @since   3.0
	 * @deprecated  4.0	Use JHtml::_('bootstrap.endTabSet') instead.
	 */
	public static function endPane()
	{
		return '</div>';
	}

	/**
	 * Begins the display of a new tab content panel.
	 *
	 * @param   string  $selector  Identifier of the panel.
	 * @param   string  $id        The ID of the div element
	 *
	 * @return  string  HTML to start a new panel
	 *
	 * @since   3.0
	 * @deprecated  4.0 Use JHtml::_('bootstrap.addTab') instead.
	 */
	public static function addPanel($selector, $id)
	{
		$active = (static::$loaded['JHtmlBootstrap::startTabSet'][$selector]['active'] == $id) ? ' active' : '';

		return '<div id="' . $id . '" class="tab-pane' . $active . '">';
	}

	/**
	 * Close the current tab content panel
	 *
	 * @return  string  HTML to close the pane
	 *
	 * @since   3.0
	 * @deprecated  4.0 Use JHtml::_('bootstrap.endTab') instead.
	 */
	public static function endPanel()
	{
		return '</div>';
	}


}