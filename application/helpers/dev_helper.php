<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	clear cache
*/
if ( ! function_exists('clear_cache')) {
	function clear_cache(){
		$CI =& get_instance();
		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
		$CI->output->set_header("Pragma: no-cache");			
	}
}
/**
* reset user session
*/
if ( ! function_exists('reset_user_session')) {
	function reset_user_session(){
		$CI =& get_instance();
		$user = unserialize($CI->session->userdata('users'));
		
		$userDetails 	= $CI->user_model->getUserProfileData($user->user_id);
		if(!empty($userDetails)){
			$CI->session->unset_userdata('users');
			$userData  = new stdClass();
			$userData->user_id   = $userDetails->user_id;
			$userData->email     = $userDetails->email;
			$userData->name      = trim($userDetails->first_name.' '.$userDetails->last_name);
			$userData->role_id   = $userDetails->role_id;
            $userData->role_code = $userDetails->role_code;
           	$userData->default_landing = $userDetails->default_landing_page;
            $userData->tasks = $userDetails->tasks;
            $userData->theme   = $userDetails->theme;
            $userData->last_login_date   = $userDetails->last_login_date;
            $userData->profile_image = $userDetails->profile_image;
			$CI->session->set_userdata('users',serialize($userData));
			return true;
		}else
			return false;
		
	}
}
/**
*	get superadmin id
*/
if ( ! function_exists('superadmin_id')) {
	function superadmin_id(){
		$CI =& get_instance();
		$superadmin_info = $CI->session->userdata('superadmin_info');		
			return $superadmin_info['id'];		
	}
}
/**
*	superadmin login information
*/
if ( ! function_exists('superadmin_name')) { 
	function superadmin_name(){
		$CI =& get_instance();
		$superadmin_info = $CI->session->userdata('superadmin_info');
		if($superadmin_info['logged_in']===TRUE )
		 	return $superadmin_info['first_name']." ".$superadmin_info['last_name'];
		else
			return FALSE;
	}					
}

if ( ! function_exists('backend_pagination')) {
	function backend_pagination(){
		$data = array();		
		$data['full_tag_open'] = '<ul class="pagination">';		
		$data['full_tag_close'] = '</ul>';
		$data['first_tag_open'] = '<li>';
		$data['first_tag_close'] = '</li>';
		$data['num_tag_open'] = '<li>';
		$data['num_tag_close'] = '</li>';
		$data['last_tag_open'] = '<li>';
		$data['last_tag_close'] = '</li>';
		$data['next_tag_open'] = '<li>';
		$data['next_tag_close'] = '</li>';
		$data['prev_tag_open'] = '<li>';
		$data['prev_tag_close'] = '</li>';
		$data['cur_tag_open'] = '<li class="active"><a href="#">';
		$data['cur_tag_close'] = '</a></li>';
		return $data;
	}					
}
/**
*	frontend pagination
*/
if ( ! function_exists('frontend_pagination')) {
	function frontend_pagination(){
		$data = array();
		$data['full_tag_open'] = '<ul class="pagination">';		
		$data['full_tag_close'] = '</ul>';
		$data['first_tag_open'] = '<li>';
		$data['first_tag_close'] = '</li>';
		$data['num_tag_open'] = '<li>';
		$data['num_tag_close'] = '</li>';
		$data['last_tag_open'] = '<li>';		
		$data['last_tag_close'] = '</li>';
		$data['next_tag_open'] = '<li>';
		$data['next_tag_close'] = '</li>';
		$data['prev_tag_open'] = '<li>';
		$data['prev_tag_close'] = '</li>';
		$data['cur_tag_open'] = '<li class="active"><a href="#">';
		$data['cur_tag_close'] = '</a></li>';
		$data['next_link'] = 'Next';
		$data['prev_link'] = 'Previous';
		return $data;
	}					
}

/**
*	thisis  back end helper 
*/
if ( ! function_exists('msg_alert')) {
	function msg_alert(){
	$CI =& get_instance(); ?>
<?php if($CI->session->flashdata('msg_success')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <strong>Success :</strong> <?php echo $CI->session->flashdata('msg_success'); ?>
	</div>
 <?php endif; ?>
<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <strong>Info :</strong> <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	     <strong>Warning :</strong> <?php echo $CI->session->flashdata('msg_warning'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	     <strong>Error :</strong> <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>
	<?php }					
}
/**
*	thisis  back end helper 
*/
if ( ! function_exists('msg_alert_front')) {
	function msg_alert_front(){
	$CI =& get_instance(); ?>
	<?php if($CI->session->flashdata('theme_danger')): ?>	
	<div class="alert theme-alert-danger">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('theme_danger'); ?>
	</div>
 <?php endif; ?> thumbnail
 <?php if($CI->session->flashdata('theme_success')): ?>	
	<div class="alert theme-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('theme_success'); ?>
	</div>
 <?php endif; ?>

<?php if($CI->session->flashdata('msg_success')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('msg_success'); ?>
	</div>
 <?php endif; ?>
<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <!-- <strong>Info :</strong> <br> --> <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
	   <!--  <strong>Warning :</strong> <br> --> <?php echo $CI->session->flashdata('msg_warning'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <!-- <strong>Error :</strong> <br> --> <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>
	<?php }					
}
/**
*	Menu Information
*/
if ( ! function_exists('upload_file')) {
	function upload_file($param = null){
		$CI =& get_instance();		
		
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|jpeg|pdf|doc|docx';
		$config['max_size']	= 1024*90;
		$config['image_resize']= FALSE;
		$config['resize_width']= 126;
		$config['resize_height']= 126;
		
		if ($param){
            $config = $param + $config;
        }
		$CI->load->library('upload', $config);
		if(!empty( $config['file_name']))
			$file_Status = $CI->upload->do_upload($config['file_name']);
		else
			$file_Status = $CI->upload->do_upload();
		if (!$file_Status){
			return array('STATUS'=>FALSE,'FILE_ERROR' => $CI->upload->display_errors());			
		}else{
			$uplaod_data=$CI->upload->data();
	
			$upload_file = explode('.', $uplaod_data['file_name']);
			
			if($config['image_resize'] && in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
				$param2=array(
					'source_image' 	=>	$config['source_image'].$uplaod_data['file_name'],
					'new_image' 	=>	$config['new_image'].$uplaod_data['file_name'],
					'create_thumb' 	=>	FALSE,
					'maintain_ratio'=>	FALSE,
					'width' 		=>	$config['resize_width'],
					'height' 		=>	$config['resize_height'],
					);
			
				image_resize($param2);
			}	
			return array('STATUS'=>TRUE,'UPLOAD_DATA' =>$uplaod_data );
		}
	}
}
/**
*	image resize
*/
if ( ! function_exists('image_resize')) {
	function image_resize($param = null){
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image']	= './assets/uploads/';
		$config['new_image']	= './assets/uploads/';		
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	 = 150;
		$config['height']	= 150;
		
		 if ($param) {
            $config = $param + $config;
        }
		$CI->load->library('image_lib', $config); 
		if ( ! $CI->image_lib->resize())
		{
		   //return array('STATUS'=>TRUE,'MESSAGE'=>$CI->image_lib->display_errors()); 
			die($CI->image_lib->display_errors());
		}else{
			 return array('STATUS'=>TRUE,'MESSAGE'=>'Image resized.'); 
		}
	}
}

/**
*	Menu Information
*/
if ( ! function_exists('get_nav_menu')) {
	function get_nav_menu($slug='',$is_location=FALSE){
		$CI =& get_instance();
		//$CI->load->model('user_model');		
		if($menu =$CI->common_model->get_nav_menu($slug,$is_location))
			return $menu;
		else
			return FALSE;
	}					
}
/**
*	Get YouTube video ID from URL
*/
if ( ! function_exists('get_youtube_id_from_url')) {
	function get_youtube_thumbnail($youtube_url='',$alt=TRUE){
			$youtubeId = preg_replace('/^[^v]+v.(.{11}).*/', '$1', $youtube_url); 
		
		if($alt) $alt='alt="AA'.$youtubeId.'"'; else $alt='';
		return'<img style="border-radius: 0px !important; transition: none 0s ease 0s;" class="timeline-img pull-left imgsize" src="http://img.youtube.com/vi/'.$youtubeId.'/default.jpg" '.$alt.'>';
				
	}					
}
//for option
if ( ! function_exists('get_option_value')) {
	function get_option_value($key=FALSE){	
		$CI =& get_instance();		
		if($option = $CI->getoption->get_option_value($key))		
			return $option;
		else
			return FALSE;	
	}
}
if ( ! function_exists('file_download')) {
	function file_download($title=FALSE,$data=FALSE){
		$data=str_replace('./', '', $data);		
		$CI =& get_instance();		
		$CI->load->helper('download');
		if(!empty($title) && !empty($data)):
			$title=url_title($title, '-', TRUE);
			if($file = file_get_contents($data)){ 		
			$extend=end(explode('.',$data));			 
			$file_name = $title.'.'.$extend;			
			force_download($file_name, $file);
		}else{
			return FALSE;
		}
		endif;	
	}
}
if ( ! function_exists('get_post')) {
	function get_post($slug='',$is_slug=FALSE){
		$CI =& get_instance();	
		if(!empty($slug))				
			return $CI->common_model->get_post($slug,$is_slug);
		else
			return FALSE;
	}					
}


/**
*	thumbnail image
*/
if ( ! function_exists('create_thumbnail')) {
	function create_thumbnail($config_img='',$img_fix='') {
		$CI =& get_instance();
		$config_image['image_library'] = 'gd2';
		$config_image['source_image'] = $config_img['source_path'].$config_img['file_name'];	
		//$config_image['create_thumb'] = TRUE;
		$config_image['new_image'] = $config_img['destination_path'].$config_img['file_name'];
		$config_image['height']=$config_img['height'];
		$config_image['width']=$config_img['width'];
		if($img_fix){
		$config_image['maintain_ratio'] = FALSE;
		}
		else{
			$config_image['maintain_ratio'] = TRUE;
			list($width, $height, $type, $attr) = getimagesize($config_img['source_path'].$config_img['file_name']);

	        if ($width < $height) {
	        	$cal=$width/$height;
	        	$config_image['width']=$config_img['width']*$cal;
	        }
			if ($height < $width)
			{
				$cal=$height/$width;
		    	$config_image['height']=$config_img['height']*$cal;
			}
		}
		
		$CI->load->library('image_lib');
		$CI->image_lib->initialize($config_image);
		
		if(!$CI->image_lib->resize()) 
			return array('status'=>FALSE,'error_msg'=>$CI->image_lib->display_errors());
		else
			return array('status'=>TRUE,'file_name'=>$config_img['file_name']);
	}
}
/*
/**
*	get_social_url
*/
if ( ! function_exists('get_option_url')) {
	function get_option_url($option_name){	
		$CI =& get_instance();		
		 if($query = $CI->common_model->get_row('options',array('option_name'=>$option_name)))
		 	return $query->option_value;
		 else
		 	return false;
	}
}

/*
/**
* delete previous profile image
*/
if ( ! function_exists('delete_profile_image')) {
	function delete_profile_image($prevImage){	
		$CI =& get_instance();		
		if($prevImage!=''){
			unlink('./assets/admin/uploads/users/29x29/'.$prevImage);
			unlink('./assets/admin/uploads/users/150x150/'.$prevImage);
			unlink('./assets/admin/uploads/users/original/'.$prevImage);
			return true;
		}else
		 	return false;
	}
}




