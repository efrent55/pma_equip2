<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('styles'); ?>
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('index')); ?>">Equipment IS</a></li>
        <li class="active">Users</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"><h4><i class="fa fa-list"></i> Users</h4></div>
                    <div class="col-sm-6"><a href="<?php echo e(route('users.create')); ?>" class="btn btn-flat btn-success pull-right">Add New User</a></div>
                </div>
                <hr />
                <br />
                <table class="table table-condensed table-bordered table-responsive-sm dt">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User Account</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><img class="img-circle " src="<?php echo e(asset('coreui/img/user-icon-png.png')); ?>" style="height:50px;" alt="<?php echo e($user->username); ?>"></td>
                                <td><span class="text-blue"><b><?php echo e($user->username); ?></b></span><br />
                                    <span class="text-muted">User Type: <?php echo e($user->profiles->profile_type); ?></span><br />
                                    <span class="badge <?php if($user->status==1): ?> bg-green <?php else: ?> bg-red <?php endif; ?>"><?php if($user->status==1): ?> Active <?php else: ?> Inactive <?php endif; ?></span><br />
                                </td>
                                <td><?php echo e($user->profiles->lastname); ?>, <?php echo e($user->profiles->firstname); ?></td>
                                <td valign="right">
                                    <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo e($user->id); ?>" class="btn btn-default btn-md">EDIT</a>
                                    <a href="<?php echo e(route('password.reset', $user->id)); ?>" class="btn btn-default btn-md"><i class="fa fa-asterisk"></i> Password Reset</a>
                                    <?php if($user->status==1): ?>
                                        <a href="<?php echo e(route('deactivate.user', $user->id)); ?>" class="btn btn-default btn-md text-red"><i class="fa fa-minus-circle"></i> Deactivate</a>
                                    <?php elseif($user->status==0): ?>
                                        <a href="<?php echo e(route('activate.user', $user->id)); ?>" class="btn btn-default btn-md text-green"><i class="fa fa-check-circle"></i> Activate</a>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-edit<?php echo e($user->id); ?>">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">Edit User : <?php echo e($user->profiles->lastname); ?>, <?php echo e($user->profiles->firstname); ?> <?php echo e($user->profiles->middlename); ?></h4>
                                    </div>
                                    <form role="form" method="post" action="<?php echo e(route('update.user', $user->id)); ?>">
                                        <?php echo e(csrf_field()); ?>

                                      <div class="modal-body">
                                            <p class="col-form-label"><b>Account Credentials</b></p>
                                            <div class="form-group col-md-12">
                                                <label for="type">Type <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="type" value="<?php echo e($user->profiles->profile_type); ?>" readonly />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Serial Number <span style="color:red" title="Required Field for Cadets">*</span></label>
                                                <input class="form-control" type="text" id="sn" name="sn" value="<?php echo e($user->profiles->sn); ?>" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Username <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="username" name="username" value="<?php echo e($user->username); ?>" required />
                                            </div>
                                            <hr />
                                            <p class="col-form-label"><b>Personal Information</b></p>
                                            <div class="form-group col-md-4">
                                                <label for="fname">First Name <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="fname" name="fname" value="<?php echo e($user->profiles->firstname); ?>" required />
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="fname">Middle Name <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="mname" name="mname" value="<?php echo e($user->profiles->middlename); ?>" required />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Surname <span style="color:red" title="Required Field">*</span></label>
                                                <input class="form-control" type="text" id="sname" name="sname" value="<?php echo e($user->profiles->lastname); ?>" required />
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="fname">Suffix</label>
                                                <input class="form-control" type="text" id="ename" name="ename" value="<?php echo e($user->profiles->extname); ?>" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Gender</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="Female" <?php if($user->profiles->gender=='Female'): ?> selected <?php endif; ?>>Female</option>
                                                    <option value="Male" <?php if($user->profiles->gender=='Male'): ?> selected <?php endif; ?>>Male</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Date of Birth</label>
                                                <input class="form-control" type="text" id="birthdate" name="birthdate" value="<?php echo e($user->profiles->birthdate); ?>" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fname">Company</label>
                                                <select class="form-control" id="coy" name="coy">
                                                    <option value="" <?php if($user->profiles->coy==''): ?> selected <?php endif; ?>>N/A</option>
                                                    <option value="A" <?php if($user->profiles->coy=='A'): ?> selected <?php endif; ?>>A</option>
                                                    <option value="B" <?php if($user->profiles->coy=='B'): ?> selected <?php endif; ?>>B</option>
                                                    <option value="C" <?php if($user->profiles->coy=='C'): ?> selected <?php endif; ?>>C</option>
                                                    <option value="D" <?php if($user->profiles->coy=='D'): ?> selected <?php endif; ?>>D</option>
                                                    <option value="E" <?php if($user->profiles->coy=='E'): ?> selected <?php endif; ?>>E</option>
                                                    <option value="F" <?php if($user->profiles->coy=='F'): ?> selected <?php endif; ?>>F</option>
                                                    <option value="G" <?php if($user->profiles->coy=='G'): ?> selected <?php endif; ?>>G</option>
                                                    <option value="H" <?php if($user->profiles->coy=='H'): ?> selected <?php endif; ?>>H</option>
                                                </select>
                                            </div>
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
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/manage/users/index.blade.php ENDPATH**/ ?>