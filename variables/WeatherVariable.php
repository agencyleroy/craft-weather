<?php
namespace Craft;

class WeatherVariable
{
  public function findById($id)
  {
    return craft()->weather->findById($id);
  }
}
