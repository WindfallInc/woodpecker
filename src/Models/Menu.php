<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
	use SoftDeletes;
	public function navs() {
        return $this->hasMany('App\Nav');
	}
	public function parents() {
        $parents = $this->navs()->whereNull('parent_id')->get();
				return $parents;
	}
	public function templates() {
				return $this->belongsToMany('App\Template');
	}
}