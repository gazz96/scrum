<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Attendance extends Eloquent {

    protected $fillable = [
		"user_id",
        "start_work",
        "end_work",
		"start_rest",
		"end_rest",
		"note",
        "location"
    ];

    public function user() {
		return $this->belongsTo(User::class, 'user_id');
	}

}
