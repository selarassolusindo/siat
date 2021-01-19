<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Armada_model extends CI_Model
{

    public $table = 't05_armada';
    public $id = 'idarmada';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idarmada', $q);
	$this->db->or_like('Kode', $q);
	$this->db->or_like('Merk', $q);
	$this->db->or_like('Nopol', $q);
	$this->db->or_like('Norangka', $q);
	$this->db->or_like('Nomesin', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idarmada', $q);
	$this->db->or_like('Kode', $q);
	$this->db->or_like('Merk', $q);
	$this->db->or_like('Nopol', $q);
	$this->db->or_like('Norangka', $q);
	$this->db->or_like('Nomesin', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    /**
     * get new Kode Armada
     */
    function getNewKode($idarmada)
    {
        $row = $this->get_by_id($idarmada);
        // $kode = $row->Kode;
        // $lenKode = strlen($row->Kode);
        $this->db->order_by('Kode', 'desc');
        $this->db->limit(1);
        $row = $this->db->get($this->table)->row();
        if ($row) {
            /**
             * data yang dicari :: ditemukan
             */
            $value = $row->Kode;
            // $sLastKode = intval(substr($value, 3, 3)); // ambil 3 digit terakhir
            $sLastKode = intval(substr($value, 1, 4)); // ambil 4 digit terakhir
            $sLastKode = intval($sLastKode) + 1; // konversi ke integer, lalu tambahkan satu
            $sNextKode = "A" . sprintf('%04s', $sLastKode); // format hasilnya dan tambahkan prefix
            if (strlen($sNextKode) > 5) {
                $sNextKode = "A9999";
            }
        } else {
            /**
             * data yang dicari :: tidak ditemukan, maka
             * kode-induk + 1   => untuk level 2
             *            + 01  => untuk level 3
             *            + 001 = > untuk level 4 dan 5
             */
            $sNextKode = "A0001";
        }
        return $sNextKode;
    }

}

/* End of file Armada_model.php */
/* Location: ./application/models/Armada_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-10 21:08:22 */
/* http://harviacode.com */