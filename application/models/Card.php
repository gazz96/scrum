<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Card extends Eloquent {

    protected $fillable = [
        "project_id",
        "title",
    ];

	public function items() {
		return $this->hasMany(CardItem::class, 'card_id', 'id');
	}



	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function projects() {
		return $this->belongsTo(Unit::class);
	}

	public function scopeOwner( $query ) {
		return $query->where('role_id', 4);
	}

	public function scopeFinished($query) {
		return $query->where('status', 'Completed');
	}
    

}
