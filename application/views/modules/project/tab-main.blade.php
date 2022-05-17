<div class="row mb-3">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Deadline</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="project-deadline">0 hari</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Invoice</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="project-total-invoices">0/0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="project-progress">0%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%" id="project-progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <a href="#modal-form-invoice" class="btn btn-sm btn-outline-primary mb-3"  data-toggle="modal">Tambah Invoice</a>
                <h6 class="font-weight-bold">Invoices</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="table-invoice">
                        {{-- <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <input id="i-customer_autocomplete" class="form-control auto-complete">
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

                    {{-- <div class="invoice-items">
                        <table class="table table-sm table-bordered" id="table-invoice-items">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Name</td>
                                    <th width="10%">Qty</th>
                                    <th width="15%">Price</th>
                                    <th width="10%">Amount</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td colspan="3"><a href="" id="invoice-add-item">Add Item</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> --}}


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</form>