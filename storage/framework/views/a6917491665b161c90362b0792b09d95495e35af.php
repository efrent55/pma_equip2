<?php $__env->startSection('title', 'Activity Logs'); ?>

<?php $__env->startSection('styles'); ?>
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li class="active">Activity Logs</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12"><h4><i class="fa fa-list"></i> Activity Logs</h4></div>
                    
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm dt">
                    <thead>
                        <tr>
                            <th>Date/Time</th>
                            <th>User Account</th>
                            <th>Activity Logs</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($log->created_at); ?></td>
                            <td>User ID: <?php echo e($log->user_id); ?> (<?php echo e($log->lastname); ?>, <?php echo e($log->firstname); ?> <?php echo e($log->middlename); ?>)</td>
                            <td><?php echo e($log->activity); ?></td>
                            <td><?php echo e($log->ip_address); ?></td>
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
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/manage/logs/index.blade.php ENDPATH**/ ?>