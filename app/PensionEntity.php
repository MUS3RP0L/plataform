<?php

namespace Muserpol;

use Illuminate\Database\Eloquent\Model;

class PensionEntity extends Model
{
    protected $table = 'pension_entities';

	protected $fillable = [

		'code',
		'name'

	];

	protected $guarded = ['id'];

	public function affiliates()
    {
    	return $this->hasMany('Muserpol\Affiliate');
    }
}
