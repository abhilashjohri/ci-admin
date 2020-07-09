</div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"> <?php echo date('Y'); ?> &copy; <?php echo SITE_NAME?>
                   
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        <!--[if lt IE 9]>
        <script src="<?php echo BACKEND ?>/global/plugins/respond.min.js"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/excanvas.min.js"></script> 
        <script src="<?php echo BACKEND ?>/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo BACKEND ?>/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo BACKEND ?>/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
         <script src="<?php echo BACKEND ?>/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo BACKEND ?>/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
         <?php if($this->uri->segment(2) == "profile"){ ?>
        <script src="<?php echo BACKEND ?>/pages/scripts/profile.min.js" type="text/javascript"></script>
        <?php }elseif($this->uri->segment(2) == "chat"){ ?>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo BACKEND ?>/apps/scripts/inbox.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
       
        <?php }{ ?>
        <script src="<?php echo BACKEND ?>/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <?php } ?>
        <script src="<?php echo BACKEND ?>/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo BACKEND ?>/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo BACKEND ?>/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
         <script type="text/javascript">
         var baseurl = '<?php echo site_url(); ?>';
         </script>
         <script src="<?php echo BACKEND ?>/js/custom.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>