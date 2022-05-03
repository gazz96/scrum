


<?php $__env->startSection('head'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




<div x-data="{}">

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Tasks</h1>
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
						<input name="keyword" type="text" class="form-control mb-3" placeholder="Masukan kata kunci" value="<?php echo e(request('keyword')); ?>">
					</div>
				</div>
				<button class="btn btn-primary">Terapkan</button>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-3 col-md-3">
			<div class="card shadow">
                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#modal-task-form"><span class="fas fa-plus"></span> Add new task</a>
                </div>
			</div>
		</div>
	</div>

    <div class="row task-wrapper">
	</div>

</div>

<!-- Modal -->
<form id="form-add-task">
    <input type="hidden" name="project_id" value="<?php echo e(request('project_id')); ?>">
    <div class="modal fade" id="modal-task-form" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="i-title">Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>

<script id="view-card">
    <div class="col-3 col-md-3">
		<div class="card shadow">
            <div class="card-body">
                <h6><?php echo e(title); ?></h6>        
            </div>
        </div>
    </div>
</script>

<script>

$(function(){

    let request;
    let taskWrapper = $('.task-wrapper');

    $('#form-add-task').submit(function(e){
        e.preventDefault();
        let _this = $(this);
        _this.find('.btn-primary').attr('disabled',true);
        request = $.ajax({
            url: `<?php echo base_url('cards/store') ?>`,
            data: _this.serialize(),
            method: 'POST'
        })

        request.fail(() => {

        });

        request.done((response) => {
            console.log('response', response);
        });

        request.always(() => {
            _this.find('.btn-primary').attr('disabled',false);
            $('#modal-task-form').modal('hide');
        });
    });

    


});

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/card/list.blade.php ENDPATH**/ ?>