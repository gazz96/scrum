<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Unit extends Eloquent {

    protected $fillable = [
        "name",
    ];

	public function projects() {
		return $this->hasMany(Project::class);
	}
    

}
