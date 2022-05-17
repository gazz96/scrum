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
        "total_amount",
        "status"
    ];


    public function customer() {
        return $this->belongsTo(User::class);
    }

	public function project() {
		return $this->belongsTo(Project::class);
	}

    

}
