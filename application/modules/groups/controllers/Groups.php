<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Groups extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->load->model('Groups_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'groups/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'groups/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'groups/index.html';
            $config['first_url'] = base_url() . 'groups/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = true;
        $config['total_rows'] = $this->Groups_model->total_rows($q);
        $groups = $this->Groups_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'groups_data' => $groups,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('groups/groups_list', $data);
    }

    public function read($id)
    {
        $row = $this->Groups_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'name' => $row->name,
        'description' => $row->description,
        );
            $this->load->view('groups/groups_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('groups/create_action'),
        'id' => set_value('id'),
        'name' => set_value('name'),
        'description' => set_value('description'),
    );
        $this->load->view('groups/groups_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
        'name' => $this->input->post('name', true),
        'description' => $this->input->post('description', true),
        );

            $this->Groups_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('groups'));
        }
    }

    public function update($id)
    {
        $row = $this->Groups_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('groups/update_action'),
        'id' => set_value('id', $row->id),
        'name' => set_value('name', $row->name),
        'description' => set_value('description', $row->description),
        );
            $this->load->view('groups/groups_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
        'name' => $this->input->post('name', true),
        'description' => $this->input->post('description', true),
        );

            $this->Groups_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('groups'));
        }
    }

    public function delete($id)
    {
        $row = $this->Groups_model->get_by_id($id);

        if ($row) {
            $this->Groups_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('groups'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "groups.xls";
        $judul = "groups";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Name");
        xlsWriteLabel($tablehead, $kolomhead++, "Description");

        foreach ($this->Groups_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->name);
            xlsWriteLabel($tablebody, $kolombody++, $data->description);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=groups.doc");

        $data = array(
            'groups_data' => $this->Groups_model->get_all(),
            'start' => 0
        );

        $this->load->view('groups/groups_doc', $data);
    }
}

/* End of file Groups.php */
/* Location: ./application/controllers/Groups.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-11 04:00:34 */
/* http://harviacode.com */
