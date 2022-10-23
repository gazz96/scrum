

$(function(){

    let tableInvoice;
    let isEdit = false;

    let customerIdSelect;

    window.Invoice =  {
        Fields: {
            id: null,
            project_id: null,
            customer_id: null,
            issue_date: null,
            due_date: null,
            status: null,
        },
        Models: {
            list: async(data = {}) => {
                return $.ajax({
                    url: `${BASE_URL}api/invoices/`,
                    data: data,
                })
            },
            create: async( data ) => {
                return await $.ajax({
                    url: `${BASE_URL}api/invoices/store`,
                    method: 'POST',
                    data: data
                })
            },
    
            edit: async ( id ) => {
                return $.ajax({
                    url: BASE_URL + 'api/invoices/show/' + id,
                });
            },
            update: async ( id, data ) => {
                return $.ajax({
                    url: `${BASE_URL}api/invoices/update/${id}`,
                    method: 'POST',
                    data: data,
                })
            },
            delete: async( id ) => {
                return $.ajax({
                    url: `${BASE_URL}api/invoices/delete/${id}`,
                    method: 'GET',
                })
            },
            getTotalByProject: async(project_id) => {
                return $.ajax({
                    url: `${BASE_URL}api/invoices/total/${project_id}`,
                    method: 'GET',
                })
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
                        <a class="dropdown-item" href="${BASE_URL}api/invoice/payment-link/${row[0]}" target="_blank">Payment Link</a>
                    </div>
                </div>                
                `
            }
        },
        Helpers: {
            init: async () => {
    
                Invoice.Fields.project_id = $('#i-project_id').val();
    
    
                tableInvoice = $('#table-invoice').DataTable({
                    processing: true,
                    serverSide: true,
                    iDisplayLength: 20,
                    columnDefs: [
                    {
                        targets: 0,
                        width: '30'
                    },
                    
                    {
                        targets: 6,
                        data: "action",
                        render: (data, type, row, meta ) => {
                            return Invoice.Views.tableActions(row);
                        },
                        width: '10',
                        orderable: false
                    }],
                    columns: [
                        { name: 'id', title: 'ID' },
                        { name: 'customer_id', title: 'Customer' },
                        { name: 'issue_date', title: 'Issue Date', sort: true },
                        { name: 'due_date', title: 'Due Date', sort: true },
                        { name: 'status', title: 'Status', sort: true},
                        { name: 'total_amount', title: 'Total', sort: true},
                        null
                    ],
                    order: [
                        [ 0, "DESC"]
                    ],
                    ajax:{
                        url: BASE_URL + 'api/invoices',
                        data: (d) => {
                            d.page = (d.start > 0) ? (d.start/d.length)+1 : 1;
                            d.project_id = Invoice.Fields.project_id;
                        },
                        dataFilter: (data) => {
                            var json = jQuery.parseJSON( data );
                            json.recordsTotal = json.total;
                            json.recordsFiltered = json.total;
                            console.log(json.data);
                            json.data = json.data.map(invoice => [ 
                                invoice.id, ((invoice.customer) ? invoice.customer.name : '-'), invoice.issue_date, 
                                invoice.due_date, invoice.status, Rp(invoice.total_amount)
                            ]);
                            json.draw = json.draw;
                            return JSON.stringify( json )
                        }
                    }
                });

                
                
                customerIdSelect = $('.maintab-customer_id').select2({

                    width: '100%',
                    ajax: {
                        url: BASE_URL + '/api/customers',
                        processResults: function (data) {
                            console.log(data);
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            let customers = data.data;
                            let results = [];

                            customers.map(customer => {
                                results.push({
                                    id: customer.id,
                                    text: customer.name + ' ' + customer.email
                                })
                            })

                            return {
                                results: results
                            };
                        },
                        data: function (params) {
                            var query = {
                            // search: params.term,
                            // page: params.page || 1
                            }
                    
                            // Query parameters will be ?search=[term]&page=[page]
                            return query;
                        }
                    }
                })
            },
            setForm: ( data ) => {
                for(let key in data) {
                    $('#i-' + key).val(data[key]);
                }
            },
            resetForm: () => {
                isEdit = false;
                $('#form-invoice')[0].reset();
                $('#modal-form-invoice').find('.btn-primary').html('Save');
            },
            customerSelection: ( element ) => {
                return $(element).select2({

                    width: '100%',
                    ajax: {
                        url: BASE_URL + '/api/customers',
                        processResults: function (data) {
                            let customers = data.data;
                            let results = [];

                            customers.map(customer => {
                                results.push({
                                    id: customer.id,
                                    text: customer.name + ' ' + customer.email
                                })
                            })

                            return {
                                results: results
                            };
                        },
                        data: function (params) {
                            var query = {
                            // search: params.term,
                            // page: params.page || 1
                            }
                    
                            // Query parameters will be ?search=[term]&page=[page]
                            return query;
                        }
                    }
                })
            },
            customerPreselection: (id, text) => {
                // add options
                var option = new Option( text, id, true, true);
                let customerIdSelect = Invoice.Helpers.customerSelection().append(option).trigger('change');
            
                // manually trigger the `select2:select` event
                customerIdSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: {}
                    }
                });
            }
        }
    }


    
    $('#form-invoice .modal-footer .btn-primary').on('click', async function(e){
        e.preventDefault();
        let form = $('#form-invoice');
        
        let data = {
            project_id: Invoice.Fields.project_id,
            customer_id: form.find('#i-customer_id').val(),
            issue_date: form.find('#i-issue_date').val(),
            due_date: form.find('#i-due_date').val(),
            status: form.find('#i-status').val(),
            total_amount: form.find('#i-total_amount').val(),
        };

        if( ! isEdit ) {
            
            let invoice = await Invoice.Models.create(data);
            form[0].reset();
        }else {
            let invoice = await Invoice.Models.update(Invoice.Fields.id, data);
        }
    
        tableInvoice.draw();
    })

    $(document).on('click', '.edit-action', async function(e){
        e.preventDefault();
        Invoice.Fields = await Invoice.Models.edit($(this).data('id'));
        Invoice.Helpers.setForm(Invoice.Fields);
        isEdit = true;

        

        $('#modal-form-invoice').modal('show');
        $('#modal-form-invoice').find('.btn-primary').html('Update');
        
    })

    $(document).on('click', '.delete-action', async function(e){
        e.preventDefault();
        Invoice.Fields = await Invoice.Models.delete($(this).data('id'));
        Invoice.Helpers.resetForm();
        tableInvoice.draw();
    })

	$('#modal-form-invoice').on('hide.bs.modal', function(){
        Invoice.Helpers.resetForm();
    });


    Invoice.Helpers.init();

    

})