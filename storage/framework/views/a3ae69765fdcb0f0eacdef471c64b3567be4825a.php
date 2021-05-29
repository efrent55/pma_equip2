<?php $__env->startSection('title', 'Inventory Status Report'); ?>

<?php $__env->startSection('styles'); ?>
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li class="active">Inventory Status Report</li>
    </ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6"><h4><i class="fa fa-file"></i> <?php echo e($report); ?></h4></div>
                    <div class="col-xs-6"><a href="" class="btn btn-primary pull-right">Print Report</a></div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm dt">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Description</th>
                            <th>Unit Value</th>
                            <th>Unit</th>
                            <th>Date Acquired</th>
                            <th>Issued to</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($equipment->serial_number); ?>1</td>
                                <td><?php echo e($equipment->description); ?></td>
                                <td><?php echo e($equipment->unit_value); ?></td>
                                <td><?php echo e($equipment->unit_measure); ?></td>
                                <td><?php echo e($equipment->date_acquired); ?></td>
                                <td><?php if($equipment->sn==''): ?> None <?php else: ?><?php echo e($equipment->lastname); ?>, <?php echo e($equipment->firstname); ?> <?php echo e($equipment->middlename); ?> C-<?php echo e($equipment->sn); ?><?php endif; ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot>
                </table>
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
    $(function () {
      $('.dt').DataTable();
     /*  $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      }) */
    })
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/report/inventory.blade.php ENDPATH**/ ?>