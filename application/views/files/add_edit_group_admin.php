	<div class="page-content-wrapper">
		<div class="page-content">				
			<!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Group Admins</span>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Add Group Admin
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
		
            <div class="row">
           		<div class="col-md-12 ">
                 
                 
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet light portlet-fit portlet-form bordered ">
						<div class="portlet-body">
							<form role="form" action="" method="post" class="form-horizontal form-row-seperated">
                                                <div class="form-body">
                                                    <div class="form-group <?php if(form_error('first_name')!=''){ echo 'has-error'; }; ?>" >
                                                        <label class="control-label col-md-3">First Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="John" class="form-control" name="first_name" value="<?php echo set_value('first_name'); ?>" />
                                                            <?php echo form_error('first_name'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('last_name')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Last Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Doe" class="form-control" name="last_name" value="<?php echo set_value('last_name'); ?>" /> 
                                                            <?php echo form_error('last_name'); ?>
                                                        </div>
                                                    </div>
                                               		
                                                    <div class="form-group <?php if(form_error('email')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Email Address</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="test@test.com" class="form-control" name="email" value="<?php echo set_value('email'); ?>" /> 
                                                            <?php echo form_error('email'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('password')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Password</label>
                                                        <div class="col-md-9">
                                                            <input type="password" placeholder="Password" class="form-control" name="password" value="<?php echo set_value('password',$password); ?>" /> 
                                                            <?php echo form_error('password'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group <?php if(form_error('phone_number')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Mobile Number</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="mask_phone" placeholder="(999) 999-9999" class="form-control" name="phone_number" value="<?php echo set_value('phone_number'); ?>" /> 
                                                            <span class="help-block"> (999) 999-9999 </span>
                                                            <?php if(form_error('phone_number')!=''){ echo '<br/>'; echo form_error('phone_number'); } ?>

                                                        </div>
                                                    </div>
                                                 
                                                    
                                                    <div class="form-group <?php if(form_error('address')!=''){ echo 'has-error'; }; ?>">
                                                        <label class="control-label col-md-3">Address</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" rows="3" placeholder="Address" name="address"><?php echo set_value('address'); ?></textarea>
                                                            <?php echo form_error('address'); ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <input type="submit" name="add_group_admin" value=" Add Group Admin " class="btn green" />
                                                                <a href="<?php echo site_url("users/group_admin_list"); ?>" class="btn default"> Cancel </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                                </div>
                                            </form>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
	       </div>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER-->


 