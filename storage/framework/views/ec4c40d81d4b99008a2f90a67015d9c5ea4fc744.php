<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Equipment IS</a></li>
        <li class="active">Dashboard</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box box-body">

                <!--equipment status-->
                <div class="row">
                    <span class="col-lg-12 h4"><center>Equipment Status</center></span>
                    <div class="col-lg-4">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3><?php echo e($count_serviceable); ?></h3><p>Serviceable</p></div>
                            <div class="icon"><i class="fa fa-check-circle-o"></i></div>
                            <a href="<?php echo e(route('equipment.report.equipment')); ?>?report=Serviceable" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3><?php echo e($count_unserviceable); ?></h3><p>Unserviceable</p></div>
                            <div class="icon"><i class="fa fa-times-circle-o"></i></div>
                            <a href="<?php echo e(route('equipment.report.equipment')); ?>?report=Unserviceable" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3><?php echo e($count_turnedintosao); ?></h3><p>Turned In to SAO</p></div>
                            <div class="icon"><i class="fa fa-history"></i></div>
                            <a href="<?php echo e(route('equipment.report.equipment')); ?>?report=Turned In To SAO" class="small-box-footer">View Equipments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <hr />

                <!--inventory status-->
                <div class="row">
                    <span class="col-lg-12 h4"><center>Inventory Status</center></span>
                    <div class="col-lg-4">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3><?php echo e($count_instorage); ?></h3><p>In Storage</p></div>
                            <div class="icon"><i class="fa fa-tasks"></i></div>
                            <a href="<?php echo e(route('equipment.report.inventory')); ?>?report=In Storage" class="small-box-footer">View Inventory <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3><?php echo e($count_issued); ?></h3><p>Issued</p></div>
                            <div class="icon"><i class="fa fa-tags"></i></div>
                            <a href="<?php echo e(route('equipment.report.inventory')); ?>?report=Issued" class="small-box-footer">View Inventory <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="small-box bg-teal">
                            <div class="inner"><h3><?php echo e($count_lostdamage); ?></h3><p>Lost/Damage</p></div>
                            <div class="icon"><i class="fa fa-wrench"></i></div>
                            <a href="<?php echo e(route('equipment.report.inventory')); ?>?report=Lost or Damage" class="small-box-footer">View Inventory <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!--quick scan -->
                

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lte-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/index.blade.php ENDPATH**/ ?>