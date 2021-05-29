<?php $__env->startSection('title', 'Equipment Management'); ?>

<?php $__env->startSection('styles'); ?>
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li class="active">Equipment Management</li>
    </ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6"><h4><i class="fa fa-list"></i> Equipment</h4></div>
                    <div class="col-md-6">
                      <span class="pull-right">
                        <a href="<?php echo e(route('equipment.load.classification')); ?>" class="btn btn-flat btn-md btn-default">Equipment Classification</a>
                        <a href="<?php echo e(route('management.create')); ?>" class="btn btn-flat btn-md btn-success">Add New Equipment</a>
                      </span>
                    </div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-md dt">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Description</th>
                            <th>Unit Value</th>
                            <th>Unit</th>
                            <th>Date Acquired</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($equipment->serial_number); ?></td>
                                <td><?php echo e($equipment->description); ?></td>
                                <td><?php echo e($equipment->unit_value); ?></td>
                                <td><?php echo e($equipment->unit_measure); ?></td>
                                <td><?php echo e($equipment->date_acquired); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo e($equipment->id); ?>" class="btn btn-default btn-md">EDIT</a>
                                    <a href="#" data-toggle="modal" data-target="#modal-qrcode<?php echo e($equipment->qr_code); ?>" class="btn btn-info btn-md">VIEW QR CODE</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-qrcode<?php echo e($equipment->qr_code); ?>">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">PREVIEW QR CODE</h4>
                                  </div>
                                  <div class="modal-body">
                                      <center><?php echo QrCode::size(200)->generate($equipment->qr_code);; ?></center>
                                      <br />
                                      <p class="text-muted small text-center"><?php echo e($equipment->description); ?>, <?php echo e($equipment->serial_number); ?></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <a href="<?php echo e(asset($equipment->qrcode_file)); ?>" download="<?php echo e($equipment->description); ?> <?php echo e($equipment->serial_number); ?>" class="btn btn-warning">Download QR Code</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade" id="modal-edit<?php echo e($equipment->id); ?>">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Equipment : <?php echo e($equipment->description); ?></h4>
                                  </div>
                                  <form role="form" action="<?php echo e(route('equipment.update.equipment', $equipment->id)); ?>" method="post">
                                    <div class="modal-body">
                                      <?php echo e(csrf_field()); ?>

                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Property Number <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="property_number" value=<?php echo e($equipment->property_number); ?> />
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Serial Number <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="serial_number" value=<?php echo e($equipment->serial_number); ?> />
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label class="control-label"><b class="pull-right">Description <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="description" value=<?php echo e($equipment->description); ?> />
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="control-label"><b class="pull-right">Unit Measure <i class="text-red" title="Required field">*</i></b></label>
                                        <input type="text" class="form-control" name="unit_measure" value=<?php echo e($equipment->unit_measure); ?> />
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="control-label"><b class="pull-right">Unit Value </b></label>
                                        <input type="text" class="form-control" name="unit_value" value=<?php echo e($equipment->unit_value); ?> />
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label class="control-label"><b class="pull-right">Date Acquired</b></label>
                                        <input type="text" class="form-control" name="date_acquired" value=<?php echo e($equipment->date_acquired); ?> />
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Classification <i class="text-red" title="Required field">*</i></b></label>
                                        <select class="form-control select2" name="classification" required> 
                                          <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($keyword->id); ?>" <?php echo e($equipment->keyword_id == $keyword->id ? 'selected':''); ?>><?php echo e($keyword->commonname); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="control-label"><b class="pull-right">Status <i class="text-red" title="Required field">*</i></b></label>
                                        <select class="form-control" name="status" required>
                                          <option value="SERVICEABLE" <?php if($equipment->status=='SERVICEABLE'): ?> selected <?php endif; ?>>SERVICEABLE</option>
                                          <option value="UNSERVICEABLE" <?php if($equipment->status=='UNSERVICEABLE'): ?> selected <?php endif; ?>>UNSERVICEABLE</option>
                                          <option value="TURNED IN TO SAO" <?php if($equipment->status=='TURNED IN TO SAO'): ?> selected <?php endif; ?>>TURNED IN TO SAO</option>
                                        </select>
                                      </div>
                                      <hr />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                                    </div>
                                </form>
                                </div>
                              </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="box-footer">
              <?php echo $__env->make('_includes.alert.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/management/index.blade.php ENDPATH**/ ?>