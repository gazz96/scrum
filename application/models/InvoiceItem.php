<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class InvoiceItem extends Eloquent {

    protected $fillable = [
        "name",
        "description",
        "issue_date",
        "qty",
        "price",
    ];

	public function invoice() {
		return $this->belongsTo(Invoice::class);
	}    

}
