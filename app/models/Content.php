<?php

namespace Broken;

use Eloquent;

class Content extends Eloquent{

	protected $table = "contents";

	public function page()
	{
		$this->belongsTo('Broken\Page');
	}
}