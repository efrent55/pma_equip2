<?php $__env->startSection('title', 'Issuance'); ?>

<?php $__env->startSection('styles'); ?>
    <script src="<?php echo e(asset('js/instascan.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li><a href="<?php echo e(route('operations.index')); ?>">Equipment Operations</a></li>
        <li class="active">Issuance</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="box box-solid">
    <div class="box-body">
        <h4><i class="fa fa-pencil"></i> New Issuance</h4>
        <hr />
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" action="<?php echo e(route('equipment.store.issuance', $cadet_id)); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

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

                    <hr />
                    <table class="table table-condensed table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Value</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(session('cart')): ?>
                                <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($temp['serial_number']); ?></td>
                                    <td><?php echo e($temp['description']); ?></td>
                                    <td><?php echo e($temp['unit_measure']); ?></td>
                                    <td><?php echo e($temp['unit_value']); ?></td>
                                    <td><button class="btn btn-danger btn-sm remove" data-id="<?php echo e($id); ?>"><i class="fa fa-trash-o"></i> Remove</button></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <hr />
                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary" <?php if(!session('cart')): ?> disabled <?php endif; ?>><i class="fa fa-save"></i> Save Changes</button>
                    </span>
                </form>
            </div>

            <div class="col-md-4">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">QR SCAN <a href="" data-toggle="modal" data-target="#modal-search-equipment"><i class="fa fa-search" title="Search Equipment"></i></a></label>
                        <div class="col-sm-8">
                            <video id="preview" style="height:180px;"></video>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
                        <th>Search String</th>
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
                            <td><?php echo e($equipment->qr_code); ?></td>
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
<script type="text/javascript">
function activateScanner() {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        /* window.location.href = content; */
        var table = $('.dt').DataTable();
        table.search(content).draw();
        //$('.dt').search('50RSUoHk8v').draw();
        $('#modal-search-equipment').modal('show');
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
        scanner.start(cameras[0]);
        } else {
        console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });
}

</script>

  <!-- DataTables -->
  <script src="<?php echo e(asset('adminlte/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>

  <script>
    activateScanner();
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
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/operations/issuance.blade.php ENDPATH**/ ?>