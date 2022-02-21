<?php $__env->startSection('content'); ?>

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Edit Unit</h1>
		<a href="<?php echo e(base_url('units')); ?>" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	<form method="POST" action="<?php echo e(base_url('units/update/' . $unit->id)); ?>">
		<input type="hidden" name="true_submit" value="update">
		<div class="row">
			<div class="col-12 col-md-4">


				<div class="card">
					<div class="card-body">

						<?php if( session()->flashdata('message') ): ?>
						<div class="alert alert-success" role="alert">
							<strong><?php echo e(session()->flashdata('message')); ?></strong>
						</div>
						<?php endif; ?>
						<div class="form-group">
							<label for="i-name">Nama Unit</label>
							<input type="text" name="name" class="form-control" id="i-name" value="<?php echo e($unit->name); ?>">
							<?php if(errors('name')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('name')); ?></div>
							<?php endif; ?>
						</div>
						<button class="btn btn-primary">Perbaharui</button>
					</div>
				</div>
			</div>

		</div>
	</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/unit/edit.blade.php ENDPATH**/ ?>