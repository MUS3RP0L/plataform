<?php

namespace Muserpol;

use Illuminate\Database\Eloquent\Model;

class EconomicComplementModality extends Model
{
    protected $table = 'economic_complement_modalities';

	protected $fillable = [

		'name',
		'description',
		'shortened'
	];

	protected $guarded = ['id'];

	public function economic_complements(){

        return $this->hasMany('Muserpol\EconomicComplement');
    }
}
