<?php

/**
 * A simple helper class that utilises the haversine formula to determine the 
 * distance between 2 lat/long points on a sphere.
 * 
 * @author Matt Kirwan <matthewkirwan@gmail.com>
 * @license GNU General Public License http://opensource.org/licenses/gpl-2.0.php
 */
class Haversine
{
	private $radian;
	private $sphereRadius;

	private $startLatDeg;
	private $startLongDeg;
	private $endLatDeg;
	private $endLongDeg;

	private $startLatRad;
	private $startLongRad;
	private $endLatRad;
	private $endLongRad;

	private $latDiffRad;	
	private $longDiffRad;	

	private $orthodrome;
	private $orthodromicDistance;

	public $distance;

	public function __construct()
	{
		$this->radian = M_PI / 180;
		$this->sphereRadius = 6372.797; // Earth Radius in Kilometres
	}

	public function getDistance($startLat, $startLong, $endLat, $endLong)
	{
		$this->setStartLat($startLat);
		$this->setStartLong($startLong);
		$this->setEndLat($endLat);
		$this->setEndLong($endLong);

		$this->setRadians();
		$this->setLatDiffInRad();
		$this->setLongDiffInRad();

		$this->calculateOrthodromicDistance();
		$this->calculateOrthodrome();

		$this->calculateDistance();

		return $this->distance;
	}

	public function setStartLat($startLat = null)
	{
		$this->startLatDeg = $startLat;
	}

	public function setStartLong($startLong = null)
	{
		$this->startLongDeg = $startLong;
	}

	public function setEndLat($endLat = null)
	{
		$this->endLatDeg = $endLat;
	}

	public function setEndLong($endLong = null)
	{
		$this->endLongDeg = $endLong;
	}		

	public function setSphereRadius($radius = null)
	{
		if( is_numeric($radius) )
		{
			$this->sphereRadius = $radius;
		}
	}

	private function setRadians()
	{
		$this->startLatRad = $this->startLatDeg * $this->radian;
		$this->startLongRad = $this->startLongDeg * $this->radian;
		$this->endLatRad = $this->endLatDeg * $this->radian;
		$this->endLongRad = $this->endLongDeg * $this->radian;			
	}

	private function setLatDiffInRad()
	{
		$this->latDiffRad = $this->endLatRad - $this->startLatRad;
	}

	private function setLongDiffInRad()
	{
		$this->longDiffRad = $this->endLongRad - $this->startLongRad;
	}

	private function calculateOrthodromicDistance()
	{
		$this->orthodromicDistance = sin($this->latDiffRad/2) * sin($this->latDiffRad/2) + cos($this->startLatRad) * cos($this->endLatRad) * sin($this->longDiffRad/2) * sin($this->longDiffRad/2);
	}

	private function calculateOrthodrome()
	{
		$this->orthodrome = 2 * atan2( sqrt($this->orthodromicDistance), sqrt(1-$this->orthodromicDistance) );
	}

	private function calculateDistance()
	{
		$this->distance = $this->sphereRadius * $this->orthodrome;
	}

}