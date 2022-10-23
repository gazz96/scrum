
@extends('layouts.app')


@section('head')


@endsection

@section('content')


<!-- Page Heading -->
<div class="d-flex align-items-center mb-4">
	<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Customers</h1>
	<a href="#modal-form-customer" data-toggle="modal" class="btn btn-sm btn-primary">Buat Baru</a>
</div>


<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
                <table id="table-customer" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
		</div>
	</div>
</div>

<!-- Modal -->
<form action="" id="form-customer">
    <input type="hidden" name="id" value="" id="i-id">
    <div class="modal fade" id="modal-form-customer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="i-name">Name</label>
                        <input type="text" name="name" class="form-control" id="i-name">
                    </div>

                    <div class="form-group">
                        <label for="i-email">Email</label>
                        <input type="email" name="email" class="form-control" id="i-email">
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

@endsection


@section('footer')

<script>

$(function(){
    let tableCustomer;
    let isEdit = false;
    let customerFields = {
        id: null,
        name: null,
        email: null
    };

    const Customer = {
        Models: {
            show: async ( id ) => {
                return $.ajax({
                    url: BASE_URL + 'api/customers/edit/' + id,
                });
            },
            list: async ( data ) => {
                return $.ajax({
                    url: BASE_URL + 'api/customers',
                    method: "POST",
                    data: data
                });
            },
            create: async ( data ) => {
                return $.ajax({
                    url: BASE_URL + 'api/customers/store',
                    method: "POST",
                    data: data
                });
            },
            update: async ( id, data ) => {
                return $.ajax({
                    url: `${BASE_URL}api/customers/update/${id}`,
                    method: 'POST',
                    data: data,
                })
            },
            delete: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/customers/delete/${id}`,
                    method: 'GET',
                })
            },
        },
        Helpers: {
            setForm: ( data ) => {
                for(let key in data) {
                    $('#i-' + key).val(data[key]);
                }
            },
            resetForm: () => {
                isEdit = false;
                $('#form-customer')[0].reset();
                $('#modal-form-customer').find('.btn-primary').html('Save');
            }
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
        }
        
    }

    async function Init() {

        tableCustomer  = $('#table-customer').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            columnDefs: [
            {
                targets: 0,
                width: '30'
            },
            {
                targets: 3,
                data: "action",
                render: (data, type, row, meta ) => {
                    return Customer.Views.tableActions(row);
                },
                width: '10',
                orderable: false
            }],
            columns: [
                { name: 'id' },
                { name: 'name' },
                { name: 'email' },
                { name: 'Action', sort: false}
            ],
            order: [
                [ 0, "DESC"]
            ],
            ajax:{
                url: BASE_URL + 'api/customers',
                data: (d) => {
                    d.page = (d.start > 0) ? (d.start/d.length)+1 : 1;
                },
                dataFilter: (data) => {
                    var json = jQuery.parseJSON( data );
                    json.recordsTotal = json.total;
                    json.recordsFiltered = json.total;
                    json.data = json.data.map(customer => [ customer.id, customer.name, customer.email ]);
                    json.draw = json.draw;
                    return JSON.stringify( json )
                }
            }
        });

    }

    

    
    Init();

    $('#form-customer').submit( async function(e){
        e.preventDefault();

        if( ! isEdit ) {
            let customer = await Customer.Models.create($(this).serialize());
            $(this)[0].reset();
            
        }else {
            let customer = await Customer.Models.update(customerFields.id, $(this).serialize());
        }

        tableCustomer.draw();
    });

    $(document).on('click', '.edit-action', async function(e){
        e.preventDefault();
        customerFields = await Customer.Models.show($(this).data('id'));
        Customer.Helpers.setForm(customerFields);
        isEdit = true;
        $('#modal-form-customer').modal('show');
        $('#modal-form-customer').find('.btn-primary').html('Update');
    })


    $('#modal-form-customer').on('hide.bs.modal', function(){
        Customer.Helpers.resetForm();
    });

    $(document).on('click', '.edit-action', async function(e){
        e.preventDefault();
        customerFields = await Customer.Models.show($(this).data('id'));
        Customer.Helpers.setForm(customerFields);
        isEdit = true;
        $('#modal-form-customer').modal('show');
        $('#modal-form-customer').find('.btn-primary').html('Update');
    })

    $(document).on('click', '.delete-action', async function(e){
        e.preventDefault();
        customerFields = await Customer.Models.delete($(this).data('id'));
        Customer.Helpers.resetForm();
        tableCustomer.draw();
    })

});


</script>

@endsection