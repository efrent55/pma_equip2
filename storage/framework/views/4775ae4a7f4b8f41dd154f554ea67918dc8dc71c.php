<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="<?php echo e(route('index')); ?>"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Equipment</span> <!-- Equipment -->
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('operations.index')); ?>"><i class="fa fa-circle-o"></i> Operations</a></li>
                    <li><a href="<?php echo e(route('management.index')); ?>"><i class="fa fa-circle-o"></i> Management</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Transfer</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Management</span> <!-- System Management -->
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('users.index')); ?>"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li><a href="<?php echo e(route('activity.logs')); ?>"><i class="fa fa-circle-o"></i> Activity Logs</a></li>
                    
                </ul>
            </li>
        </ul>
    </section>
</aside><?php /**PATH C:\xampp\htdocs\pma_equip\resources\views/_includes/nav/aside.blade.php ENDPATH**/ ?>