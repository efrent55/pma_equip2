<?php $__env->startSection('title', 'Equipment Management'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li><a href="<?php echo e(route('management.index')); ?>">Equipment Management</a></li>
        <li class="active">Equipment Classification</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"><h4><i class="fa fa-list"></i> Equipment Classification</h4></div>
                    <div class="col-sm-6"><a href="#" data-toggle="modal" data-target="#modal-classification" class="btn btn-flat btn-success pull-right">Add New Classification</a></div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Common Name</th>
                            <th>Account</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $commonnames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commonname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($commonname->commonname); ?></td>
                                <td><?php echo e($commonname->code); ?> - <?php echo e($commonname->description); ?></td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-edit<?php echo e($commonname->id); ?>" class="btn btn-default pull-right">Edit</a></td>
                            </tr>

                            <div class="modal fade" id="modal-edit<?php echo e($commonname->id); ?>">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" action="<?php echo e(route('equipment.update.classification', $commonname->id)); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Edit Classification : <?php echo e($commonname->commonname); ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label"><b class="pull-right">Account <i class="text-red" title="Required field">*</i></b></label>
                                                    <select class="form-control select2" name="account" required>
                                                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($account->id); ?>" <?php echo e($commonname->account_id == $account->id ? 'selected':''); ?>><?php echo e($account->code); ?> - <?php echo e($account->description); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><b class="pull-right">Common Name <i class="text-red" title="Required field">*</i></b></label>
                                                    <input type="text" class="form-control" name="commonname" value="<?php echo e($commonname->commonname); ?>" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
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

<div class="modal fade" id="modal-classification">
    <div class="modal-dialog">
        <form class="form-horizontal" action="<?php echo e(route('equipment.store.classification')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Equipment Classification</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><b class="pull-right">Account <i class="text-red" title="Required field">*</i></b></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="account" required>
                                <option value="" selected disabled>- Select -</option>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($account->id); ?>"><?php echo e($account->code); ?> - <?php echo e($account->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><b class="pull-right">Common Name <i class="text-red" title="Required field">*</i></b></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="commonname" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/equipment/management/classification.blade.php ENDPATH**/ ?>