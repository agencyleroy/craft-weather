# Craft CMS Weather Plugin

Display weather station data in your templates. Uses the API provided by Open Weather Map .

## Usage:

Clone into your projects plugins/weather path.

In templates use

{{ dump(craft.weather.findById("myweatherstationid")) }}

See [Open Weather Map API](http://www.openweathermap.org) for more.
