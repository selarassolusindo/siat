<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salesorder_model extends CI_Model
{

    public $table = 't11_so';
    public $id = 'idso';
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
        $this->db->like('idso', $q);
	$this->db->or_like('NomorSO', $q);
	$this->db->or_like('Tanggal', $q);
	$this->db->or_like('idcustomer', $q);
	$this->db->or_like('idshipper', $q);
	$this->db->or_like('idarmada', $q);
	$this->db->or_like('Asal', $q);
	$this->db->or_like('Tujuan', $q);
	$this->db->or_like('Driver', $q);
	$this->db->or_like('Harga', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idso', $q);
	$this->db->or_like('NomorSO', $q);
	$this->db->or_like('Tanggal', $q);
	$this->db->or_like('idcustomer', $q);
	$this->db->or_like('idshipper', $q);
	$this->db->or_like('idarmada', $q);
	$this->db->or_like('Asal', $q);
	$this->db->or_like('Tujuan', $q);
	$this->db->or_like('Driver', $q);
	$this->db->or_like('Harga', $q);
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
     * join ke tabel customer
     * join ke tabel shipper
     * join ke tabel armada
     */
    function getLimitDataFromSIA($limit, $start = 0, $q = NULL) {
        // $this->db->order_by($this->id, $this->order);
        $this->db->order_by('t02_akun.Kode', 'asc'); //
        $this->db->like('idsa', $q); //
        $this->db->or_like('t02_akun.Nama', $q); //
        $this->db->or_like($this->table . '.idakun', $q); //
        $this->db->or_like('Debit', $q); //
        $this->db->or_like('Kredit', $q); //
        // $this->db->or_like('created_at', $q);
        // $this->db->or_like('updated_at', $q);
        $this->db->limit($limit, $start); //
        $this->db->select($this->table . '.*, t02_akun.Kode, t02_akun.Nama'); //
        $this->db->from($this->table); //
        $this->db->join('t02_akun', 't02_akun.idakun = '.$this->table.'.idakun'); //
        // return $this->db->get($this->table)->result();
        return $this->db->get()->result(); //
    }

    function getLimitData($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order); //
        $this->db->like('idso', $q); //
        $this->db->or_like('t02_customer.Nama', $q);
        $this->db->or_like('t03_shipper.Nama', $q);
        $this->db->or_like('t05_armada.Merk', $q);
        $this->db->or_like('t05_armada.Nopol', $q);
        $this->db->or_like('NomorSO', $q);
        $this->db->or_like('Tanggal', $q);
        $this->db->or_like($this->table . '.idcustomer', $q);
        $this->db->or_like($this->table . '.idshipper', $q);
        $this->db->or_like($this->table . '.idarmada', $q);
        $this->db->or_like('Asal', $q);
        $this->db->or_like('Tujuan', $q);
        $this->db->or_like('Driver', $q);
        $this->db->or_like('Harga', $q);
        // $this->db->or_like('created_at', $q);
        // $this->db->or_like('updated_at', $q);
        $this->db->limit($limit, $start);
        $this->db->select($this->table . '.*, t02_customer.Nama as CustomerNama, t03_shipper.Nama as ShipperNama, t05_armada.Merk, t05_armada.Nopol');
        $this->db->from($this->table);
        $this->db->join('t02_customer', 't02_customer.idcustomer = '.$this->table.'.idcustomer');
        $this->db->join('t03_shipper', 't03_shipper.idshipper = '.$this->table.'.idshipper');
        $this->db->join('t05_armada', 't05_armada.idarmada = '.$this->table.'.idarmada');
        // return $this->db->get($this->table)->result();
        return $this->db->get()->result();
        // $r = $this->db->get()->result();
        // $r = $this->db->return_query();
        // $r = $this->db->get_compiled_select();
        // echo $this->db->last_query();
        // echo $r;
    }

}

/* End of file Salesorder_model.php */
/* Location: ./application/models/Salesorder_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-30 21:17:19 */
/* http://harviacode.com */
