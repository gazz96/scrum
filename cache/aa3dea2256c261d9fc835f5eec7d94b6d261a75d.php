<?php $__env->startSection('head'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




<div x-data="{}">

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Projects</h1>
		<a href="#modal-form-project" data-toggle="modal" class="btn btn-sm btn-primary">Buat Baru</a>
		
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="card shadow">
				<div class="card-body">
					<table id="table-projects" class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Code</th>
								<th>Name</th>
								<th>Customer</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- Modal Projects -->
<form action="" id="form-project">
	<input type="hidden" name="customer_id" id="i-customer_id">
	<div class="modal fade" id="modal-form-project" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Project</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="i-code">Code</label>
						<input type="text" name="code" class="form-control" id="i-code">
					</div>


					<div class="form-group">
						<label for="i-name">Name</label>
						<input type="text" name="name" class="form-control" id="i-name">
					</div>

					<div class="form-group">
						<label for="i-customer_autocomplete">Customer</label>
						<input id="i-customer_autocomplete" class="form-control auto-complete">
					</div>

					<div class="row">
						<div class="form-group col-6">
							<label for="i-start_date">Start Date</label>
							<input type="date" name="start_date" class="form-control" id="i-start_date">
						</div>

						<div class="form-group col-6">
							<label for="i-end_date">End Date</label>
							<input type="date" name="end_date" class="form-control" id="i-end_date">
						</div>
					
					</div>

					<div class="form-group">
						<label for="i-status">Status</label>
						<select name="status" id="i-status" class="form-control">
							<option value="Active">Active</option>
							<option value="Dropped">Dropped</option>
							<option value="Completed">Completed</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>

<script>

$(function(){

	let isEdit = false;
	let tableProjects;
	let ProjectFields = {
		id: null,
		code: null,
		customer_id: null,
		name: null,
		start_date: null,
		end_date: null,
		status: null
	}

	let Project = {
		Models: {
			create: async ( data ) => {
                return $.ajax({
                    url: BASE_URL + 'api/projects/store',
                    method: "POST",
                    data: data
                });
            },
			edit: async ( id ) => {
                return $.ajax({
                    url: BASE_URL + 'api/projects/edit/' + id,
                });
            },
			update: async ( id, data ) => {
                return $.ajax({
                    url: `${BASE_URL}api/projects/update/${id}`,
                    method: 'POST',
                    data: data,
                })
            },
            delete: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/projects/delete/${id}`,
                    method: 'GET',
                })
            },
		},
		Views: {
			tableActions: (row) => {
                return `
                <div class="btn-group">
                    <a href="#" class="text-center" data-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-ellipsis-v"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit-action" data-id="${row[0]}" href="#">Edit</a>
                        <a class="dropdown-item delete-action" data-id="${row[0]}" href="#">Delete</a>
                    </div>
                </div>                
                `
            }
		},
		Helpers: {
            setForm: ( data ) => {
                for(let key in data) {
                    $('#i-' + key).val(data[key]);
					if(key == "customer_id") {
						$('#i-customer_autocomplete').val(`${data.customer_id} - ${data.customer.name} (${data.customer.email})`)
					}
                }
            },
            resetForm: () => {
                isEdit = false;
                $('#form-project')[0].reset();
                $('#modal-form-project').find('.btn-primary').html('Save');
            }
        },
	}

	

	let Init = () => {
		tableProjects  = $('#table-projects').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            columnDefs: [
            {
                targets: 0,
                width: '30'
            },
			{
				targets: 2,
				data: "name",
				render: (data, type, row, meta) => {
					return `
						<a href="${BASE_URL}projects/show/${row[0]}">${row[2]}</a>
					`
				}
			},
            {
                targets: 7,
                data: "action",
                render: (data, type, row, meta ) => {
                    return Project.Views.tableActions(row);
                },
                width: '10',
                orderable: false
            }],
            columns: [
                { name: 'id' },
                { name: 'name' },
                { name: 'customer_id' },
				{ name: 'start_date', sort: true },
				{ name: 'end_date', sort: true},
                { name: 'Action', sort: false}
            ],
            order: [
                [ 0, "DESC"]
            ],
            ajax:{
                url: BASE_URL + 'api/projects',
                data: (d) => {
                    d.page = (d.start > 0) ? (d.start/d.length)+1 : 1;
                },
                dataFilter: (data) => {
                    var json = jQuery.parseJSON( data );
					console.log(json.data);
                    json.recordsTotal = json.total;
                    json.recordsFiltered = json.total;
                    json.data = json.data.map(project => [
						project.id, project.code, project.name, (project.customer) ? project.customer.name : '', 
						project.start_date, project.end_date, project.status 
					]);
                    json.draw = json.draw;
                    return JSON.stringify( json )
                }
            }
        });
	}

	let customerAutoComplete = $('#i-customer_autocomplete');
	customerAutoComplete.on('keypress', async function(e){
		$('#i-customer_id').val('');
		let value = $(this).val();
		if(e.which == 13) {
			e.preventDefault();
			let customers = await $.ajax({
				url: `${BASE_URL}api/customers`,
				data: {
					search: {
						value: value
					}
				}
			})

			customerAutoComplete.after(`<div class="results-autocomplete mt-2"></div>`);
			customers.data.map( customer => $('.results-autocomplete').append(
				`<div class="results-item mb-1 border px-2 py-1"><a href="javascript:void(0)" data-id="${customer.id}">${customer.id} - ${customer.name} (${customer.email})</a></div>`
			))
		}
	})

	$(document).on('click', '.results-item a', function(e){
		e.preventDefault();
		$('#i-customer_id').val($(this).data('id'));
		$('#i-customer_autocomplete').val($(this).text());
		$('.results-autocomplete').remove();
	})

	$('#form-project').on('submit', async function(e){
		e.preventDefault();

		if( ! isEdit ) {
            let project = await Project.Models.create($(this).serialize());
            $(this)[0].reset();
            
        }else {
            let project = await Project.Models.update(ProjectFields.id, $(this).serialize());
        }

		Project.Helpers.resetForm();
		tableProjects.draw();

	});

	$(document).on('click', '.edit-action', async function(e){
        e.preventDefault();
        ProjectFields = await Project.Models.edit($(this).data('id'));
        Project.Helpers.setForm(ProjectFields);
        isEdit = true;
        $('#modal-form-project').modal('show');
        $('#modal-form-project').find('.btn-primary').html('Update');
    })

    $(document).on('click', '.delete-action', async function(e){
        e.preventDefault();
        ProjectFields = await Project.Models.delete($(this).data('id'));
        Project.Helpers.resetForm();
        tableProjects.draw();
    })

	$('#modal-form-customer').on('hide.bs.modal', function(){
        Project.Helpers.resetForm();
    });


	Init();

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/project/lists.blade.php ENDPATH**/ ?>