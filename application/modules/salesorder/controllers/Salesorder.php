<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salesorder extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Salesorder_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'salesorder/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'salesorder/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'salesorder/index.html';
            $config['first_url'] = base_url() . 'salesorder/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Salesorder_model->total_rows($q);
        $salesorder = $this->Salesorder_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'salesorder_data' => $salesorder,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('salesorder/t11_so_list', $data);
        $data['_view'] = 'salesorder/t11_so_list';
        $data['_caption'] = 'Sales Order';
        $this->load->view('dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->Salesorder_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idso' => $row->idso,
		'NomorSO' => $row->NomorSO,
		'Tanggal' => $row->Tanggal,
		'idcustomer' => $row->idcustomer,
		'idshipper' => $row->idshipper,
		'idarmada' => $row->idarmada,
		'Asal' => $row->Asal,
		'Tujuan' => $row->Tujuan,
		'Driver' => $row->Driver,
		'Harga' => $row->Harga,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('salesorder/t11_so_read', $data);
            $data['_view'] = 'salesorder/t11_so_read';
            $data['_caption'] = 'Sales Order';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('salesorder'));
        }
    }

    public function create()
    {
        // combo customer
        $this->load->model('customer/Customer_model');
        $customer = $this->Customer_model->getAll();

        // combo shipper
        $this->load->model('shipper/Shipper_model');
        $shipper = $this->Shipper_model->getAll();

        // combo armada
        $this->load->model('armada/Armada_model');
        $armada = $this->Armada_model->getAll();

        $data = array(
            'button' => 'Create',
            'action' => site_url('salesorder/create_action'),
	    'idso' => set_value('idso'),
	    'NomorSO' => set_value('NomorSO'),
	    'Tanggal' => set_value('Tanggal'),
	    'idcustomer' => set_value('idcustomer'),
	    'idshipper' => set_value('idshipper'),
	    'idarmada' => set_value('idarmada'),
	    'Asal' => set_value('Asal'),
	    'Tujuan' => set_value('Tujuan'),
	    'Driver' => set_value('Driver'),
	    'Harga' => set_value('Harga'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
        'customer_data' => $customer,
        'shipper_data' => $shipper,
        'armada_data' => $armada,
	);
        // $this->load->view('salesorder/t11_so_form', $data);
        $data['_view'] = 'salesorder/t11_so_form';
        $data['_caption'] = 'Sales Order';
        $this->load->view('dashboard/_layout', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'NomorSO' => $this->input->post('NomorSO',TRUE),
		'Tanggal' => $this->input->post('Tanggal',TRUE),
		'idcustomer' => $this->input->post('idcustomer',TRUE),
		'idshipper' => $this->input->post('idshipper',TRUE),
		'idarmada' => $this->input->post('idarmada',TRUE),
		'Asal' => $this->input->post('Asal',TRUE),
		'Tujuan' => $this->input->post('Tujuan',TRUE),
		'Driver' => $this->input->post('Driver',TRUE),
		'Harga' => $this->input->post('Harga',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Salesorder_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('salesorder'));
        }
    }

    public function update($id)
    {
        $row = $this->Salesorder_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('salesorder/update_action'),
		'idso' => set_value('idso', $row->idso),
		'NomorSO' => set_value('NomorSO', $row->NomorSO),
		'Tanggal' => set_value('Tanggal', $row->Tanggal),
		'idcustomer' => set_value('idcustomer', $row->idcustomer),
		'idshipper' => set_value('idshipper', $row->idshipper),
		'idarmada' => set_value('idarmada', $row->idarmada),
		'Asal' => set_value('Asal', $row->Asal),
		'Tujuan' => set_value('Tujuan', $row->Tujuan),
		'Driver' => set_value('Driver', $row->Driver),
		'Harga' => set_value('Harga', $row->Harga),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('salesorder/t11_so_form', $data);
            $data['_view'] = 'salesorder/t11_so_form';
            $data['_caption'] = 'Sales Order';
            $this->load->view('dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('salesorder'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idso', TRUE));
        } else {
            $data = array(
		'NomorSO' => $this->input->post('NomorSO',TRUE),
		'Tanggal' => $this->input->post('Tanggal',TRUE),
		'idcustomer' => $this->input->post('idcustomer',TRUE),
		'idshipper' => $this->input->post('idshipper',TRUE),
		'idarmada' => $this->input->post('idarmada',TRUE),
		'Asal' => $this->input->post('Asal',TRUE),
		'Tujuan' => $this->input->post('Tujuan',TRUE),
		'Driver' => $this->input->post('Driver',TRUE),
		'Harga' => $this->input->post('Harga',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Salesorder_model->update($this->input->post('idso', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('salesorder'));
        }
    }

    public function delete($id)
    {
        $row = $this->Salesorder_model->get_by_id($id);

        if ($row) {
            $this->Salesorder_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('salesorder'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('salesorder'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('NomorSO', 'nomorso', 'trim|required');
	$this->form_validation->set_rules('Tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('idcustomer', 'idcustomer', 'trim|required');
	$this->form_validation->set_rules('idshipper', 'idshipper', 'trim|required');
	$this->form_validation->set_rules('idarmada', 'idarmada', 'trim|required');
	$this->form_validation->set_rules('Asal', 'asal', 'trim|required');
	$this->form_validation->set_rules('Tujuan', 'tujuan', 'trim|required');
	$this->form_validation->set_rules('Driver', 'driver', 'trim|required');
	$this->form_validation->set_rules('Harga', 'harga', 'trim|required|numeric');
	// $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	// $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idso', 'idso', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t11_so.xls";
        $judul = "t11_so";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NomorSO");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Idcustomer");
	xlsWriteLabel($tablehead, $kolomhead++, "Idshipper");
	xlsWriteLabel($tablehead, $kolomhead++, "Idarmada");
	xlsWriteLabel($tablehead, $kolomhead++, "Asal");
	xlsWriteLabel($tablehead, $kolomhead++, "Tujuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Driver");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->Salesorder_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NomorSO);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Tanggal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idcustomer);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idshipper);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idarmada);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Asal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Tujuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Driver);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Harga);
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
        header("Content-Disposition: attachment;Filename=t11_so.doc");

        $data = array(
            't11_so_data' => $this->Salesorder_model->get_all(),
            'start' => 0
        );

        $this->load->view('salesorder/t11_so_doc',$data);
    }

}

/* End of file Salesorder.php */
/* Location: ./application/controllers/Salesorder.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-30 21:17:19 */
/* http://harviacode.com */
