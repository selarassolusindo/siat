<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Armada extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Armada_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'armada/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'armada/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'armada/index.html';
            $config['first_url'] = base_url() . 'armada/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Armada_model->total_rows($q);
        $armada = $this->Armada_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'armada_data' => $armada,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('armada/t05_armada_list', $data);
        $data['_view'] = 'armada/t05_armada_list';
        $data['_caption'] = 'Armada';
        $this->load->view('dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->Armada_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idarmada' => $row->idarmada,
		'Kode' => $row->Kode,
		'Merk' => $row->Merk,
		'Nopol' => $row->Nopol,
		'Norangka' => $row->Norangka,
		'Nomesin' => $row->Nomesin,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('armada/t05_armada_read', $data);
            $data['_view'] = 'armada/t05_armada_read';
            $data['_caption'] = 'Armada';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('armada'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('armada/create_action'),
	    'idarmada' => set_value('idarmada'),
	    // 'Kode' => set_value('Kode'),
        'Kode' => set_value('Kode', $this->Armada_model->getNewKode($idarmada)),
	    'Merk' => set_value('Merk'),
	    'Nopol' => set_value('Nopol'),
	    'Norangka' => set_value('Norangka'),
	    'Nomesin' => set_value('Nomesin'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
	);
        // $this->load->view('armada/t05_armada_form', $data);
        $data['_view'] = 'armada/t05_armada_form';
        $data['_caption'] = 'Armada';
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
		'Merk' => $this->input->post('Merk',TRUE),
		'Nopol' => $this->input->post('Nopol',TRUE),
		'Norangka' => $this->input->post('Norangka',TRUE),
		'Nomesin' => $this->input->post('Nomesin',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Armada_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('armada'));
        }
    }

    public function update($id)
    {
        $row = $this->Armada_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('armada/update_action'),
		'idarmada' => set_value('idarmada', $row->idarmada),
		'Kode' => set_value('Kode', $row->Kode),
		'Merk' => set_value('Merk', $row->Merk),
		'Nopol' => set_value('Nopol', $row->Nopol),
		'Norangka' => set_value('Norangka', $row->Norangka),
		'Nomesin' => set_value('Nomesin', $row->Nomesin),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('armada/t05_armada_form', $data);
            $data['_view'] = 'armada/t05_armada_form';
            $data['_caption'] = 'Armada';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('armada'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idarmada', TRUE));
        } else {
            $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Merk' => $this->input->post('Merk',TRUE),
		'Nopol' => $this->input->post('Nopol',TRUE),
		'Norangka' => $this->input->post('Norangka',TRUE),
		'Nomesin' => $this->input->post('Nomesin',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Armada_model->update($this->input->post('idarmada', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('armada'));
        }
    }

    public function delete($id)
    {
        $row = $this->Armada_model->get_by_id($id);

        if ($row) {
            $this->Armada_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('armada'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('armada'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('Kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('Merk', 'merk', 'trim|required');
	$this->form_validation->set_rules('Nopol', 'nopol', 'trim|required');
	$this->form_validation->set_rules('Norangka', 'norangka', 'trim|required');
	$this->form_validation->set_rules('Nomesin', 'nomesin', 'trim|required');
	// $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	// $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idarmada', 'idarmada', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t05_armada.xls";
        $judul = "t05_armada";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Merk");
	xlsWriteLabel($tablehead, $kolomhead++, "Nopol");
	xlsWriteLabel($tablehead, $kolomhead++, "Norangka");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomesin");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->Armada_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Merk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nopol);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Norangka);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nomesin);
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
        header("Content-Disposition: attachment;Filename=t05_armada.doc");

        $data = array(
            't05_armada_data' => $this->Armada_model->get_all(),
            'start' => 0
        );

        $this->load->view('armada/t05_armada_doc',$data);
    }

}

/* End of file Armada.php */
/* Location: ./application/controllers/Armada.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-10 21:08:22 */
/* http://harviacode.com */
