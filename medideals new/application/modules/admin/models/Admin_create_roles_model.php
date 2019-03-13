<?php

class Admin_create_roles_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteAdminUser($id)
    {
        $this->db->where('role_id', $id);
        if (!$this->db->delete('role_names')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getAdminUsers($user = null)
    {
        if ($user != null && is_numeric($user)) {
            $this->db->where('role_id', $user);
        } else if ($user != null && is_string($user)) {
            $this->db->where('role_name', $user);
        }
        $query = $this->db->get('role_names');
        if ($user != null) {
            return $query->row_array();
        } else {
            return $query;
        }
    }

    public function setAdminUser($post)
    {
        if ($post['edit'] > 0) {
            
            $this->db->where('role_id', $post['edit']);
            unset($post['role_id'], $post['edit']);
            if (!$this->db->update('role_names', $post)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            unset($post['edit']);
            if (!$this->db->insert('role_names', $post)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

}
