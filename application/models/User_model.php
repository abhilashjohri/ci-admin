<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        
    }
    
    function checkAdminLogin($salt,$password){
            $this->db->trans_start();
            $sql = "SELECT u.*,r.role_name,r.default_landing_page, group_concat(t.task_id) as task_id ,group_concat(t.task_function) as tasks,r.role_code
                                        FROM users u
                                        INNER JOIN role r ON r.role_id = u.role_id
                                        LEFT JOIN role_task rt ON r.role_id = rt.role_id
                                        LEFT JOIN task t ON rt.task_id = t.task_id
                                        WHERE u.salt = ? AND u.password = ? AND u.status = 1 GROUP BY u.role_id";
            $query = $this->db->query($sql, array($salt,$password));
            log_message('info', 'Query for method checkUserLogin - '.$this->db->last_query());
            $userData = array();
            if($query->num_rows()>0){
                    $userData = $query->result();
            }
            $this->db->trans_complete();
            return $userData;
    }

    function getUserProfileData($user_id){
        $sql = "SELECT u.*,r.role_name,r.default_landing_page, group_concat(t.task_id) as task_id ,group_concat(t.task_function) as tasks,r.role_code, concat(pu.first_name,' ',pu.last_name) as parent_name, pu.email as parent_email, pu.phone_number as parent_phone
            FROM users u
            INNER JOIN role r ON r.role_id = u.role_id
            LEFT JOIN role_task rt ON r.role_id = rt.role_id
            LEFT JOIN task t ON rt.task_id = t.task_id
            LEFT JOIN users pu ON pu.user_id = u.parent_id
            WHERE u.user_id = ? AND u.status = 1 GROUP BY u.role_id";
        $query = $this->db->query($sql, array($user_id));
        log_message('info', 'Query for method getUserProfileData - '.$this->db->last_query());
        $userData = array();
        if($query->num_rows()>0){
                $userData = $query->row();
        }
        $this->db->trans_complete();
        return $userData;
    }

    public function getUsersListByRole($offset = '', $per_page = '',$role_id='') {
        $sql = "SELECT u.*, concat(u.first_name,' ',u.last_name) as name, concat(pu.first_name,' ',pu.last_name) as parent_name, pu.email as parent_email, pu.phone_number as parent_phone
            FROM users u
            LEFT JOIN users pu ON pu.user_id = u.parent_id
            WHERE u.role_id = ? AND u.status = 1 ORDER BY u.user_id DESC ";
        $param = array($role_id);
        if($this->user->role_id > 1){
            if($role_id == 4  &&  $this->user->role_id == 2){
                $sql = str_replace('WHERE u.role_id = ?', ' WHERE u.role_id = ? AND u.parent_id IN (select user_id from users where parent_id = ?) ', $sql);
                $param[count($param)] = $this->user->user_id;
            }else{
                $sql = str_replace('WHERE u.role_id = ?', ' WHERE u.role_id = ? AND u.parent_id = ? ', $sql);
                $param[count($param)] = $this->user->user_id;
            }
           
        }
        if ($offset >= 0 && $per_page > 0) {
            $sql .= 'LIMIT '.$offset.', '.$per_page;
        }    
        $query = $this->db->query($sql, $param);
        //echo $this->db->last_query();die;
        log_message('info', 'Query for method getUsersListByRole - '.$this->db->last_query());
        if ($offset >= 0 && $per_page > 0) {
            $userData = array();
            if($query->num_rows()>0){
                $userData = $query->result();
            }
        }else{
            $userData = $query->num_rows();
        }
        $this->db->trans_complete();
        return $userData;
    }

    public function getGroupAdminList(){
        $sql = "SELECT u.*, concat(u.first_name,' ',u.last_name) as name FROM users u WHERE u.role_id = 2 AND u.status = 1 ORDER BY u.user_id DESC ";
        $query = $this->db->query($sql, array() );
        log_message('info', 'Query for method getGroupAdminList - '.$this->db->last_query());
        $userData   = array();
        if($query->num_rows()>0){
            $userData = $query->result();
        }
        $this->db->trans_complete();
        return $userData;
    }

    public function getTenantAdminList($group_admin_id=0){
        $sql = "SELECT u.*, concat(u.first_name,' ',u.last_name) as name FROM users u WHERE u.role_id = 3 AND u.status = 1 ORDER BY u.user_id DESC ";
        $param = array();
        if($group_admin_id>0){
            $sql = str_replace('WHERE u.role_id = 3', ' WHERE u.role_id = 3 AND u.parent_id = ? ', $sql);
            $param[] = $group_admin_id;
        }
        $query = $this->db->query($sql, $param);
        //echo $this->db->last_query();die;
        log_message('info', 'Query for method getGroupAdminList - '.$this->db->last_query());
        $userData   = array();
        if($query->num_rows()>0){
            $userData = $query->result();
        }
        $this->db->trans_complete();
        return $userData;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

