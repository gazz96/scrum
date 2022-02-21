@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Buat Unit</h1>
		<a href="{{ base_url('units') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	
	<form method="POST" action="{{ base_url('units/store') }}">
		<input type="hidden" name="true_submit" class="create">
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="card shadow">
					<div class="card-body">
						<div class="form-group">
							<label for="i-name">Nama Unit</label>
							<input type="text" name="name" class="form-control" id="i-name">
						</div>
						<button class="btn btn-primary">Buat baru</button>
					</div>
				</div>
			</div>

		</div>
	</form>

@endsection
