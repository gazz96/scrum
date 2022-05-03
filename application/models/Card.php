<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Card extends Eloquent {

    protected $fillable = [
        "project_id",
        "title",
    ];

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function projects() {
		return $this->belongsTo(Unit::class);
	}

	public function scopeOwner( $query ) {
		return $query->where('role_id', 4);
	}
    

}
