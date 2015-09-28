<?php
namespace Craft;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\CurlException;


class WeatherService extends BaseApplicationComponent
{
	public function findById($id = "")
  {
		$settings = craft()->plugins->getPlugin('weather')->getSettings();

		$data = craft()->cache->get("weather-id-{$id}");
		if(!$data) {
			if($data = $this->_fetchById($id)) {
				if( !craft()->cache->set("weather-id-{$id}", $data, intval($settings->cacheDuration) * 60) ) {
					WeatherPlugin::log("Could not write to cache", LogLevel::Error);
				}
				return $data;
			}
			return null;
		}

		return $data;
  }

	protected function _fetchById($id)
	{
		try {
			$client = new Client('http://api.openweathermap.org');
			$client->setDefaultOption('query/id', $id);
			$request = $client->get('/data/2.5/weather', array('$e'));
			$response = $request->send();

		}catch(CurlException $e) {
			WeatherPlugin::log("Connection error to Open Weather Maps API", LogLevel::Error);
			return false;
		}

		if($response->isSuccessful()) {
			$data = $response->json();

			if($data['cod'] == 200) {
				return $data;
			}else {
				WeatherPlugin::log("Error: {$data['message']}", LogLevel::Error);
				return false;
			}
		}
	}

}
