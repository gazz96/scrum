<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {


    protected $fillable = [
        "role_id",
        "name",
		"email",
		"userpass"
    ];

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function scopePic( $query ) {
		$query->where('role_id', 2);
	}
	
	public function scopeMaster( $query ) {
		$query->where('role_id', 3);
	}

	public function scopeCustomer( $query ) {
		$query->where('role_id', 4);
	}

	public function scopeDeveloper( $query ) {
		$query->where('role_id', 5);
	}
    

}
