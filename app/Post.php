<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //this is accessor method (starting with get and ending with Attribute)
	public function getImageUrlAttribute($value) {
		$imageUrl = '';
		if(!is_null($this->image)){
			$imagePath = public_path() . '/img/' . $this->image;
			if(file_exists($imagePath)){
				$imageUrl = asset('img/' . $this->image);
			}
		}
		return $imageUrl;
	}
}
