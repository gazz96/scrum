<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Project extends Eloquent {

    protected $fillable = [
        "name",
        "unit_id",
		"pic_id",
		"master_id",
		"owner_id",
		"status",
		"start_date",
		"end_date"
    ];

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function unit() {
		return $this->belongsTo(Unit::class);
	}

	public function scopeOwner( $query ) {
		return $query->where('role_id', 4);
	}
    

}
