<?php $__env->startSection('title', 'Turn In'); ?>

<?php $__env->startSection('styles'); ?>
    <script src="<?php echo e(asset('js/instascan.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li><a href="<?php echo e(route('operations.index')); ?>">Equipment Operations</a></li>
        <li class="active">Turn In</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="box box-solid">
    <div class="box-body">
        <h4><i class="fa fa-pencil"></i> Turn In Equipment</h4>
        <hr />
        <div class="row">
            <form class="form-horizontal" action="<?php echo e(route('equipment.store.turnin', $cadet_id)); ?>" method="post">
            <?php echo e(csrf_field()); ?>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Cadet</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cadet" value="<?php echo e($cadet_name); ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">EAR</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ear" value="<?php echo e($ear); ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Purpose</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="purpose" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">Remarks</b></label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><b class="pull-right">If Representative</b></label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="rep_cadet_id">
                                <option value="" selected disabled>- Search -</option>
                                <?php $__currentLoopData = $cadets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cadet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cadet->id); ?>"><?php echo e($cadet->lastname); ?>, <?php echo e($cadet->firstname); ?> C-<?php echo e($cadet->sn); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <table class="table table-condensed table-bordered table-responsive-sm dt">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Turn In</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td title="Property Number: <?php echo e($equipment->property_number); ?> "><?php echo e($equipment->serial_number); ?></td>
                                    <td><?php echo e($equipment->description); ?> (<?php echo e($equipment->commonname); ?>)</td>
                                    <td><?php echo e($equipment->unit_measure); ?></td>
                                    <td><?php echo e($equipment->unit_value); ?></td>
                                    <td><?php echo e($equipment->status); ?></td>
                                    <td><input type="checkbox" name="equipment_id[]" value="<?php echo e($equipment->id); ?>" /></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr />
            <?php echo $__env->make('_includes.alert.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save Changes</button>
        </form>
    </div><!-- row -->
</div>


<div class="modal fade" id="modal-search-equipment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Equipment</h4>
        </div>
        <div class="modal-body">
            <table class="table table-condensed table-bordered table-responsive-sm dt">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td title="Property Number: <?php echo e($equipment->property_number); ?> "><?php echo e($equipment->serial_number); ?></td>
                            <td><?php echo e($equipment->description); ?> (<?php echo e($equipment->commonname); ?>)</td>
                            <td><?php echo e($equipment->unit_measure); ?></td>
                            <td><?php echo e($equipment->unit_value); ?></td>
                            <td><?php echo e($equipment->status); ?></td>
                            <td>
                                <a href="<?php echo e(route('equipment.add.equipment', $equipment->id)); ?>" class="btn btn-primary btn-sm pull-right">Add Equipment</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
    $('.select2').select2();
    $(function () {
      $('.dt').DataTable()
    });

    $(".remove").click(function (e) {
        e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure you want to remove this equipment?")) {
                $.ajax({
                url: '<?php echo e(route('equipment.remove.equipment')); ?>',
                method: "DELETE",
                data: {_token: '<?php echo e(csrf_token()); ?>', id: ele.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/operations/turnin.blade.php ENDPATH**/ ?>