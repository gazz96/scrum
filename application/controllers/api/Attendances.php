<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Attendance;
use Illuminate\Support\Collection;
use App\Models\CardItem;
use App\Models\Card;


class Attendances extends MY_Controller {

    public function index() {
        
        $attendances = Attendance::with('customer');
        $columns = $this->input->get('columns');

		$attendances = $attendances->when( $this->input->get('order'), function($query, $value) use( $columns ){
			return $query->orderBy($columns[$value[0]['column']]['name'], $value[0]['dir']);
		}, function( $query ){
            return $query->orderBy('id', 'DESC');
        });

		$attendances = $attendances->when($this->input->get('search')['value'] ?? '', function($query, $search){
			return $query->where(function($query) use ($search){
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas ('customer', function($query) use($search){
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
		});

        $attendances = $attendances->when($this->input->get('status'), function($query, $status){
            return $query->where('status', $status);
        });

		$attendances = $attendances->paginate($this->input->get('length', 20), ['*'], 'page', $this->input->get('page'));
        $attendancesCollections = new Collection($attendances);
        $attendancesCollections->draw = $this->input->get('draw');

        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($attendancesCollections);
        $this->output->_display();
        exit;
    }

    public function store() {
        $attendance 		= Attendance::create($this->input->post([
            'code',
            'name', 
            'customer_id',
            'start_date',
            'end_date',
            'status'
        ]));
            
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($attendance);
        $this->output->_display();
        exit;
    }

    public function update( $id ) {
        $attendance = Attendance::findOrFail($id);
        $update = $attendance->update($this->input->post([
            'name', 
            'customer_id',
            'start_date',
            'end_date',
            'status'
        ]));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($attendance);
        $this->output->_display();
        exit;
    }

    public function delete( $id ) {
        $attendance = Attendance::findOrFail($id);
        $delete = $attendance->delete();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($attendance);
        $this->output->_display();
        exit;
    }

    public function show( $id ) {
        $attendance = Attendance::findOrFail($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($attendance);
        $this->output->_display();
        exit;
    }

    public function edit( $id ) {
        $attendance = Attendance::with('customer')->findOrFail($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($attendance);
        $this->output->_display();
        exit;
    }

    public function total_tasks($attendance_id) {

        $attendance = new Collection(Card::where('attendance_id', $attendance_id)->get());
        $card_ids = $attendance->pluck('id');

        $total_task      = CardItem::whereIn('card_id', $card_ids)->count('id');
        $completed_task  = CardItem::whereIn('card_id', $card_ids)->where('status', 'Completed')->count('id');
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output(json_encode([
            'total' => $total_task,
            'completed' => $completed_task,
        ]));
        $this->output->_display();
        exit;
    }

}