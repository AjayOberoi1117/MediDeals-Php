<?php

class Admin_rolemapping_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
	public function showmenu()
	{
		$this->db->select('menu_id, menu_name','menu_url');
		$this->db->where('status', "1");
		$query = $this->db->get('role_menu');
		return $query->result();		
	}
	public function showrolename()
	{
		$this->db->select('role_id, role_name');
		$this->db->where('status', "1");
		$query = $this->db->get('role_names');
		return $query->result();		
	}
	public function insertrole($post)
	{
		$count = count($post['ch']);
		
		for($i = 0; $i < $count; $i++)
		{	
			$val = $post['ch'][$i];
			$data['menu_id'] = $val;
			$data['role_id'] = $post['rolename'];
			if (!$this->db->insert('role_mapping', $data)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));	
			}	
		}			
	}
	public function showmenubyid($id)
	{
		$this->db->select('role_mapping.mapping_id, role_mapping.role_id, role_mapping.menu_id, role_menu.menu_name');    
		$this->db->from('role_mapping');
		$this->db->join('role_menu', 'role_mapping.menu_id = role_menu.menu_id');
		$this->db->where('role_mapping.role_id', "$id");
		$query = $this->db->get();
		return $query->result();
	}
	public function showrolemap($id)
	{
		$this->db->select('role_mapping.mapping_id, role_mapping.role_id, role_mapping.menu_id, role_menu.menu_name');    
		$this->db->from('role_mapping');
		$this->db->join('role_menu', 'role_mapping.menu_id = role_menu.menu_id');
		$this->db->where('role_mapping.role_id', "$id");
		$query = $this->db->get();
		return $query->result();
	}
	public function editrolemapper($post)
	{
		$this->db->trans_begin();
		// delete previous role mapping
        if (!$this->db->delete('role_mapping',array('role_id'=>$post['roleid'])))
		{
			log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
		}
		
		// insert new role mapping	
        $count = count($post['ch']);
		
		for($i = 0; $i < $count; $i++)
		{	
			$val = $post['ch'][$i];
			$data['menu_id'] = $val;
			$data['role_id'] = $post['roleid'];
			if (!$this->db->insert('role_mapping', $data)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));	
			}	
		}		
		
		
        if ($this->db->trans_status() === FALSE) 
		{
            $this->db->trans_rollback();
            return false;
        } 
		else 
		{
            $this->db->trans_commit();
        }
	}
	
	
    /*public function deleteAdminUser($id)
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
    }*/

}
