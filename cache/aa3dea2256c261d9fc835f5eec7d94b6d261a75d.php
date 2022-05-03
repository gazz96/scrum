<?php $__env->startSection('head'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




<div x-data="{}">

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Projects</h1>
		<a href="<?php echo e(base_url('projects/create')); ?>" class="btn btn-sm btn-primary">Buat Baru</a>
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
						<input name="keyword" type="text" class="form-control mb-3" placeholder="Masukan kata kunci" value="<?php echo e(request('keyword')); ?>">
					</div>
				</div>
				<button class="btn btn-primary">Terapkan</button>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="row">
				<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-3 mb-3">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title font-weight-bold"><?php echo e($project->name); ?></h4>
						</div>
						<a href="<?php echo e(base_url("projects/show/$project->id")); ?>" class="stretched-link"></a>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/project/lists.blade.php ENDPATH**/ ?>