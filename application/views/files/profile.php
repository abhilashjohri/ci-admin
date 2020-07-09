<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo site_url(); ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>User</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> User Profile
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <?php msg_alert(); ?>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">

                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="<?php if($this->user->profile_image!=''){ echo site_url('assets/admin/uploads/users/150x150/'.$this->user->profile_image); }else{ echo BACKEND.'/images/no_image150x150.png'; } ?>" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> <?php echo $userData->first_name.' '.$userData->last_name; ?> </div>
                            <?php if($userData->role_id>1){ ?>
                              <!--  <div class="profile-usertitle-job"> <?php echo $userData->role_name; ?> </div> -->
                            <?php } ?>
                        </div>
                        <div class="profile-userbuttons">
                         <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group profile-pic-input">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <span class="btn btn-file">
                                            <input type="file" name="profile_image"> </span>
                                            <?php if(form_error('profile_image')!=''){  echo form_error('profile_image'); } ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="margin-top-10 margin-bottom-10">
                                <input type="submit" name="profile_image" value=" <?php if($this->user->profile_image!=''){ echo 'Change'; }else{ echo 'Add'; } ?> " class="btn btn-circle green btn-sm" />
                                <?php if($this->user->profile_image!=''){ ?>
                                <a href="<?php echo site_url('admin/delete_profile_pic'); ?>" class="btn btn-circle red btn-sm fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                <?php } ?>
                            </div>
                        </form>
                        </div>
                        <?php if($userData->role_id>1){ ?>
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li >
                                        <a >
                                            <i class="fa fa-user"></i> <?php echo $userData->parent_name; ?> </a>
                                    </li>
                                    <li>
                                        <a >
                                            <i class="fa fa-envelope"></i> <?php echo $userData->parent_email; ?> </a>
                                    </li>
                                    <li>
                                        <a >
                                            <i class="fa fa-phone"></i> <?php echo $userData->parent_phone; ?> </a>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>


                        <!-- END SIDEBAR USER TITLE -->
                       
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    
                    
                    <div class="row">
                        <div class="col-md-12">

                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li <?php if($activeTab == 1){ echo 'class="active"'; } ?> >
                                            <a href="<?php echo site_url('admin/profile/1'); ?>" >Personal Info</a>
                                        </li>
                                       <!-- <li <?php if($activeTab == 2){ echo 'class="active"'; } ?>>
                                            <a href="<?php echo site_url('admin/profile/2'); ?>" >Change Avatar</a>
                                        </li> -->
                                        <li <?php if($activeTab == 2){ echo 'class="active"'; } ?>>
                                            <a href="<?php echo site_url('admin/profile/2'); ?>" >Change Password</a>
                                        </li>
                                        <li <?php if($activeTab == 3){ echo 'class="active"'; } ?>>
                                            <a href="<?php echo site_url('admin/profile/3'); ?>" >Privacy Settings</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane <?php if($activeTab == 1){ echo 'active'; } ?>" id="tab_1_1">
                                            <form role="form" action="" method="post" class="form-horizontal form-row-seperated">
                                                <div class="form-body">
                                                    <div class="form-group <?php if(form_error('first_name')!=''){ echo 'has-error'; }; ?>" >
                                                        <label class="control-label col-md-3">First Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="John" class="form-control" name="first_name" value="<?php echo set_value('first_name',$userData->first_name); ?>" />
                                                            <?php echo form_error('first_name'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('last_name')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Last Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Doe" class="form-control" name="last_name" value="<?php echo set_value('last_name',$userData->last_name); ?>" /> 
                                                            <?php echo form_error('last_name'); ?>
                                                        </div>
                                                    </div>

                                                    <?php if($this->user->role_id > 2){ ?>
                                                    <div class="form-group <?php if(form_error('buisness_name')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Buisness Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Buisness Name" class="form-control" name="buisness_name" value="<?php echo set_value('buisness_name',$userData->buisness_name); ?>" /> 
                                                            <?php echo form_error('buisness_name'); ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <div class="form-group <?php if(form_error('email')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Email Address</label>
                                                        <div class="col-md-9">
                                                            <input readonly type="text" placeholder="test@test.com" class="form-control" name="email" value="<?php echo set_value('email',$userData->email); ?>" /> 
                                                            <?php echo form_error('email'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('phone_number')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Mobile Number</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="mask_phone" placeholder="(999) 999-9999" class="form-control" name="phone_number" value="<?php echo set_value('phone_number',$userData->phone_number); ?>" /> 
                                                             <span class="help-block"> (999) 999-9999 </span><br/>
                                                            <?php echo form_error('phone_number'); ?>
                                                        </div>
                                                    </div>
                                                 
                                                  <!--  <div class="form-group <?php if(form_error('preference')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Default Preference</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Default Preference" class="form-control" name="preference" value="<?php echo set_value('preference',$userData->default_preferences); ?>" /> 
                                                            <?php echo form_error('default_preferences'); ?>
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group <?php if(form_error('address')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Address</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" rows="3" placeholder="Address" name="address"><?php echo set_value('address',$userData->address); ?></textarea>
                                                            <?php echo form_error('address'); ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <input type="submit" name="profile_info" value=" Save Changes " class="btn green" />
                                                                <a href="<?php echo site_url("admin/profile"); ?>" class="btn default"> Cancel </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE AVATAR TAB -->
                                    <!--    <div class="tab-pane <?php if($activeTab == 2){ echo 'active'; } ?>" id="tab_1_2">
                                            <?php if(form_error('profile_image')!=''){ ?>
                                             <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button> 
                                                <?php echo form_error('profile_image'); ?> 
                                            </div>
                                            <?php } ?>
                                            <form role="form" action="" method="post" enctype="multipart/form-data">
                                                <div class="form-group profile-pic-input">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        
                                                            <?php if($userData->profile_image!=''){ ?>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                                                                <img src="<?php echo site_url('assets/admin/uploads/users/original/'.$userData->profile_image); ?>" alt="" />
                                                            </div>
                                                            <?php }else{ ?>
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="<?php echo BACKEND.'/images/no_image200x150.png'; ?>" alt="" />
                                                            </div>
                                                            <?php } ?> 
                                                        
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="profile_image"> </span>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="margin-top-10">
                                                    <input type="submit" name="profile_image" value=" Save " class="btn green" />
                                                    <a href="<?php echo site_url('admin/delete_profile_pic'); ?>" class="btn green fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    <a href="<?php echo site_url("admin/profile"); ?>" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div> -->
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane <?php if($activeTab == 2){ echo 'active'; } ?>" id="tab_1_3">
                                            <form action="" method="post" class="form-horizontal form-row-seperated">
                                                <div class="form-body">
                                                    <div class="form-group <?php if(form_error('old_password')!=''){ echo "has-error"; } ?>">
                                                        <label class="control-label col-md-3">Current Password</label>
                                                        <div class="col-md-9">
                                                        <input type="password" class="form-control" name="old_password" value="<?php echo set_value('old_password'); ?>" />
                                                        <?php echo form_error('old_password'); ?> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('new_password')!=''){ echo "has-error"; } ?>">
                                                        <label class="control-label col-md-3">New Password</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control" name="new_password" value="<?php echo set_value('new_password'); ?>" />
                                                            <?php echo form_error('new_password'); ?> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('confirm_password')!=''){ echo "has-error"; } ?>" >
                                                        <label class="control-label col-md-3">Confirm Password</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>" />
                                                            <?php echo form_error('confirm_password'); ?> 
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <input type="submit" name="changed_password" value=" Update " class="btn green" />
                                                                <a href="<?php echo site_url("admin/profile"); ?>" class="btn default"> Cancel </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- PRIVACY SETTINGS TAB -->
                                        <div class="tab-pane <?php if($activeTab == 3){ echo 'active'; } ?>" id="tab_1_4">
                                            <form action="" method="post">
                                                <table class="table table-light table-hover">
                                                    <tr>
                                                        <td> Theme ? </td>
                                                        <td>
                                                            <div class="mt-radio-inline">
                                                                <label class="mt-radio">
                                                                    <input type="radio" name="theme" value="1" <?php if($userData->theme == 1){ echo 'checked'; } ?> /> Dark
                                                                    <span></span>
                                                                </label>
                                                                <label class="mt-radio">
                                                                    <input type="radio" name="theme" value="2" <?php if($userData->theme == 2){ echo 'checked'; } ?> /> Light
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Email Alerts Enable/Disable ? </td>
                                                        <td>
                                                            <div class="mt-checkbox-inline">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" name="is_email_alerts"  <?php if($userData->is_email_alerts == 1){ echo 'checked'; } ?> value="1" >
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> SMS Alerts Enable/Disable ? </td>
                                                        <td>
                                                            <div class="mt-checkbox-inline">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" name="is_sms_alerts" <?php if($userData->is_sms_alerts == 1){ echo 'checked'; } ?> value="1" >
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Chat Alerts Enable/Disable ? </td>
                                                        <td>
                                                            <div class="mt-checkbox-inline">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" name="is_chat_alerts" <?php if($userData->is_chat_alerts == 1){ echo 'checked'; } ?> value="1" >
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Email Notifications Enable/Disable ? </td>
                                                        <td>
                                                            <div class="mt-checkbox-inline">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" name="is_email_notification" <?php if($userData->is_email_notification == 1){ echo 'checked'; } ?> value="1" >
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> SMS Notifications Enable/Disable ? </td>
                                                        <td>
                                                            <div class="mt-checkbox-inline">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" name="is_sms_notification" <?php if($userData->is_sms_notification == 1){ echo 'checked'; } ?> value="1" >
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Chat Notifications Enable/Disable ? </td>
                                                        <td>
                                                            <div class="mt-checkbox-inline">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" name="is_chat_notification" <?php if($userData->is_chat_notification == 1){ echo 'checked'; } ?> value="1" >
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!--end profile-settings-->
                                                <div class="margin-top-10">
                                                    <input type="submit" name="account_settings" value=" Save Changes " class="btn green" />
                                                    <a href="<?php echo site_url("admin/profile"); ?>" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->