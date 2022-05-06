<div class="row">
    <div class="col-12">
        <div class="position-absolute d-flex overflow" id="project-wrapper" style="max-width: 100%; min-height: 100%; overflow-x: auto; overflow-y: hidden;">
            <div class="col-card">
                <div class="card shadow">
                    <div class="card-header">
                        <a href="#create-card" data-toggle="collapse" class="d-block"><span class="fas fa-plus pr-2"></span>Tambah list baru</a>
                    </div>
                    <div class="collapse" id="create-card">
                        <div class="card-body">
                            
                            <form action="{{ base_url('') }}" id="create-new-card-form">
                                <input type="hidden" name="project_id" value="{{$project->id}}">
                                <div>
                                    <input type="text" name="title" class="form-control mb-2" placeholder="Enter section name">
                                    <button class="btn btn-sm btn-primary">Tambah list baru</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>