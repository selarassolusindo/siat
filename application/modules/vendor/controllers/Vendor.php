<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'vendor/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'vendor/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'vendor/index.html';
            $config['first_url'] = base_url() . 'vendor/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Vendor_model->total_rows($q);
        $vendor = $this->Vendor_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'vendor_data' => $vendor,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('vendor/t04_vendor_list', $data);
        $data['_view'] = 'vendor/t04_vendor_list';
        $data['_caption'] = 'Vendor';
        $this->load->view('dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->Vendor_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idvendor' => $row->idvendor,
		'Kode' => $row->Kode,
		'Nama' => $row->Nama,
		'Alamat' => $row->Alamat,
		'Kota' => $row->Kota,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('vendor/t04_vendor_read', $data);
            $data['_view'] = 'vendor/t04_vendor_read';
            $data['_caption'] = 'Vendor';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vendor'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('vendor/create_action'),
	    'idvendor' => set_value('idvendor'),
	    // 'Kode' => set_value('Kode'),
        'Kode' => set_value('Kode', $this->Vendor_model->getNewKode($idvendor)),
	    'Nama' => set_value('Nama'),
	    'Alamat' => set_value('Alamat'),
	    'Kota' => set_value('Kota'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
	);
        // $this->load->view('vendor/t04_vendor_form', $data);
        $data['_view'] = 'vendor/t04_vendor_form';
        $data['_caption'] = 'Vendor';
        $this->load->view('dashboard/_layout', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Nama' => $this->input->post('Nama',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Kota' => $this->input->post('Kota',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Vendor_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('vendor'));
        }
    }

    public function update($id)
    {
        $row = $this->Vendor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('vendor/update_action'),
		'idvendor' => set_value('idvendor', $row->idvendor),
		'Kode' => set_value('Kode', $row->Kode),
		'Nama' => set_value('Nama', $row->Nama),
		'Alamat' => set_value('Alamat', $row->Alamat),
		'Kota' => set_value('Kota', $row->Kota),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('vendor/t04_vendor_form', $data);
            $data['_view'] = 'vendor/t04_vendor_form';
            $data['_caption'] = 'Vendor';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vendor'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idvendor', TRUE));
        } else {
            $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Nama' => $this->input->post('Nama',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Kota' => $this->input->post('Kota',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Vendor_model->update($this->input->post('idvendor', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('vendor'));
        }
    }

    public function delete($id)
    {
        $row = $this->Vendor_model->get_by_id($id);

        if ($row) {
            $this->Vendor_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('vendor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vendor'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('Kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('Alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('Kota', 'kota', 'trim|required');
	// $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	// $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idvendor', 'idvendor', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t04_vendor.xls";
        $judul = "t04_vendor";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Kota");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->Vendor_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kota);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t04_vendor.doc");

        $data = array(
            't04_vendor_data' => $this->Vendor_model->get_all(),
            'start' => 0
        );

        $this->load->view('vendor/t04_vendor_doc',$data);
    }

}

/* End of file Vendor.php */
/* Location: ./application/controllers/Vendor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-09 08:01:41 */
/* http://harviacode.com */
