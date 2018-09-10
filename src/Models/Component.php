<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
	use SoftDeletes;
	public function contents() {
        return $this->belongsToMany('App\Content');
	}
	public function loop($slug) {
        $type =  Type::where('slug', $slug)->first();
				return $type->contents->where('published', 1);
	}
	public function randLoop($slug) {
        $type =  Type::where('slug', $slug)->first();
				return $type->contents->where('published', 1)->inRandomOrder();
	}
	public function forms() {
				$forms = Form::all();
				return $forms;
	}
	public function form() {
        return $this->belongsTo('App\Form');
	}
	public function images() {
        return $this->hasMany('App\Media');
	}

}
