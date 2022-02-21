@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Edit User</h1>
		<a href="{{ base_url('users') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	<form method="POST" action="{{ base_url('users/update/' . $user->id) }}">
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

						<h3 class="card-title font-weight-bold text-dark">Users</h3>

						<div class="form-group">
							<label for="i-name">Nama Lengkap</label>
							<input type="text" name="name" class="form-control" id="i-name" value="{{ $user->name }}">
							@if(errors('name'))
							<div class="invalid-feedback d-block">{{ errors('name') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-email">Email</label>
							<input type="email" name="email" class="form-control" id="i-email" value="{{ $user->email }}">
						</div>

						<div class="form-group">
							<label for="i-password">Password</label>
							<input type="password" name="password" class="form-control" id="i-password">
						</div>

						<div class="form-group">
							<label for="i-role_id">Role</label>
							<select name="role_id" id="role_id" class="form-control" id="i-role_id">
								<option value="">Pilih</option>
								@foreach($roles as $role)
								<option value="{{ $role->id }}" {{ selected($role->id, $user->role_id) }}>{{ $role->name }}</option>
								@endforeach
							</select>
						</div>


						<button class="btn btn-primary">Perbaharui</button>
					</div>
				</div>
			</div>

		</div>
	</form>

@endsection
