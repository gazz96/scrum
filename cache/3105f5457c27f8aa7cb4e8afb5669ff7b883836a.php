<?php $__env->startSection('content'); ?>

	<!-- Page Heading -->
	<div class="d-flex align-items-center mb-4">
		<h1 class="h3 text-gray-800 font-weight-bold mr-3 mb-0">Buat Backlog "<?php echo e($project->name); ?>"</h1>
		<a href="<?php echo e(base_url('projects')); ?>" class="btn btn-sm btn-secondary">Kembali</a>
	</div>
	
	<form method="POST" action="<?php echo e(base_url('projects/store')); ?>">
		<input type="hidden" name="true_submit" class="create">
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="card shadow">
					<div class="card-body">
				
						<div class="form-group">
							<label for="i-module_name">Nama Module</label>
							<input type="text" name="module_name" class="form-control" id="i-module_name" value="">
							<?php if(errors('module_name')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('module_name')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-plan">Plan</label>
							<textarea type="text" name="plan" class="form-control" id="i-plan"></textarea>
							<?php if(errors('plan')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('plan')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-developer_id">Developers</label>
							<select name="developer_id" id="developer_id" class="form-control" id="i-developer_id">
								<option value="">Pilih</option>
								<?php $__currentLoopData = $developers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $developer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($developer->id); ?>"><?php echo e($developer->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('developer_id')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('developer_id')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-period_start">Rencana Tanggal Mulai</label>
							<input type="date" name="period_start" class="form-control" id="i-period_start" value="">
							<?php if(errors('period_start')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('period_start')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-period_end">Rencana Tanggal Selesai</label>
							<input type="date" name="period_end" class="form-control" id="i-period_end" value="">
							<?php if(errors('period_end')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('period_end')); ?></div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="i-status">Status</label>
							<select name="status" id="status" class="form-control" id="i-status">
								<option value="">Pilih</option>
								<?php $__currentLoopData = [ 'AKTIF', 'DROPPED', 'SELESAI' ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($status); ?>"><?php echo e($status); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if(errors('status')): ?>
							<div class="invalid-feedback d-block"><?php echo e(errors('status')); ?></div>
							<?php endif; ?>
						</div>


						<button class="btn btn-primary">Buat baru</button>
					</div>
				</div>
			</div>

		</div>
	</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\scrum\application\views/modules/backlog/create.blade.php ENDPATH**/ ?>