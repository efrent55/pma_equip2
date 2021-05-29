<?php $__env->startSection('title', 'Equipment Management'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li><a href="<?php echo e(route('management.index')); ?>">Equipment Management</a></li>
        <li class="active">Add New Equipment</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <h4><i class="fa fa-pencil"></i> Add New Equipment</h4>
                <hr />
                <br />
                <form class="form-horizontal" action="<?php echo e(route('management.store')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><b class="pull-right">Property Number <i class="text-red" title="Required field">*</i></b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="property_number" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><b class="pull-right">Serial Number <i class="text-red" title="Required field">*</i></b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="serial_number" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><b class="pull-right">Description <i class="text-red" title="Required field">*</i></b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><b class="pull-right">Unit Measure <i class="text-red" title="Required field">*</i></b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="unit_measure" />
                    </div>
                    <label class="col-sm-2 control-label"><b class="pull-right">Unit Value </b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="unit_value" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><b class="pull-right">Date Acquired</b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="date_acquired" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><b class="pull-right">Classification <i class="text-red" title="Required field">*</i></b></label>
                    <div class="col-sm-4">
                        <select class="form-control select2" name="classification" required>
                            <option value="" selected disabled>- Select -</option>
                            <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($keyword->id); ?>"><?php echo e($keyword->commonname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label"><b class="pull-right">Status <i class="text-red" title="Required field">*</i></b></label>
                    <div class="col-sm-4">
                        <select class="form-control" name="status" required>
                            <option value="" selected disabled>- Select -</option>
                            <option value="SERVICEABLE">SERVICEABLE</option>
                            <option value="UNSERVICEABLE">UNSERVICEABLE</option>
                            <option value="TURNED IN TO SAO">TURNED IN TO SAO</option>
                        </select>
                    </div>
                </div>
                <hr />
                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/management/create.blade.php ENDPATH**/ ?>