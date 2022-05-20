


<?php $__env->startSection('head'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




<div x-data="{}">

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Attendances</h1>
		<a href="#modal-form-invoice" class="btn btn-sm btn-primary"  data-toggle="modal">Buat Baru</a>
	</div>
	
	<div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="table-invoice"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Invoices -->
<form action="" id="form-invoice">
    <input type="hidden" name="id" id="i-id">
    <input type="hidden" name="customer_id" id="i-customer_id">
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
                    <div class="form-group position-relative">
                        <label for="i-customer_autocomplete">Customer</label>
                        <input id="i-customer_autocomplete" class="form-control auto-complete" autocomplete="false">
                    </div>

                    <div class="form-group position-relative">
                        <label for="i-total_amount">Total Amount</label>
                        <input id="i-total_amount" class="form-control" id="i-total_amount">
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="i-issue_date">Issue Date</label>
                            <input type="date" name="issue_date" id="i-issue_date" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="i-due_date">Due Date</label>
                            <input type="date" name="due_date" id="i-due_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="i-status">Status</label>
                            <select name="status" id="i-status" class="form-control">
                                <option value="Paid">Paid</option>
                                <option value="Not Paid">Not Paid</option>
                            </select>
                        </div>

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

<script src="<?php echo e(base_url('assets/main/js/invoice.js')); ?>"></script>
<script>

$(function(){
    let isSearching = false;
    let customerAutoComplete = $('#i-customer_autocomplete');
	customerAutoComplete.on('keyup', async function(e){
        e.preventDefault();
        $('#i-customer_id').val('');
        $('.results-autocomplete').remove();

        if($(this).val().length <= 3) return;

        
		

		let value = $(this).val();
        let customers = await $.ajax({
            url: `${BASE_URL}api/customers`,
            data: {
                search: {
                    value: value
                },
                length: 10
            }
        })

        $('.results-autocomplete').remove();
        customerAutoComplete.after(`<div class="results-autocomplete mt-2" style="position: absolute; top: 100%; background-color: #fff; z-index: 5;"></div>`);

        if( customers.data.length ) {
            customers.data.map( customer => $('.results-autocomplete').append(
                `<div class="results-item mb-1 border px-2 py-1"><a href="javascript:void(0)" data-id="${customer.id}">${customer.id} - ${customer.name} (${customer.email})</a></div>`
            ))
        } else {
            $('.results-autocomplete').append(
                `<div class="results-item mb-1 border px-2 py-1"><a href="javascript:void(0)" data-id="">No results</a></div>`
            )
        }

        isLoading = false;
	})

	$(document).on('click', '.results-item a', function(e){
		e.preventDefault();
        if( !$(this).data('id') ) return;
		$('#i-customer_id').val($(this).data('id'));
		$('#i-customer_autocomplete').val($(this).text());
		$('.results-autocomplete').remove();
	})

    let tableInvoiceItems = $('#table-invoice-items')
    let invoiceTemplateRow = ( no, name = "", description = "", qty = 0, price = 0, amount = 0 ) => {
        return `
            <tr>
                <td class="row-no">${no}</td>
                <td>
                    <input type="text" name="name[]" class="form-control form-control-sm mb-1 input-name" value="${name}" placeholder="Name">
                    <textarea name="description[]" rows="5" class="form-control form-control-sm input-description" placeholder="Description">${description}</textarea>
                </td>
                <td><input type="number" name="qty[]" min="0" class="form-control form-control-sm input-qty" placeholder="Qty" value="${qty}"></td>
                <td><input type="number" name="price[]" min="0" class="form-control form-control-sm input-price" placeholder="Price" value="${price}"></td>
                <td><span class="row-amount">${amount}</span></td>
                <td><a href="#" class="remove-invoice-item text-danger"><i class="fas fa-times"></i></a></td>
            </tr>
        `
    }

    $(document).on('click', '#invoice-add-item', function(e){
        e.preventDefault();
        tableInvoiceItems.find('tbody').append(
            invoiceTemplateRow(tableInvoiceItems.find('tbody').find('tr').length+1)
        );
    })

    $(document).on('change', '#table-invoice-items .input-qty, #table-invoice-items .input-price', function(){
        calcRow($(this));
    })

    let calcRow = ( element ) => {
        let tr = $(element).parent().parent();
        let qty = parseFloat(tr.find('.input-qty').val());
        let price = parseFloat(tr.find('.input-price').val());
        tr.find('.row-amount').html(qty * price);
    }
})

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/attendancce/lists.blade.php ENDPATH**/ ?>