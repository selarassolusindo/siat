<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shipper extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Shipper_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'shipper/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'shipper/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'shipper/index.html';
            $config['first_url'] = base_url() . 'shipper/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Shipper_model->total_rows($q);
        $shipper = $this->Shipper_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'shipper_data' => $shipper,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('shipper/t03_shipper_list', $data);
        $data['_view'] = 'shipper/t03_shipper_list';
        $data['_caption'] = 'Shipper';
        $this->load->view('dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->Shipper_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idshipper' => $row->idshipper,
		'Kode' => $row->Kode,
		'Nama' => $row->Nama,
		'Alamat' => $row->Alamat,
		'Kota' => $row->Kota,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('shipper/t03_shipper_read', $data);
            $data['_view'] = 'shipper/t03_shipper_read';
            $data['_caption'] = 'Shipper';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shipper'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('shipper/create_action'),
	    'idshipper' => set_value('idshipper'),
	    // 'Kode' => set_value('Kode'),
        'Kode' => set_value('Kode', $this->Shipper_model->getNewKode($idshipper)),
	    'Nama' => set_value('Nama'),
	    'Alamat' => set_value('Alamat'),
	    'Kota' => set_value('Kota'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
	);
        // $this->load->view('shipper/t03_shipper_form', $data);
        $data['_view'] = 'shipper/t03_shipper_form';
        $data['_caption'] = 'Shipper';
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

            $this->Shipper_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('shipper'));
        }
    }

    public function update($id)
    {
        $row = $this->Shipper_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('shipper/update_action'),
		'idshipper' => set_value('idshipper', $row->idshipper),
		'Kode' => set_value('Kode', $row->Kode),
		'Nama' => set_value('Nama', $row->Nama),
		'Alamat' => set_value('Alamat', $row->Alamat),
		'Kota' => set_value('Kota', $row->Kota),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('shipper/t03_shipper_form', $data);
            $data['_view'] = 'shipper/t03_shipper_form';
            $data['_caption'] = 'Shipper';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shipper'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idshipper', TRUE));
        } else {
            $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Nama' => $this->input->post('Nama',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Kota' => $this->input->post('Kota',TRUE),
        // 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Shipper_model->update($this->input->post('idshipper', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('shipper'));
        }
    }

    public function delete($id)
    {
        $row = $this->Shipper_model->get_by_id($id);

        if ($row) {
            $this->Shipper_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('shipper'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shipper'));
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

	$this->form_validation->set_rules('idshipper', 'idshipper', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t03_shipper.xls";
        $judul = "t03_shipper";
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

	foreach ($this->Shipper_model->get_all() as $data) {
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
        header("Content-Disposition: attachment;Filename=t03_shipper.doc");

        $data = array(
            't03_shipper_data' => $this->Shipper_model->get_all(),
            'start' => 0
        );

        $this->load->view('shipper/t03_shipper_doc',$data);
    }

}

/* End of file Shipper.php */
/* Location: ./application/controllers/Shipper.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-03 23:40:30 */
/* http://harviacode.com */
