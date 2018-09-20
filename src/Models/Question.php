<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	public function form() {
        return $this->belongsTo('App\Form');
	}
	public function children() {
				$children = Question::where('parent_id', $this->id)->get();
        return $children;
	}
	public function parent() {
        return $this->belongsTo('App\Question');
	}
}
