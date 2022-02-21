@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Edit Unit</h1>
		<a href="{{ base_url('units') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	<form method="POST" action="{{ base_url('units/update/' . $unit->id) }}">
		<input type="hidden" name="true_submit" value="update">
		<div class="row">
			<div class="col-12 col-md-4">


				<div class="card">
					<div class="card-body">

						@if( session()->flashdata('message') )
						<div class="alert alert-success" role="alert">
							<strong>{{ session()->flashdata('message') }}</strong>
						</div>
						@endif
						<div class="form-group">
							<label for="i-name">Nama Unit</label>
							<input type="text" name="name" class="form-control" id="i-name" value="{{ $unit->name }}">
							@if(errors('name'))
							<div class="invalid-feedback d-block">{{ errors('name') }}</div>
							@endif
						</div>
						<button class="btn btn-primary">Perbaharui</button>
					</div>
				</div>
			</div>

		</div>
	</form>

@endsection
