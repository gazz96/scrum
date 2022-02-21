@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Edit Project</h1>
		<a href="{{ base_url('projects') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	<form method="POST" action="{{ base_url('projects/update/' . $project->id) }}">
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
							<label for="i-name">Nama Project</label>
							<input type="text" name="name" class="form-control" id="i-name" value="{{ $project->name }}">
							@if(errors('name'))
							<div class="invalid-feedback d-block">{{ errors('name') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-unit_id">Unit</label>
							<select name="unit_id" id="unit_id" class="form-control" id="i-unit_id">
								<option value="">Pilih</option>
								@foreach($units as $unit)
								<option value="{{ $unit->id }}" {{ selected( $unit->id, $project->unit_id) }}>{{ $unit->name }}</option>
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
								<option value="{{ $pic->id }}" {{ selected( $pic->id, $project->pic_id ) }}>{{ $pic->name }}</option>
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
								<option value="{{ $master->id }}" {{ selected( $master->id, $project->master_id ) }}>{{ $master->name }}</option>
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
								<option value="{{ $owner->id }}"  {{ selected( $owner->id, $project->owner_id ) }}>{{ $owner->name }}</option>
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
								<option value="{{ $status }}"  {{ selected( $status, $project->status ) }}>{{ $status }}</option>
								@endforeach
							</select>
							@if(errors('status'))
							<div class="invalid-feedback d-block">{{ errors('status') }}</div>
							@endif
						</div>

						<button class="btn btn-primary">Perbaharui</button>
					</div>
				</div>
			</div>

		</div>
	</form>

@endsection
