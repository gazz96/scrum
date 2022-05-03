

<?php $__env->startSection('header'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0"><?php echo e($project->name); ?></h1>
		<a href="<?php echo e(base_url('projects')); ?>" class="btn btn-sm btn-secondary">Kembali</a>
        <input type="hidden" id="i-project_id" value="<?php echo e($project->id); ?>">
	</div>
    
    <div class="row" id="project-wrapper">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <a href="#create-card" data-toggle="collapse" class="d-block"><span class="fas fa-plus pr-2"></span>Tambah list baru</a>
                </div>
                <div class="card-body collapse" id="create-card">
                    
                    <form action="<?php echo e(base_url('')); ?>" id="create-new-card-form">
                        <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                        <div>
                            <input type="text" name="title" class="form-control mb-2" placeholder="Enter section name">
                            <button class="btn btn-sm btn-primary">Tambah list baru</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
    

<!-- Modal -->
<div class="modal fade" id="card-item-detail" tabindex="-1" role="dialog" aria-labelledby="card-item-detail" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="card-item-modal-content">
                    <div class="form-group">
                        <label for="i-description">Description</label>
                        <textarea name="description" id="i-description"  rows="3" class="form-control"></textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="i-assign_to">Assign To</label>
                            <input type="text" class="form-control member-search">
                            <div class="member-search-result"></div>
                            <div class="member-search-added"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="i-status">Status</label>
                            <select name="status" id="i-status" class="form-control">
                                <option value="To Do">To Do</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>


                    <button class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(base_url('assets/main/js/project.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/project/show.blade.php ENDPATH**/ ?>