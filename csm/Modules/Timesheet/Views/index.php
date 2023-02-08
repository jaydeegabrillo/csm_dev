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
                                    <h5 class="card-title m-b-0">Timesheet Table</h5>
                                    <div class="col-lg-1 pull-right">
                                        <!-- <a href="<?= base_url('timesheet/timesheet_pdf') ?>" target="_blank">
                                        </a> -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#timesheet_pdf">Timesheet PDF</button>
                                    </div>
                                    <table id="timesheet_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Clock In</th>
                                            <th>Clock Out</th>
                                            <th>Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
                                            <th>Clock In</th>
                                            <th>Clock Out</th>
                                            <th>Hours</th>
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