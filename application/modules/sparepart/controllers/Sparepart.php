<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sparepart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sparepart_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'sparepart/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sparepart/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sparepart/index.html';
            $config['first_url'] = base_url() . 'sparepart/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sparepart_model->total_rows($q);
        $sparepart = $this->Sparepart_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sparepart_data' => $sparepart,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('sparepart/t06_sparepart_list', $data);
        $data['_view'] = 'sparepart/t06_sparepart_list';
        $data['_caption'] = 'Spare Part';
        $this->load->view('dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->Sparepart_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idsparepart' => $row->idsparepart,
		'Kode' => $row->Kode,
		'Nama' => $row->Nama,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('sparepart/t06_sparepart_read', $data);
            $data['_view'] = 'sparepart/t06_sparepart_read';
            $data['_caption'] = 'Spare Part';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sparepart'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sparepart/create_action'),
	    'idsparepart' => set_value('idsparepart'),
	    // 'Kode' => set_value('Kode'),
        'Kode' => set_value('Kode', $this->Sparepart_model->getNewKode($idsparepart)),
	    'Nama' => set_value('Nama'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
	);
        // $this->load->view('sparepart/t06_sparepart_form', $data);
        $data['_view'] = 'sparepart/t06_sparepart_form';
        $data['_caption'] = 'Spare Part';
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
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Sparepart_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sparepart'));
        }
    }

    public function update($id)
    {
        $row = $this->Sparepart_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sparepart/update_action'),
		'idsparepart' => set_value('idsparepart', $row->idsparepart),
		'Kode' => set_value('Kode', $row->Kode),
		'Nama' => set_value('Nama', $row->Nama),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('sparepart/t06_sparepart_form', $data);
            $data['_view'] = 'sparepart/t06_sparepart_form';
            $data['_caption'] = 'Spare Part';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sparepart'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idsparepart', TRUE));
        } else {
            $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Nama' => $this->input->post('Nama',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Sparepart_model->update($this->input->post('idsparepart', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sparepart'));
        }
    }

    public function delete($id)
    {
        $row = $this->Sparepart_model->get_by_id($id);

        if ($row) {
            $this->Sparepart_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sparepart'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sparepart'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('Kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
	// $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	// $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idsparepart', 'idsparepart', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t06_sparepart.xls";
        $judul = "t06_sparepart";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->Sparepart_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nama);
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
        header("Content-Disposition: attachment;Filename=t06_sparepart.doc");

        $data = array(
            't06_sparepart_data' => $this->Sparepart_model->get_all(),
            'start' => 0
        );

        $this->load->view('sparepart/t06_sparepart_doc',$data);
    }

}

/* End of file Sparepart.php */
/* Location: ./application/controllers/Sparepart.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-10 23:30:17 */
/* http://harviacode.com */
