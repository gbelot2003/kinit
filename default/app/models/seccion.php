<?php

class Seccion extends ActiveRecord {
	public function initialize()
	{
		$this->has_one('entradas');
	}
}