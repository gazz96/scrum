<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Invoice extends Eloquent {

    protected $fillable = [
        "project_id",
        "order_code",
        "issue_date",
        "due_date",
        "payment_date",
        "payment_note",
        "customer_id",
        "receive_amount",
        "status"
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
