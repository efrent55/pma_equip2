<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="PMA Domain Project - unified systems" />
        <meta name="author" content="irishangelrubillos@gmail.com viber:09189123963" />
        <meta name="csrf-token" value="<?php echo e(csrf_token()); ?>">

        <title>Domain | <?php echo $__env->yieldContent('title'); ?></title>
        <link rel="shortcut icon" href="<?php echo e(asset('images/tactics.png')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('adminlte/bootstrap/dist/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte/font-awesome/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte/Ionicons/css/ionicons.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/AdminLTE.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/iCheck/square/blue.css')); ?>">
        <style>
          html, body{
            height: 0 !important;
          }
        </style>
    </head>

    <body class="hold-transition login-page" style="background-color:#27343b;">
      <?php echo $__env->yieldContent('content'); ?>

      <!-- Plugins -->
      <script type="text/javascript" src="<?php echo e(asset('adminlte/jquery/dist/jquery.min.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('adminlte/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('adminlte/plugins/iCheck/icheck.min.js')); ?>"></script>
      <script>
        $(function () {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
          });
        });
      </script>

    </body>
</html><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/layouts/lte-login.blade.php ENDPATH**/ ?>