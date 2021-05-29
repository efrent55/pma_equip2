<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>

<div class="login-box">
  <div class="login-box-body">
    <center><img src="<?php echo e(URL::asset('/images/tactics.png')); ?>" alt="pmahq logo" height="100px"></center>
    <p class="login-box-msg"><b>Headquarters Tactics Group </b></p>
    <p class="login-box-msg"><b>Equipment Information System</b></p>
    <p class="login-box-msg">Sign In to your account</p>

    <form action="<?php echo e(url('login')); ?>" method="post">
      <?php echo e(csrf_field()); ?>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo e(old('username')); ?>" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo e(old('password')); ?>" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <a href="#">I forgot my password</a><br>
    
    <hr />
    <div>
      <p class="text-center text-muted small">For questions and inquiries, contact us through email at <a href="mailto:tg4@pma.edu.ph">tg4@pma.edu.ph</a> or through phone at <a href="tel:6715">6715</a>.</p>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.lte-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/auth/login.blade.php ENDPATH**/ ?>