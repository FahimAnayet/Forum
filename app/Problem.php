<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
	protected $fillable = [
		'title', 'body', 'open',
	];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function channel()
	{
		return $this->belongsTo('App\Channel');
	}
	public function solutions()
	{
		return $this->hasMany('App\Solution');
	}
	public function addSolution($request)
	{
		return $this->solutions()->create($request);
	}
}
