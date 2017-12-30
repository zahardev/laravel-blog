<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $dates = ['published_at'];

	public function author() {
		return $this->belongsTo(User::class);
	}


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

	public function getDateAttribute() {
		return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
	}

	public function scopeLatestFirst($query) {
		return $query->orderBy('created_at', 'desc');
	}

	public function scopePublished($query) {
		return $query->where('published_at', '<=', Carbon::now());
	}

	public function getBodyHtmlAttribute() {
		return $this->body ? Markdown::convertToHtml(e($this->body)) : null;
	}

	public function getExcerptHtmlAttribute() {
		return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : null;
	}
}
