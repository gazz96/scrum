<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Backlog extends Eloquent {

    protected $fillable = [
		"project_id",
        "module_name",
		"plan",
        "developer_id",
		"period_start",
		"period_end",
		"actual_period_start",
		"actual_period_end",
		"status"
    ];

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function unit() {
		return $this->belongsTo(Unit::class);
	}

    

}
