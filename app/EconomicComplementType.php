<?php

namespace Muserpol;

use Illuminate\Database\Eloquent\Model;

class EconomicComplementType extends Model
{
    protected $table = 'economic_complement_types';

	protected $fillable = [

		'name'

	];

	protected $guarded = ['id'];

	public function economic_complement_modalities()
    {
        return $this->hasMany('Muserpol\EconomicComplementModalities');
    }
}
