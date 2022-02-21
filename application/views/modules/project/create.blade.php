@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Buat Project</h1>
		<a href="{{ base_url('projects') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	
	<form method="POST" action="{{ base_url('projects/store') }}">
		<input type="hidden" name="true_submit" class="create">
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="card shadow">
					<div class="card-body">
				
						<div class="form-group">
							<label for="i-name">Nama Project</label>
							<input type="text" name="name" class="form-control" id="i-name" value="">
							@if(errors('name'))
							<div class="invalid-feedback d-block">{{ errors('name') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-unit_id">Unit</label>
							<select name="unit_id" id="unit_id" class="form-control" id="i-unit_id">
								<option value="">Pilih</option>
								@foreach($units as $unit)
								<option value="{{ $unit->id }}">{{ $unit->name }}</option>
								@endforeach
							</select>
							@if(errors('unit_id'))
							<div class="invalid-feedback d-block">{{ errors('unit_id') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-pic_id">PIC</label>
							<select name="pic_id" id="pic_id" class="form-control" id="i-pic_id">
								<option value="">Pilih</option>
								@foreach($pics as $pic)
								<option value="{{ $pic->id }}">{{ $pic->name }}</option>
								@endforeach
							</select>
							@if(errors('pic_id'))
							<div class="invalid-feedback d-block">{{ errors('pic_id') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-master_id">Scrum Master</label>
							<select name="master_id" id="master_id" class="form-control" id="i-master_id">
								<option value="">Pilih</option>
								@foreach($masters as $master)
								<option value="{{ $master->id }}">{{ $master->name }}</option>
								@endforeach
							</select>
							@if(errors('master_id'))
							<div class="invalid-feedback d-block">{{ errors('master_id') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-owner_id">Owner</label>
							<select name="owner_id" id="owner_id" class="form-control" id="i-owner_id">
								<option value="">Pilih</option>
								@foreach($owners as $owner)
								<option value="{{ $owner->id }}">{{ $owner->name }}</option>
								@endforeach
							</select>
							@if(errors('owner_id'))
							<div class="invalid-feedback d-block">{{ errors('owner_id') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-status">Status</label>
							<select name="status" id="status" class="form-control" id="i-status">
								<option value="">Pilih</option>
								@foreach([ 'AKTIF', 'DROPPED', 'SELESAI' ] as $status)
								<option value="{{ $status }}">{{ $status }}</option>
								@endforeach
							</select>
							@if(errors('status'))
							<div class="invalid-feedback d-block">{{ errors('status') }}</div>
							@endif
						</div>


						<button class="btn btn-primary">Buat baru</button>
					</div>
				</div>
			</div>

		</div>
	</form>

@endsection
