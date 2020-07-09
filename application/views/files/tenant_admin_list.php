                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
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
                                    <span>Tenant Admins</span>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Tenant Admin List
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <div class="table-scrollable table-scrollable-borderless">
                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> User Id </th>
                                                        <th> Name </th>
                                                        <th> Email </th>
                                                        <th> Phone </th>
                                                        <th> Admin </th>
                                                        <th> Created On </th>
                                                        <th> Status </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php   if(count($userData)>0){ 
                                                                $j = $offset+1;
                                                                for($i=0;$i<count($userData);$i++){ ?>
                                                                    <tr>
                                                                        <td> <?php echo $j++; ?> </td>
                                                                        <td> <?php echo $userData[$i]->user_id; ?> </td>
                                                                        <td> <?php echo $userData[$i]->name; ?> </td>
                                                                        <td> <?php echo $userData[$i]->email; ?> </td>
                                                                        <td> <?php echo $userData[$i]->phone_number; ?> </td>
                                                                        <td> <?php echo $userData[$i]->parent_name; ?> </td>
                                                                        <td> <?php echo date('d M Y',strtotime($userData[$i]->created_date)); ?> </td>
                                                                        <td>
                                                                            <?php if($userData[$i]->status == 1){ ?>
                                                                            <span class="label label-sm label-success"> Actice </span>
                                                                            <?php }else{ ?>
                                                                            <span class="label label-sm label-danger"> Inactive </span>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <th> Action </th>
                                                                    </tr>
                                                    <?php       }
                                                            }else{ ?>
                                                                <tr>
                                                                    <td colspan="9" align="center"> No Records Found! </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="9" align="center"> <a href="<?php echo site_url("users/add_tenant_admin"); ?>" class="btn green"> Add New Tenant Admin </a>
                                                                    </td>
                                                                </tr>   

                                                    <?php   } ?>
                                                    
                                                   
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <?php if (!empty($pagination)) echo $pagination; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SAMPLE TABLE PORTLET-->
                            </div>
                            
                        </div>
                        
       
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
          
           
