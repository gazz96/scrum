@extends('layouts.app')


@section('head')


@endsection

@section('content')


<!-- Page Heading -->
<div class="d-flex align-items-center mb-4">
	<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Users</h1>
	<a href="{{ base_url('users/create') }}" class="btn btn-sm btn-primary">Buat Baru</a>
	<a href="javascript:void(0)" class="btn btn-sm btn-primary mx-2" data-toggle="collapse" data-target="#collapse-filter">Filter</a>
</div>

<div class="collapse mb-4" id="collapse-filter">
	<div class="card card-body shadow">
		<form>

			<div class="row">

				<div class="col-md-2">
					<select name="filter_by" class="form-control mb-3">
						<option value="name">Nama</option>
						<option value="email">Email</option>
					</select>
				</div>
				<div class="col-md-3">
					<input name="keyword" type="text" class="form-control mb-3" placeholder="Masukan kata kunci" value="{{ request('keyword') }}">
				</div>
			</div>
			<button class="btn btn-primary">Terapkan</button>
		</form>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">{!! $table !!}</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Body
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>

@endsection
