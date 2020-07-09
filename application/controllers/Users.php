<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        clear_cache();
        $this->user =	unserialize($this->session->userdata('users'));
        $this->load->model('user_model','um');
        $this->load->model('common_model','com');
    }
        
	public function index(){
        if(!empty($this->user)){
            redirect("users/group_admin_list");
        }else{
        	redirect($this->user->default_landing);
        }
	}

	public function group_admin_list($offset = 0){
		$this->com->checkUserSession();
		if($this->user->role_id>=2){
			$this->session->set_flashdata('msg_error', 'Permission denied!');
			redirect($this->user->default_landing);
		}
		$data['title'] 	= 'Group Admins';
        $per_page 		= ADMIN_PER_PAGE;
        $data['offset']	= $offset;
        $data['userData'] = $this->um->getUsersListByRole($offset, $per_page, 2);
        $config 	= backend_pagination();
        $config['base_url'] 	= base_url() . 'users/group_admin_list/';
        $config['total_rows'] 	= $this->um->getUsersListByRole(0, 0, 2);
        $config['per_page'] 	= $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template']	= 'files/group_admin_list';
	    $this->load->view('templates/frontend_template',$data);
	}

	public function add_group_admin(){
		$this->com->checkUserSession();
		if($this->user->role_id>=2){
			$this->session->set_flashdata('msg_error', 'Permission denied!');
			redirect($this->user->default_landing);
		}
		$password 	= rand(999999,7);
		if($this->input->post('add_group_admin')){
			$password 	= $this->input->post('password');
			if($this->_submit_validate_group_admin()==TRUE){
				$salt 		= $this->salt();
				$password 	= sha1($salt.sha1($salt.sha1($password)));
				$insertData 	= array(
									'role_id'       => 2,
									'parent_id'		=> $this->user->user_id,
									'first_name' 	=> $this->input->post('first_name'),
									'last_name' 	=> $this->input->post('last_name'),
									'email' 		=> $this->input->post('email'),
									'address' 		=> $this->input->post('address'),
									'phone_number' 	=> $this->input->post('phone_number'),
									'password' 		=> $password,
									'created_date' 	=> date('Y-m-d H:i:s'),
									'status' 		=> 1);
	            if($this->com->insert('users',$insertData)){
	                $this->session->set_flashdata('msg_success', 'Group Admin added successfully.');
	            }else{
	                $this->session->set_flashdata('msg_error', 'Group Admin added failed, Please try again.');
	            }
	            redirect('users/group_admin_list');
	        }
		}
     	$data['password'] 	= $password;
		$data['title'] 		= 'Group Admins';
		$data['template']	= 'files/add_edit_group_admin';
	    $this->load->view('templates/frontend_template',$data);
	}

	function _submit_validate_group_admin(){
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
	    $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
	    $this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email|callback_check_email_exist');
	    $this->form_validation->set_rules('phone_number', 'Mobile Number','trim|required');
	    $this->form_validation->set_rules('password', 'password','trim|required');
	    $this->form_validation->set_rules('address', 'Address','trim|required');
	    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');  
	    return $this->form_validation->run();
	}

	public function tenant_admin_list($offset = 0){
		$this->com->checkUserSession();
		if($this->user->role_id>2){
			$this->session->set_flashdata('msg_error', 'Permission denied!');
			redirect($this->user->default_landing);
		}
		$data['title'] 	= 'Tenant Admins';
        $per_page 		= ADMIN_PER_PAGE;
        $data['offset']	= $offset;
        $data['userData'] = $this->um->getUsersListByRole($offset, $per_page, 3);
        $config 	= backend_pagination();
        $config['base_url'] 	= base_url() . 'users/tenant_admin_list/';
        $config['total_rows'] 	= $this->um->getUsersListByRole(0, 0, 2);
        $config['per_page'] 	= $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template']	= 'files/tenant_admin_list';
	    $this->load->view('templates/frontend_template',$data);
	}

	public function add_tenant_admin(){
		$this->com->checkUserSession();
		if($this->user->role_id>2){
			$this->session->set_flashdata('msg_error', 'Permission denied!');
			redirect($this->user->default_landing);
		}
		$parent_id = 0;
		$password 	= rand(999999,7);
		if($this->input->post('add_tenant_admin')){
			if($this->user->role_id == 2){
				$parent_id	= $this->user->user_id;
			}else{
				$parent_id	= $this->input->post('group_admin_id');
			}
			$password 	= $this->input->post('password');
			if($this->_submit_validate_tenant_admin()==TRUE){
				$salt 		= $this->salt();
				$password 	= $this->input->post('password');
				$password 	= sha1($salt.sha1($salt.sha1($password)));
				$insertData 	= array(
									'role_id'       => 3,
									'parent_id'		=> $parent_id,
									'first_name' 	=> $this->input->post('first_name'),
									'last_name' 	=> $this->input->post('last_name'),
									'email' 		=> $this->input->post('email'),
									'address' 		=> $this->input->post('address'),
									'phone_number' 	=> $this->input->post('phone_number'),
									'password' 		=> $password ,
									'buisness_name' => $this->input->post('buisness_name'),
									'created_date' 	=> date('Y-m-d H:i:s'),
									'status' 		=> 1);
	            if($this->com->insert('users',$insertData)){
	                $this->session->set_flashdata('msg_success', 'Tenant Admin added successfully.');
	            }else{
	                $this->session->set_flashdata('msg_error', 'Tenant Admin added failed, Please try again.');
	            }
	            redirect('users/tenant_admin_list');
	        }
		}
		if($this->user->role_id < 2){
     		$data['groupAdminData']	= $this->um->getGroupAdminList();
     		$data['groupAdminId'] = $parent_id;
     	}
     	$data['password'] 	= $password;
		$data['title'] 		= 'Tenant Admins';
		$data['template']	= 'files/add_edit_tenant_admin';
	    $this->load->view('templates/frontend_template',$data);
	}

	function _submit_validate_tenant_admin(){
		if($this->user->role_id != 2){
			$this->form_validation->set_rules('group_admin_id', 'Group Admin','trim|required');
		}	
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
	    $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
	    $this->form_validation->set_rules('buisness_name', 'Buisness Name','trim|required');
	    $this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email|callback_check_email_exist');
	    $this->form_validation->set_rules('phone_number', 'Mobile Number','trim|required');
	    $this->form_validation->set_rules('password', 'password','trim|required');
	    $this->form_validation->set_rules('address', 'Address','trim|required');
	    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');  
	    return $this->form_validation->run();
	}

	public function tenant_user_list($offset = 0){
		$this->com->checkUserSession();
		if($this->user->role_id>3){
			$this->session->set_flashdata('msg_error', 'Permission denied!');
			redirect($this->user->default_landing);
		}
		$data['title'] 	= 'Tenant Users';
        $per_page 		= ADMIN_PER_PAGE;
        $data['offset']	= $offset;
        $data['userData'] = $this->um->getUsersListByRole($offset, $per_page, 4);
        $config 	= backend_pagination();
        $config['base_url'] 	= base_url() . 'users/tenant_user_list/';
        $config['total_rows'] 	= $this->um->getUsersListByRole(0, 0, 2);
        $config['per_page'] 	= $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template']	= 'files/tenant_user_list';
	    $this->load->view('templates/frontend_template',$data);
	}

	public function add_tenant_user(){
		$this->com->checkUserSession();
		if($this->user->role_id>3){
			$this->session->set_flashdata('msg_error', 'Permission denied!');
			redirect($this->user->default_landing);
		}
		$group_parent_id	= 0;
		$parent_id 	= 0;
		$password 	= rand(999999,7);
		if($this->input->post('add_tenant_user')){
			if($this->user->role_id == 3){
				$parent_id	= $this->user->user_id;
			}else{
				$group_parent_id	= $this->input->post('group_admin_id');
				$parent_id	= $this->input->post('tenant_admin_id');
			}
			$password 	= $this->input->post('password');
			if($this->_submit_validate_tenant_user()==TRUE){
				$salt 		= $this->salt();
				$password 	= sha1($salt.sha1($salt.sha1($password)));
				$insertData 	= array(
									'role_id'       => 4,
									'parent_id'		=> $parent_id,
									'first_name' 	=> $this->input->post('first_name'),
									'last_name' 	=> $this->input->post('last_name'),
									'email' 		=> $this->input->post('email'),
									'address' 		=> $this->input->post('address'),
									'buisness_name' => $this->input->post('buisness_name'),
									'phone_number' 	=> $this->input->post('phone_number'),
									'password' 		=> $password,
									'created_date' => date('Y-m-d H:i:s'),
									'status' => 1);
	            if($this->com->insert('users',$insertData)){
	                $this->session->set_flashdata('msg_success', 'Tenant User added successfully.');
	            }else{
	                $this->session->set_flashdata('msg_error', 'Tenant User added failed, Please try again.');
	            }
	            redirect('users/tenant_user_list');
	        }
		}
     	if($this->user->role_id < 2){
     		$data['groupAdminData']	= $this->um->getGroupAdminList();
     		$data['tenantAdminData']	= $this->um->getTenantAdminList($group_parent_id);
     	}else if($this->user->role_id == 2){
     		$data['tenantAdminData']	= $this->um->getTenantAdminList($this->user->user_id);
     	}
     	$data['password'] 	= $password;
     	$data['groupAdminId'] = $group_parent_id;
     	$data['tenantAdminId'] = $parent_id;
		$data['title'] 		= 'Tenant Users';
		$data['template']	= 'files/add_edit_tenant_user';
	    $this->load->view('templates/frontend_template',$data);
	}

	function _submit_validate_tenant_user(){
		if($this->user->role_id < 2){
			$this->form_validation->set_rules('group_admin_id', 'Group Admin','trim|required');
			$this->form_validation->set_rules('tenant_admin_id', 'Tenant Admin','trim|required');
		}else if($this->user->role_id == 2){
			$this->form_validation->set_rules('tenant_admin_id', 'Tenant Admin','trim|required');	
		}
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
	    $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
	    $this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email|callback_check_email_exist');
	    $this->form_validation->set_rules('buisness_name', 'Buisness Name','trim|required');
	    $this->form_validation->set_rules('phone_number', 'Mobile Number','trim|required');
	    $this->form_validation->set_rules('password', 'password','trim|required');
	    $this->form_validation->set_rules('address', 'Address','trim|required');
	    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');  
	    return $this->form_validation->run();
	}

	function get_tenant_users(){
		$id = $this->input->post('id');
		$result = array('status'=>0,'data'=>array());
		if($id!=''){
			$data	= $this->um->getTenantAdminList($id);
			if(!empty($data)){
				$result = array('status'=>1,'data'=>$data);
			}
		}
		echo json_encode($result);
	}
        
    function check_profile_img($str){
		if(empty($_FILES['profile_image']['name'])){
		    $this->form_validation->set_message('check_profile_img', 'Choose Profile Image');
		    return FALSE;
		}
		$image = getimagesize($_FILES['profile_image']['tmp_name']);

		if ($image[0] < 100 && $image[1] < 100) {
		    $this->form_validation->set_message('check_profile_img', 'Oops! Your Profile image needs to be atleast 100 x 100 pixels.');
		    return FALSE;
		}
		   if ($image[0] > 1000 || $image[1] > 1000) {
		       $this->form_validation->set_message('check_profile_img', 'Oops! Your Profile image needs to be maximum of 1000 x 1000 pixels.');
		       return FALSE;
		   }
		  if(!empty($_FILES['profile_image']['name'])):
		    $config['upload_path'] = './assets/admin/uploads/users/original/';
		    $config['allowed_types'] = 'jpeg|jpg|png';
		    $config['max_size']  = '1024';
		    $config['max_width']  = '1024';
		    $config['max_height']  = '1024';
		    $config['file_name']  = date('YmdHis');
		    $this->load->library('upload', $config);
		    if (!$this->upload->do_upload('profile_image')){
		        $this->form_validation->set_message('check_profile_img', $this->upload->display_errors());
		        return FALSE;
		    }else{
		        $data = $this->upload->data(); // upload image
		        $config_img_p['source_path'] = './assets/admin/uploads/users/original/';

		        /*  29 x 29 */
		        $config_img_p1['source_path'] = './assets/admin/uploads/users/original/';
		        $config_img_p1['destination_path'] = './assets/admin/uploads/users/29x29/';
		        $config_img_p1['width']  = '29';
		        $config_img_p1['height']  = '29';
		        $config_img_p1['file_name'] =$data['file_name'];
		        $status=create_thumbnail($config_img_p1);
		        /*  29 x 29 */

		        /*  150 x 150 */
		        $config_img_p2['source_path'] = './assets/admin/uploads/users/original/';
		        $config_img_p2['destination_path'] = './assets/admin/uploads/users/150x150/';
		        $config_img_p2['width']  = '150';
		        $config_img_p2['height']  = '150';
		        $config_img_p2['file_name'] =$data['file_name'];
		        $status=create_thumbnail($config_img_p2);
		        /*  150 x 150 */

		        $this->session->set_userdata('check_profile_img',array('image_url'=>$config['upload_path'].$data['file_name'],
		             'profile_image'=>$data['file_name']));

		        return TRUE;
		    }
		    else:
		        $this->form_validation->set_message('check_profile_img', 'The %s field required.');
		        return FALSE;
		    endif;
		  }

	private function salt(){
   		return substr(md5(uniqid(rand(), true)), 0, 10);
 	}

	function check_email_exist($str){
        $user_id = $this->user->user_id; 
        $check=$this->com->get_row('users',array('email'=>$str),'','');
        if($check){
            $this->form_validation->set_message('check_email_exist',"The Email field must contain a unique value.");
            return FALSE; 
        }else{
            return TRUE;
        }
    }

    function chat(){
    	$data['title'] 		= 'Tenant Admins';
		$data['template']	= 'files/chat_views';
	    $this->load->view('templates/frontend_template',$data);
    }
}
