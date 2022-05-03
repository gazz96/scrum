@extends('layouts.app')


@section('head')


@endsection

@section('content')




<div x-data="{}">

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Projects</h1>
		<a href="{{ base_url('projects/create') }}" class="btn btn-sm btn-primary">Buat Baru</a>
		<a href="javascript:void(0)" class="btn btn-sm btn-primary mx-2" data-toggle="collapse" data-target="#collapse-filter">Filter</a>
	</div>

	<div class="collapse mb-4" id="collapse-filter">
		<div class="card card-body shadow">
			<form>

				<div class="row">

					<div class="col-md-2">
						<select name="filter_by" class="form-control mb-3">
							<option value="name">Nama</option>
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
			<div class="row">
				@foreach($projects as $project)
				<div class="col-md-3 mb-3">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title font-weight-bold">{{$project->name }}</h4>
						</div>
						<a href="{{	base_url("projects/show/$project->id") }}" class="stretched-link"></a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

</div>

@endsection
