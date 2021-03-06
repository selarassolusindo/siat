<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_groups_model extends CI_Model
{
    public $table = 'users_groups';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    public function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('group_id', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('group_id', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // cari jumlah group berdasarkan user_id
    public function getCountGroup()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('group_id <>', 1);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data by user_id
    public function get_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get($this->table)->row();
    }
}

/* End of file Users_groups_model.php */
/* Location: ./application/models/Users_groups_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-11 04:01:39 */
/* http://harviacode.com */
