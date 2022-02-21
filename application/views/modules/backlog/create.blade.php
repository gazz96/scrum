@extends('layouts.app')


@section('content')

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Buat Backlog "{{ $project->name }}"</h1>
		<a href="{{ base_url('projects') }}" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	
	<form method="POST" action="{{ base_url('projects/store') }}">
		<input type="hidden" name="true_submit" class="create">
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="card shadow">
					<div class="card-body">
				
						<div class="form-group">
							<label for="i-module_name">Nama Module</label>
							<input type="text" name="module_name" class="form-control" id="i-module_name" value="">
							@if(errors('module_name'))
							<div class="invalid-feedback d-block">{{ errors('module_name') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-plan">Plan</label>
							<textarea type="text" name="plan" class="form-control" id="i-plan"></textarea>
							@if(errors('plan'))
							<div class="invalid-feedback d-block">{{ errors('plan') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-developer_id">Developers</label>
							<select name="developer_id" id="developer_id" class="form-control" id="i-developer_id">
								<option value="">Pilih</option>
								@foreach($developers as $developer)
								<option value="{{ $developer->id }}">{{ $developer->name }}</option>
								@endforeach
							</select>
							@if(errors('developer_id'))
							<div class="invalid-feedback d-block">{{ errors('developer_id') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-period_start">Rencana Tanggal Mulai</label>
							<input type="date" name="period_start" class="form-control" id="i-period_start" value="">
							@if(errors('period_start'))
							<div class="invalid-feedback d-block">{{ errors('period_start') }}</div>
							@endif
						</div>

						<div class="form-group">
							<label for="i-period_end">Rencana Tanggal Selesai</label>
							<input type="date" name="period_end" class="form-control" id="i-period_end" value="">
							@if(errors('period_end'))
							<div class="invalid-feedback d-block">{{ errors('period_end') }}</div>
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
