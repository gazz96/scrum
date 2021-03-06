<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\User;
use App\Models\Role;

use App\Requests\UserRequest;

class Users extends MY_Controller 
{

	public function __construct() {
		parent::__construct();
	}
	
	private function sort_field( $id, $label, $sort = false) 
	{
		if( $sort ) {
			$order = "ASC";
			if( request('order') == "ASC") {
				$order = "DESC";
			}else {
				$order = "ASC";
			}
			return "<a href='?sort_by={$id}&sort={$order}'>{$label}</a>";
		}
		return $label;
	}

	

    public function index() 
	{
	
		$this->table->set_template([
			"table_open" => "<table class='table table-bordered' id='table'>"
		]);

		
		$this->table->set_heading([
			$this->sort_field('id', 'ID', true),
			$this->sort_field('name', 'Name', true), 
			$this->sort_field('email', 'Email', true),
			'Role', 
			'Action',
		]);

		$users = User::with('role');
		$users->orderBy('id', 'DESC');
		$users = $users->when(request('sort'), function($query, $value){
			return $query->orderBy(request('sort_by'), $value);
		});

		$users = $users->when(request('keyword'), function($query, $value){
			return $query->where(request('filter_by'), 'like', '%' . $value . '%');
		});

		$users = $users->paginate(20);

		foreach($users as $user) 
		{
			$this->table->add_row([
				$user->id,
				$user->name,
				$user->email,
				$user->role->name, 
				"
					<a href='" . base_url('users/edit/' . $user->id) . "' class='btn btn-warning'>
						<span class='fas fa-edit'></span>
					</a>
					<a href='" . base_url('users/delete/' . $user->id ) . "' class='btn btn-danger'>
						<span class='fas fa-trash'></span>
					</a>
				"
			]);
		}

		$this->view('modules.user.lists', [
			'roles' => Role::all(),
			'table' => $this->table->generate()
		]);

    }

    public function create() 
	{
		$this->view('modules.user.create', [
			'roles' => Role::all()
		]);
    }

    public function store() 
	{
		$request 	= new UserRequest;
		$data 		= $request->validated();	
		$user 		= User::create( $data );
		$this->session->set_flashdata('message', 'Berhasil menyimpan');
		redirect(base_url('/users'));
    }

    public function edit( $id ) 
	{
		$user = User::findOrFail( $id );
		$this->view('modules.user.edit', [
			'user' => $user,
			'roles' => Role::all()
		]);
    }

    public function update( $id ) 
	{
		$request 	= new UserRequest;
		$data 		= $request->validated();	
		
		if( ! $data['password'] ) unset($data['password']);

		$user 		= User::findOrFail( $id );
		$user->update( $data );
		
		$this->session->set_flashdata('message', 'Berhasil memperbaharui');
		redirect(base_url('/users/edit/' . $id ));
    }

    public function delete( $id ) 
	{
        $user = User::findOrFail( $id );
		$user->delete();
		back();
    }

}
