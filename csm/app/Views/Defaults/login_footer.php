
    
    <!-- All Jquery -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/jquery/jquery.min.js"></script>

    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo ASSETS ?>/assets/node_modules/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo ASSETS ?>/js/perfect-scrollbar.jquery.min.js"></script>

    <!--Wave Effects -->
    <script src="<?php echo ASSETS ?>/js/waves.js"></script>

    <!--Custom JavaScript -->
    <script src="<?php echo ASSETS ?>/js/custom.min.js"></script>
    
    <!-- This page plugins -->

    <!--morris JavaScript -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/raphael/raphael-min.js"></script>
    <script src="<?php echo ASSETS ?>/assets/node_modules/morrisjs/morris.min.js"></script>

    <!--c3 JavaScript -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/d3/d3.min.js"></script>
    <script src="<?php echo ASSETS ?>/assets/node_modules/c3-master/c3.min.js"></script>
    <script src="<?php echo ASSETS ?>/assets/node_modules/chartist-js/dist/chartist.min.js"></script>
    <script src="<?php echo ASSETS ?>/assets/node_modules/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Chart JS -->
    <script src="<?php echo ASSETS ?>/js/dashboard1.js"></script>

    <!-- Style Switcher -->
    <script src="<?php echo ASSETS ?>/assets/node_modules/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- jQuery CDN -->
    <script src="<?php echo ASSETS ?>/jquery-3.5.1.js"></script>

    <!-- Bootstrap 4.5 CDN  -->
    <script src="<?php echo ASSETS ?>/js/bootstrap.bundle.min.js"></script>

    <!-- DataTable CDN js -->
    <script src="<?php echo ASSETS ?>/js/jquery.dataTables.min.js"></script>
    
    <!-- Page Specific Script -->
    <?php if(isset($js_scripts)){ ?>
        <?php foreach ($js_scripts as $js_script) { ?>
            <script type="text/javascript" src="<?php echo ASSETS.$js_script ?>"></script>
        <?php } ?>
    <?php } ?>
    
</body>

</html>