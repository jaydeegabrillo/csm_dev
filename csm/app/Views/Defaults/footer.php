

    <!-- All Jquery -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/jquery/jquery.min.js"></script>

    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo ASSETS ?>/assets/node_modules/bootstrap/js/bootstrap.min.js"></script>

    <!--Wave Effects -->
    <script src="<?php echo ASSETS ?>/js/waves.js"></script>

    <!--Menu sidebar -->
    <script src="<?php echo ASSETS ?>/js/sidebarmenu.js"></script>

    <!--Custom JavaScript -->
    <script src="<?php echo ASSETS ?>/js/custom.min.js"></script>
    
    <!-- This page plugins -->

    <!-- jQuery CDN -->
    <script src="<?php echo ASSETS ?>/jquery-3.5.1.js"></script>

    <!-- Bootstrap 4.5 CDN  -->
    <script src="<?php echo ASSETS ?>/js/bootstrap.bundle.min.js"></script>

    <!-- DataTable CDN js -->
    <script src="<?php echo ASSETS ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS ?>/js/dataTables.bootstrap4.min.js"></script>

    <!-- Sweetalert JS script -->
    <script src="<?php echo ASSETS ?>/js/sweetalert2.all.min.js"></script>

    <!-- For header script -->
    <script src="<?= ASSETS ?>/js/header.js"></script>
    <!-- <script src="<?= ASSETS ?>/js/dropdown.js"></script> -->
    
    <!-- Page Specific Script -->
    <?php if(isset($js_scripts)){ ?>
        <?php foreach ($js_scripts as $js_script) { ?>
            <script type="text/javascript" src="<?php echo ASSETS.$js_script ?>"></script>
        <?php } ?>
    <?php } ?>
</body>

</html>