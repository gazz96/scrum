@extends('layouts.app')

@section('header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .col-card {
        min-width: 300px;
        margin-right: 16px
    }
</style>
@endsection

@section('content')
    
	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">{{$project->name}}</h1>
		<a href="{{ base_url('projects') }}" class="btn btn-sm btn-secondary">Kembali</a>
        <input type="hidden" id="i-project_id" value="{{ $project->id }}">
	</div>

    <div class="row mb-3">
        <div class="col-md-12">
            <ul class="nav nav-tabs project-tabs">
                <li class="nav-item">
                  <a class="nav-link active"  data-toggle="tab" href="#project-main">Main</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#project-tasks">Tasks</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#project-team">Team</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="project-main">
            @include('modules.project.tab-main')
        </div>
        <div class="tab-pane fade" id="project-tasks">
            @include('modules.project.tab-tasks')
        </div>
        <div class="tab-pane fade" id="project-team">
            @include('modules.project.tab-team')
        </div>
    </div>
    
    

<!-- Modal Project -->
<div class="modal fade" id="card-item-detail" role="dialog" aria-labelledby="card-item-detail" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="text-right position-relative px-3 py-2 mb-3">
                <a href="javascript:void(0)" class="position-absolute right-0 top-0" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-sm fa-times"></span>
                </a>
            </div>
            <div class="row">
                <h5 class="modal-title col-12">
                    <input type="text" name="name" id="i-name" class="form-control border-0">
                </h5>
            </div>
            <div class="modal-body">
                <form id="card-item-modal-form">
                    <div class="card-item-modal-content">
                        <div class="form-group">
                            <label for="i-description">Description</label>
                            <textarea name="description" id="i-description"  rows="3" class="form-control"></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="i-assign_to">Assign To</label>
                                <input type="text" class="form-control member-search">
                                <div class="member-search-result"></div>
                                <div class="member-search-added"></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="i-status">Status</label>
                                <select name="status" id="i-status" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="To Do">To Do</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Done">Done</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>


                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        <a href="javascript:void()" class="btn btn-sm btn-danger" id="delete-card-item">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form action="">
    <!-- Modal Invoice -->
    <div class="modal fade" id="modal-form-invoice" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="i-customer_id">Customer</label>
                            <select name="customer_id" id="i-customer_id" class="form-control w-100" style="width: 100%">
                            
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="i-issue_date">Issue Date</label>
                            <input type="date" name="issue_date" id="i-issue_date" class="form-control">
                        </div>


                        <div class="form-group col-md-4">
                            <label for="i-due_date">Issue Date</label>
                            <input type="date" name="due_date" id="i-due_date" class="form-control">
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</form>

@endsection


@section('footer')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ base_url('assets/main/js/project.js') }}"></script>

<script>


$(function(){

 
    let customerInput = $('#i-customer_id').select2({
        dropdownCssClass: "custom-dropdown"
    }).on("select2:open", function (e) {
        var self = $(this);
        self.on('keyup', function(){
        })
    });
    
    $(document).on('keyup', '.custom-dropdown .select2-search__field', function (e) {
        var self = $(this);
        
        
    });
});


</script>

@endsection