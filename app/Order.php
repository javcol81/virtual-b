<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'address', 'instructions', 'direccion', 'filtro', 'telefono', 'status_id'];

	// Get the customer that placed the order
	public function customer() {
		return $this->belongsTo('App\User', 'user_id');
	}

	// Get the status of the order
	public function status() {
		return $this->belongsTo('App\Status');
	}
}
