@extends('layouts.app')


@section('head')


@endsection

@section('content')





<!-- Page Heading -->
<div class="d-flex align-items-center mb-4">
	<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Buat Sprint Backlog </h1>
	<a href="{{ base_url('scrums/create?project_id=' . $project->id) }}" class="btn btn-sm btn-primary">Buat Baru</a>
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
		<div class="card shadow">
			<div class="card-header"><h4 class="mb-0 font-weight-bold">{{ $project->name ?? ''}}</h4></div>
			<div class="card-body">{!! $table !!}</div>
		</div>
	</div>
</div>

@endsection
