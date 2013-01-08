#haversine
A simple PHP helper class that utilises the haversine formula to determine the distance between two passed latitude/longitude locations.

## Why?
If you need a distance from point A to point B on a sphere this is the perfect starting point.

## Default
By default this class defaults to the radius of the earth in kilometres.

## Usage
Simply include the haversine.php class:
```php
include 'haversine.php';
```
Instantiate your object:
```php
$objHaversine = new Haversine;
```
Call the getDistance() method, passing to it four arguments:
```php
$objHaversine->getDistance($startLat, $startLong, $endLat, $endLong);
```

## Demo
Although this helper class is not really designed to be used directly with any user input I have created a simple demo file (demo.php) to test the formula.