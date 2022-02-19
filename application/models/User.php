<?php 

class User extends MY_Model {

    protected $table = "users";
    protected $primary_key = "id";

    protected $fillable = [
        "role_id",
        "name"
    ];

    public function create($data)  {
        $data = elements( $this->fillable, $data);
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, [
            $this->primary_key => $id
        ], 1);
    }
    

}