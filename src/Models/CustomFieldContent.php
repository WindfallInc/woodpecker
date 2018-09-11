<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomFieldContent extends Model
{
	public function customField() {
        return $this->belongsTo('App\CustomField');
	}
	public function content() {
        return $this->belongsTo('App\Content');
	}
}