<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark <?= ($title == 'Dashboard') ? "active" : ''; ?>" href="<?= base_url('dashboard') ?>" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a> </li>
                <li> <a class="waves-effect waves-dark <?= ($title == 'Timesheet') ? "active" : ''; ?>" href="<?= base_url('timesheet')?>" aria-expanded="false"><i class="fa fa-hourglass"></i><span class="hide-menu">Timesheet</span></a> </li>
                <?php if($position <= 2){ ?>
                    <li> <a class="waves-effect waves-dark <?= ($title == 'Users') ? "active" : ''; ?>" href="<?= base_url('users')?>" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Staff</span></a> </li>
                    <li> <a class="waves-effect waves-dark <?= ($title == 'Clients') ? "active" : ''; ?>" href="<?= base_url('clients')?>" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Clients</span></a> </li>
                <?php } ?>
                <li> <a class="waves-effect waves-dark <?= ($title == 'Assignments') ? "active" : ''; ?>" href="<?= base_url('assignments')?>" aria-expanded="false"><i class="fa fa-tasks"></i><span class="hide-menu">Assignments</span></a> </li>
                <li> <a class="waves-effect waves-dark <?= ($title == 'Schedules') ? "active" : ''; ?>" href="<?= base_url('schedules')?>" aria-expanded="false"><i class="fa fa-calendar"></i><span class="hide-menu">Schedules</span></a> </li>
                <li> <a class="waves-effect waves-dark <?= ($title == 'Notes') ? "active" : ''; ?>" href="<?= base_url('notes')?>" aria-expanded="false"><i class="fa fa-pencil"></i><span class="hide-menu">Notes</span></a> </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
