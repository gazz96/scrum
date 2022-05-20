<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Project extends Eloquent {

    protected $fillable = [
		"code",
        "name",
        "customer_id",
		"start_date",
		"end_date",
		"status"
    ];

	protected $appends = [
		'deadline'
	];

	public function customer() {
		return $this->belongsTo(User::class, 'customer_id');
	}

	public function cards() {
		return $this->hasMany(Card::class);
	}

	public function getDeadlineAttribute() {
		return (strtotime($this->end_date) - strtotime(date('Y-m-d')))/60/60/24;
	}

}
