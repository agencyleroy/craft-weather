<?php
namespace Craft;

class WeatherPlugin extends BasePlugin
{

	// Properties
	// =========================================================================

	/**
	 * @var
	 */
	private $_settings;

	// Public Methods
	// =========================================================================

	public function getName()
	{
		return Craft::t('Weather');
	}

	public function getVersion()
	{
		return '1.0';
	}

	public function getDeveloper()
	{
		return 'Agency Leroy';
	}

	public function getDeveloperUrl()
	{
		return 'http://www.agencyleroy.com';
	}

	public function init()
	{

		/**
		 * Get plugin settings
		 */
		$plugin = craft()->plugins->getPlugin('weather');
		$this->_settings = $plugin->getSettings();

	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('weather/settings', array(
			'settings'    => $this->getSettings()
		));
	}

	public function prepSettings($settings)
	{

		return $settings;
	}

	protected function defineSettings()
	{
		return array(
			'cacheDuration' => array(
				AttributeType::Number,
				'default' => 0
			)
		);
	}
}
