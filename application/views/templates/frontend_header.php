<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo SITE_NAME?> | <?php if($title){ echo $title; } ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php if($this->uri->segment(2) == "profile"){ ?>
            <link href="<?php echo BACKEND ?>pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <?php } ?>
        <?php if($this->uri->segment(2) == "chat"){ ?>
         <link href="<?php echo BACKEND ?>apps/css/inbox.min.css" rel="stylesheet" type="text/css" />
         <?php } ?>
        <link href="<?php echo BACKEND ?>/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo BACKEND ?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo BACKEND ?>/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo BACKEND ?>/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" id="style_color"  />
        <?php if($this->user->theme == 2){ ?>
            <link href="<?php echo BACKEND ?>/layouts/layout/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <?php }else{ ?>
           <link href="<?php echo BACKEND ?>/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" /> 
       <?php } ?>
        
        <link href="<?php echo BACKEND ?>/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-container-bg-solid">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?php echo site_url(); ?>">
                            <img src="<?php echo BACKEND ?>/layouts/layout/img/logo_new.png" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?php if($this->user->profile_image!=''){ echo site_url('assets/admin/uploads/users/29x29/'.$this->user->profile_image); }else{ echo BACKEND.'/images/no_image29x29.png'; } ?>" />
                                    <span class="username username-hide-on-mobile"> <?php echo $this->user->name; ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo site_url('admin/profile'); ?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('admin/logout'); ?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">

<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
               
        <li class="nav-item start <?php if($this->uri->segment(2) == "dashboard"){ echo "active open"; } ?>">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link ">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
            </a>
        </li>
        <?php if($this->user->role_id<2){ ?>  
        <li class="nav-item start <?php if($this->uri->segment(1) == "users" && ($this->uri->segment(2) == "group_admin_list" || $this->uri->segment(2) == "add_group_admin")){ echo "active open"; } ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">Group Admins</span>
                <span class="selected"></span>
                <span class="arrow <?php if($this->uri->segment(1) == "users" && ($this->uri->segment(2) == "group_admin_list" || $this->uri->segment(2) == "add_group_admin")){ echo 'open';  } ?>"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "group_admin_list"){ echo "active open"; } ?>">
                    <a href="<?php echo site_url('users/group_admin_list'); ?>" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">Group Admin List</span>
                    </a>
                </li>
                <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "add_group_admin"){ echo "active open"; } ?>">
                    <a href="<?php echo site_url('users/add_group_admin'); ?>" class="nav-link ">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">Add Group Admin</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>

        <?php if($this->user->role_id <= 2){ ?> 
         <li class="nav-item start <?php if($this->uri->segment(1) == "users" && ($this->uri->segment(2) == "tenant_admin_list" || $this->uri->segment(2) == "add_tenant_admin")){ echo "active open"; } ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">Tenant Admins</span>
                <span class="selected"></span>
                <span class="arrow <?php if($this->uri->segment(1) == "users" && ($this->uri->segment(2) == "tenant_admin_list" || $this->uri->segment(2) == "add_tenant_admin")){ echo 'open';  } ?>"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "tenant_admin_list"){ echo "active open"; } ?>">
                    <a href="<?php echo site_url('users/tenant_admin_list'); ?>" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">Tenant Admin List</span>
                    </a>
                </li>
                <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "add_tenant_admin"){ echo "active open"; } ?>">
                    <a href="<?php echo site_url('users/add_tenant_admin'); ?>" class="nav-link ">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">Add Tenant Admin</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>

        <?php if($this->user->role_id <= 3){ ?> 
         <li class="nav-item start <?php if($this->uri->segment(1) == "users" && ($this->uri->segment(2) == "tenant_user_list" || $this->uri->segment(2) == "add_tenant_user")){ echo "active open"; } ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">Tenant Users</span>
                <span class="selected"></span>
                <span class="arrow <?php if($this->uri->segment(1) == "users" && ($this->uri->segment(2) == "tenant_user_list" || $this->uri->segment(2) == "add_tenant_user")){ echo 'open';  } ?>"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "tenant_user_list"){ echo "active open"; } ?>">
                    <a href="<?php echo site_url('users/tenant_user_list'); ?>" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">Tenant User List</span>
                    </a>
                </li>
                <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "add_tenant_user"){ echo "active open"; } ?>">
                    <a href="<?php echo site_url('users/add_tenant_user'); ?>" class="nav-link ">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">Add Tenant User</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>
         <li class="nav-item start <?php if($this->uri->segment(1) == "users" && $this->uri->segment(2) == "chat"){ echo "active open"; } ?>">
            <a href="<?php echo site_url('users/chat'); ?>" class="nav-link ">
                <i class="fa fa-list"></i>
                <span class="title">chat</span>
            </a>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->




