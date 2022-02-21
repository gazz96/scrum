@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Buat User</h1>
		<a href="{{ base_url('users') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	
	<form method="POST" action="{{ base_url('users/store') }}">
		<input type="hidden" name="true_submit" class="create">
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="card shadow">
					<div class="card-body">
						<h3 class="card-title font-weight-bold text-dark">Users</h3>
						<div class="form-group">
							<label for="i-name">Nama Lengkap</label>
							<input type="text" name="name" class="form-control" id="i-name">
						</div>

						<div class="form-group">
							<label for="i-email">Email</label>
							<input type="email" name="email" class="form-control" id="i-email">
						</div>

						<div class="form-group">
							<label for="i-userpass">Password</label>
							<input type="password" name="userpass" class="form-control" id="i-userpass">
						</div>

						<div class="form-group">
							<label for="i-role_id">Role</label>
							<select name="role_id" id="role_id" class="form-control" id="i-role_id">
								<option value="">Pilih</option>
								@foreach($roles as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>


						<button class="btn btn-primary">Buat baru</button>
					</div>
				</div>
			</div>

		</div>
	</form>

@endsection
