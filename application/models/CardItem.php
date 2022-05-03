<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CardItem extends Eloquent {

    protected $fillable = [
        "card_id",
        "name",
        "description",
        "status"
    ];

	public function card() {
		return $this->belongsTo(Card::class);
	}

}
