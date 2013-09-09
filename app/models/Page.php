<?php

namespace Broken;

use Eloquent;

class Page extends Eloquent{

	protected $table = "pages";

	public function contents()
	{
		$this->hasMany('Broken\Content');
	}

}