<?php $__env->startSection('content'); ?>

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Edit Project</h1>
		<a href="<?php echo e(base_url('projects')); ?>" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	<form method="POST" action="<?php echo e(base_url('projects/update/' . $project->id)); ?>">
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
							<label for="i-name">Nama Project</label>
							<input type="text" name="name" class="form-control" id="i-name" value="<?php echo e($project->name); ?>">
							<?php if(errors('name')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('name')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-unit_id">Unit</label>
							<select name="unit_id" id="unit_id" class="form-control" id="i-unit_id">
								<option value="">Pilih</option>
								<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($unit->id); ?>" <?php echo e(selected( $unit->id, $project->unit_id)); ?>><?php echo e($unit->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('unit_id')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('unit_id')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-pic_id">PIC</label>
							<select name="pic_id" id="pic_id" class="form-control" id="i-pic_id">
								<option value="">Pilih</option>
								<?php $__currentLoopData = $pics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($pic->id); ?>" <?php echo e(selected( $pic->id, $project->pic_id )); ?>><?php echo e($pic->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('pic_id')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('pic_id')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-master_id">Scrum Master</label>
							<select name="master_id" id="master_id" class="form-control" id="i-master_id">
								<option value="">Pilih</option>
								<?php $__currentLoopData = $masters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($master->id); ?>" <?php echo e(selected( $master->id, $project->master_id )); ?>><?php echo e($master->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('master_id')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('master_id')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-owner_id">Owner</label>
							<select name="owner_id" id="owner_id" class="form-control" id="i-owner_id">
								<option value="">Pilih</option>
								<?php $__currentLoopData = $owners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($owner->id); ?>"  <?php echo e(selected( $owner->id, $project->owner_id )); ?>><?php echo e($owner->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('owner_id')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('owner_id')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-status">Status</label>
							<select name="status" id="status" class="form-control" id="i-status">
								<option value="">Pilih</option>
								<?php $__currentLoopData = [ 'AKTIF', 'DROPPED', 'SELESAI' ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($status); ?>"  <?php echo e(selected( $status, $project->status )); ?>><?php echo e($status); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('status')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('status')); ?></div>
							<?php endif; ?>
						</div>

						<button class="btn btn-primary">Perbaharui</button>
					</div>
				</div>
			</div>

		</div>
	</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/project/edit.blade.php ENDPATH**/ ?>