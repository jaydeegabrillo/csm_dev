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
                <!-- <div class="col-lg-8">
                    <div class="card text-white clock_type <?= $clocked ?>">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div>
                                    <h5 class="card-title text-white m-b-0 clock_text">Clock In</h5>
                                </div>
                                <div class="ml-auto">
                                    <span class="clock_in"><i class="fa fa-clock"></i>
                                        <?= ($time_clocked) ? date('h:i A', strtotime($time_clocked)) : '' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- Column -->
                <!-- <div class="col-lg-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div>
                                    <h5 class="card-title text-white m-b-0 clock_text">Active Users</h5>
                                </div>
                                <div class="ml-auto">
                                    <span class=""><i class="fa fa-users"></i><?= $active_users ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- End Sales Chart -->

            <!-- Page Content -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="no-block">
                                <div>
                                    <h5 class="card-title m-b-0">Schedules Today</h5>
                                    <div class="col-lg-2 pull-right">
                                        <label for="search_date">Search Date: </label>
                                        <input id="search_date" class="form-control" type="date" name="search_date">
                                    </div>
                                    <table id="dashboard_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Staff Name</th>
                                                <th>Client Name</th>
                                                <th>Time</th>
                                                <th>In</th>
                                                <th>Out</th>
                                                <th>Date</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Staff Name</th>
                                                <th>Client Name</th>
                                                <th>Time</th>
                                                <th>In</th>
                                                <th>Out</th>
                                                <th>Date</th>
                                                <th>Options</th>
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
        <footer class="footer"> © 2018 Adminwrap by wrappixel.com </footer>
        <!-- End footer -->
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->
