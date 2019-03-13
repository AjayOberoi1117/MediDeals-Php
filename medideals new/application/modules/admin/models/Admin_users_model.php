<?php

class Admin_users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteAdminUser($id)
    {
        $this->db->where('id', $id);
        if (!$this->db->delete('users')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getAdminUsers($user = null)
    {
        if ($user != null && is_numeric($user)) {
            $this->db->where('id', $user);
        } else if ($user != null && is_string($user)) {
            $this->db->where('username', $user);
        }
		$this->db->select('users.id, users.username, users.email, users.user_role, users.last_login, role_names.role_name')
         ->from('users')
         ->join('role_names', "users.user_role = role_names.role_id");
        $query = $this->db->get();
        if ($user != null) {
            return $query->row_array();
        } else {
            return $query;
        }
    }

    public function setAdminUser($post)
    {
        if ($post['edit'] > 0) {
            if (trim($post['password']) == '') {
                unset($post['password']);
            } else {
                $post['password'] = md5($post['password']);
            }
            $this->db->where('id', $post['edit']);
            unset($post['id'], $post['edit']);
            if (!$this->db->update('users', $post)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            unset($post['edit']);
            $post['password'] = md5($post['password']);
            if (!$this->db->insert('users', $post)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }
	public function getuserroles()
	{
		$this->db->select('role_id, role_name');
		$this->db->where('status', "1");
		$query = $this->db->get('role_names');
		return $query->result();
	}
	public function getuserrolename($role_id = null)
	{
		$this->db->select('role_name');
		$this->db->where('status', "1");
		$this->db->where('role_id', "$role_id");
		$query = $this->db->get('role_names');
		return $query->result();
	}
}
