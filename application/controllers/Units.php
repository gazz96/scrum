<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Unit;

use App\Requests\UnitRequest;

class Units extends MY_Controller 
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
			'Action',
		]);

		$units = new Unit;
		$units->orderBy('id', 'DESC');
		$units = $units->when(request('sort'), function($query, $value){
			return $query->orderBy(request('sort_by'), $value);
		});

		$units = $units->when(request('keyword'), function($query, $value){
			return $query->where(request('filter_by'), 'like', '%' . $value . '%');
		});

		$units = $units->paginate(20);

		foreach($units as $unit) 
		{
			$this->table->add_row([
				$unit->id,
				$unit->name,
				"
					<a href='" . base_url('units/edit/' . $unit->id) . "' class='btn btn-warning'>
						<span class='fas fa-edit'></span>
					</a>
					<a href='" . base_url('units/delete/' . $unit->id ) . "' class='btn btn-danger'>
						<span class='fas fa-trash'></span>
					</a>
				"
			]);
		}

		$this->view('modules.unit.lists', [
			'table' => $this->table->generate()
		]);

    }

    public function create() 
	{
		$this->view('modules.unit.create');
    }

    public function store() 
	{
		$request 	= new UnitRequest;
		$data 		= $request->validated();	
		$user 		= Unit::create( $data );
		$this->session->set_flashdata('message', 'Berhasil menyimpan');
		redirect(base_url('/units'));
    }

    public function edit( $id ) 
	{
		$unit = Unit::findOrFail( $id );
		$this->view('modules.unit.edit', [
			'unit' => $unit,
		]);
    }

    public function update( $id ) {
		$request 	= new UnitRequest;
		$data 		= $request->validated();	
		
		if( ! $data['password'] ) unset($data['password']);

		$Unit 		= Unit::findOrFail( $id );
		$Unit->update( $data );
		
		$this->session->set_flashdata('message', 'Berhasil memperbaharui');
		redirect(base_url('/units/edit/' . $id ));
    }

    public function delete( $id ) {
        $unit = Unit::findOrFail( $id );
		$unit->delete();
		$this->session->set_flashdata('message', 'Berhasil menghapus');
		back();
    }

}
