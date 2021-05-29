<?php $__env->startSection('title', 'Equipment Operations'); ?>

<?php $__env->startSection('styles'); ?>
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li class="active">Equipment Operations</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group" placeholder="Cadet">
                            <input type="text" class="form-control" placeholder="Select cadet..." value="<?php echo e($cadet_name); ?>">
                            <span class="input-group-btn">
                                <a href="#" data-toggle="modal" data-target="#modal-select-cadet" class="btn btn-info">...</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <?php echo $__env->make('_includes.alert.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                    <!-- modal -->
                    <div class="modal fade" id="modal-select-cadet">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Cadets</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-condensed table-bordered table-responsive-sm dt">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Coy</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $cadets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cadet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($cadet->sn); ?></td>
                                                <td><?php echo e($cadet->lastname); ?>, <?php echo e($cadet->firstname); ?> <?php echo e($cadet->middlename); ?></td>
                                                <td></td>
                                                <td><a href="<?php echo e(route('equipment.load.index', $cadet->id)); ?>" class="btn btn-default btn-sm pull-right">Select</a></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- modal -->


                <hr />
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <b>Issued</b> <a class="pull-right"><?php echo e($count_issuance); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Turn In</b> <a class="pull-right"><?php echo e($count_turnin); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Reported</b> <a class="pull-right"><?php echo e($count_reported); ?></a>
                            </li>
                          </ul>

                        <center>
                            <a href="<?php echo e(route('equipment.load.issuance', $cadet_id)); ?>" class="btn btn-primary" <?php if($cadet_id==''): ?> disabled <?php endif; ?>>New Issuance</a>
                            <a href="<?php echo e(route('equipment.load.turnin', $cadet_id)); ?>" class="btn btn-success" <?php if($cadet_id==''): ?> disabled <?php endif; ?>>New Turn-In</a>
                            <a href="<?php echo e(route('equipment.load.report', $cadet_id)); ?>" class="btn btn-danger" <?php if($cadet_id==''): ?> disabled <?php endif; ?>>New Report</a>
                        </center>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-condensed table-bordered table-responsive-sm dt">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Serial Number</th>
                                    <th>Description</th>
                                    <th>EAR</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($items ==! ''): ?>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->updated_at); ?></td>
                                            <td><?php echo e($item->serial_number); ?></td>
                                            <td><?php echo e($item->description); ?></td>
                                            <td><?php echo e($item->ear); ?></td>
                                            <td><?php echo e($item->type); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <!-- DataTables -->
  <script src="<?php echo e(asset('adminlte/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>

  <script>
    $("#success-alert").hide();
    $(function () {
      $('.dt').DataTable()
    })
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/operations/index.blade.php ENDPATH**/ ?>