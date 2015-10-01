<?php
namespace Craft;

class WeatherVariable
{
  public function findById($id, $options = array())
  {
    return craft()->weather->findById($id, $options);
  }
}
