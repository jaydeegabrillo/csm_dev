<!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?= $title ?></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


            <!-- Sales Chart and browser state-->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="no-block">
                                <div>
                                    <h5 class="card-title m-b-0">Assignments Table</h5>
                                    <div class="col-lg-1 pull-right">
                                        <?php if($position <= 2){ ?>
                                            <button type="button" class="btn btn-primary btn-sm add_assignment" data-toggle="modal" data-target="#add_assignment_modal">Add Assignment</button>
                                        <?php } ?>
                                    </div>
                                    <table id="assignments_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Assigned User</th>
                                            <th>Client Name</th>
                                            <th>Inclusive Dates</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Assigned User</th>
                                            <th>Client Name</th>
                                            <th>Inclusive Dates</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->
        </div>
        <!-- End Container fluid  -->

        <!-- footer -->
        <footer class="footer"> ?? 2018 Adminwrap by wrappixel.com </footer>
        <!-- End footer -->
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->
