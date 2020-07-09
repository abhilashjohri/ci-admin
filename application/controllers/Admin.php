<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        clear_cache();
        $this->user =	unserialize($this->session->userdata('users'));
        $this->load->model('user_model','um');
        $this->load->model('common_model','com');
    }
        
	public function index(){
		//$salt ='888d8ba176'; 
		//$password ="admin@123";
		// sha1($salt.sha1($salt.sha1($password)));;
        if(!empty($this->user)){
            redirect($this->user->default_landing);
        }
        $vars['title'] = 	'Login';
        $this->load->view('files/login');
	}
        
    public function login(){
        if(empty($this->user)){
            if ($this->_submit_validate() === FALSE) {
                $this->index();
                return;
            }else{
                redirect($this->user->default_landing);
            }
        }else{
                redirect($this->user->default_landing);
        }
        
    }

    public function logout() {
        if($this->session->userdata('users')){
                $this->session->sess_destroy();
                $this->db->close();
        }
        redirect('admin/login');
        die();
	}
        
    private function _submit_validate(){
		$this->form_validation->set_rules('username', 'Username','trim|required|valid_email|callback_authenticate_check');
		$this->form_validation->set_rules('password', 'Password','trim|required');
		$this->form_validation->set_error_delimiters('<span class="help-block has-error">', '</span>');
		return $this->form_validation->run();
	}
	
	function authenticate_check(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username!=''&&$password!=''){
			$userData 	= $this->com->get_row('users',array('email'=>$username,'status'=>1),'','');
			if(!empty($userData)){
				$salt 	=  $userData->salt;
				$password = sha1($salt.sha1($salt.sha1($password)));
				$userData = $this->um->checkAdminLogin($salt,$password);
				if(!empty($userData)){
					$users	  = $userData[0];
					if($users->user_id > 0){
						$userData  = new stdClass();
						$userData->user_id   = $users->user_id;
						$userData->email     = $users->email;
						$userData->name      = trim($users->first_name.' '.$users->last_name);
						$userData->role_id   = $users->role_id;
	                    $userData->role_code = $users->role_code;
	                   	$userData->default_landing = $users->default_landing_page;
	                    $userData->tasks = $users->tasks;
	                    $userData->theme   = $users->theme;
	                    $userData->last_login_date   = $users->last_login_date;
	                    $userData->profile_image = $users->profile_image;
						$this->session->set_userdata('users',serialize($userData));
						$this->user = unserialize($this->session->userdata('users'));

						$updateLoginData 	= array("last_login_ip_address" => $_SERVER['REMOTE_ADDR'], 
													"last_login_date" => date('Y-m-d H:i:s')); 
						$this->com->update('users',$updateLoginData,array('user_id' =>$users->user_id));

						return TRUE;
					}
					else{
						$this->form_validation->set_message('authenticate_check','Your account is disabled.');
						return FALSE;
					}
				}
				else{
					$this->form_validation->set_message('authenticate_check','Invalid login. Please try again.');
					return FALSE;
				}
			}else{
				$this->form_validation->set_message('authenticate_check','Email address not exist. Please try again.');
				return FALSE;
			}

			array('salt'=>$salt,'password' => sha1($salt.sha1($salt.sha1($this->input->post('password')))));
			
		}
	}
        
    public function dashboard(){
        $this->com->checkUserSession();
        $data['title'] = 'Admin Dashboard';
        $data['template']='files/index';
	    $this->load->view('templates/frontend_template',$data);
    }
    
    public function delete_profile_pic(){
    	$this->com->checkUserSession();
    	$prevImage = $this->user->profile_image;
    	if($prevImage!=''){
    		if($this->com->update('users',array('profile_image' => "" ),array('user_id' =>$this->user->user_id))){
    			delete_profile_image($prevImage);
				reset_user_session();
				$this->session->set_flashdata('msg_success', 'Profile image removed successfully.');
    		}
    	}
		redirect('admin/profile');
    }
        
    public function profile(){ 
        $this->com->checkUserSession();
        $user_id = $this->user->user_id;   
        $data['userData']	= $this->um->getUserProfileData($user_id);  
        $tab = $this->uri->segment(3);
        $tab = intval($tab);
        $data['activeTab'] 	= (($tab>=1 && $tab<5)&&is_int($tab)) ? $tab : 1;
		if($this->input->post())
		{		
			$buisness_name = '';
			if($this->user->role_id > 2){
				$buisness_name = $this->input->post('buisness_name');
			}
			if($this->input->post('profile_info')){
				$data['activeTab']  = 1;
				if($this->_submit_validate_profile()==TRUE){ 
					$data 	= array('first_name' 	=> $this->input->post('first_name'),
									'last_name' 	=> $this->input->post('last_name'),
									'email' 		=> $this->input->post('email'),
									'address' 		=> $this->input->post('address'),
									'phone_number' 	=> $this->input->post('phone_number'),
									'buisness_name' => $this->input->post('buisness_name'),
									'updated_date' => date('Y-m-d H:i:s'));
					$this->com->update('users',$data,array('user_id' =>$user_id));  
					$this->session->set_flashdata('msg_success', 'Profile updated successfully.');
					redirect('admin/profile/1');
				}

			}else if($this->input->post('profile_image')){
				if($this->_submit_validate_profile_image()==TRUE){
					$imageData 	= $this->session->userdata('check_profile_img');
					if(!empty($imageData)){
						$prevImage = $this->user->profile_image;
						delete_profile_image($prevImage);
						$this->com->update('users',array('profile_image' => $imageData['profile_image'] ),array('user_id' =>$user_id));	
						reset_user_session();
						redirect('admin/profile');
					}
				}
			}else if($this->input->post('changed_password')){
				$data['activeTab']  = 2;
				if($this->_submit_validate_change_password()==TRUE){
					$salt 	= $this->salt();
					$user_data  = array('salt' 	=> $salt,
										'password' 	=> sha1($salt.sha1($salt.sha1($this->input->post('new_password')))));
				   $this->com->update('users',$user_data,array('user_id' =>$user_id));	
				   $this->session->set_flashdata('msg_success', 'Password changed successfully.');
				   redirect('admin/profile/2');
				}

			}else if($this->input->post('account_settings')){
				if($this->input->post('theme')){
					$user_data['theme']	= $this->input->post('theme');
				}
				$user_data['is_email_alerts']	= 0;
				if($this->input->post('is_email_alerts')){
					$user_data['is_email_alerts']	= $this->input->post('is_email_alerts');
				}
				$user_data['is_sms_alerts']	= 0;
				if($this->input->post('is_sms_alerts')){
					$user_data['is_sms_alerts']	= $this->input->post('is_sms_alerts');
				}
				$user_data['is_chat_alerts']	= 0;
				if($this->input->post('is_chat_alerts')){
					$user_data['is_chat_alerts']	= $this->input->post('is_chat_alerts');
				}
				$user_data['is_email_notification']	= 0;
				if($this->input->post('is_email_notification')){
					$user_data['is_email_notification']	= $this->input->post('is_email_notification');
				}
				$user_data['is_sms_notification']	= 0;
				if($this->input->post('is_sms_notification')){
					$user_data['is_sms_notification']	= $this->input->post('is_sms_notification');
				}
				$user_data['is_chat_notification']	= 0;
				if($this->input->post('is_chat_notification')){
					$user_data['is_chat_notification']	= $this->input->post('is_chat_notification');
				}

				$this->com->update('users',$user_data,array('user_id' =>$user_id));	
				$this->session->set_flashdata('msg_success', 'Privacy settings changed successfully.');
				reset_user_session();
				redirect('admin/profile/3');
				}
		}
		$data['title']		= 'Profile';	
        $data['template']	= 'files/profile';
	    $this->load->view('templates/frontend_template',$data);
    }

    private function salt(){
   		return substr(md5(uniqid(rand(), true)), 0, 10);
 	}

 	private function _submit_validate_profile_image(){
 		$this->form_validation->set_rules('profile_image', '', 'callback_check_profile_img');
 		return $this->form_validation->run();
 	}

	private function _submit_validate_profile(){
	    $this->form_validation->set_rules('first_name', 'First Name','trim|required');
	    $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
	    $this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email');
	    if($this->user->role_id > 2){
	    	$this->form_validation->set_rules('buisness_name', 'Buisness Name','trim|required');
	    }
	    $this->form_validation->set_rules('phone_number', 'Mobile Number','trim|required');
	   // $this->form_validation->set_rules('preference', 'Default Preference','trim');
	    $this->form_validation->set_rules('address', 'Address','trim|required');
	    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');  
	    return $this->form_validation->run();
	}

    function check_email_exist($str){
        $user_id = $this->user->user_id; 
        $check=$this->com->get_row('users',array('user_id !='=>$user_id,'email'=>$str),'','');
        if($check){
            $this->form_validation->set_message('check_email_exist',"The Email field must contain a unique value.");
            return FALSE; 
        }else{
            return TRUE;
        }
    }
        
    function _submit_validate_change_password(){
        $this->form_validation->set_rules('new_password', 'New Password','trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password','trim|required|matches[new_password]');
		$this->form_validation->set_rules('old_password', 'old password','trim|callback_check_old_password');
	    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');  
        return $this->form_validation->run();
    }

    function check_old_password($str){
        $user_id 	= $this->user->user_id;
        $userData 	= $this->com->get_row('users',array('user_id'=>$user_id,'status'=>1),'','');
        $salt 		= $userData->salt;
        $str 		= sha1($salt.sha1($salt.sha1($str)));
        $check=$this->com->get_row('users',array('user_id'=>$user_id,'password'=>$str),'','');
        if($check){ 
          return TRUE;  
        }else{
            $this->form_validation->set_message('check_old_password',"The old password is wrong.");
            return FALSE;
        }
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

		  
}




