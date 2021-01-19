<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun0 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
        $this->db = $this->load->database($this->session->userdata('groupName'), true);
        $this->load->library('grocery_CRUD');
    }

    public function _example_output($output = null) {
  		$this->load->view('dashboard/_layout', (array)$output);
    }

    public $table = 't02_akun';

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_model('Akun_model0');
        $crud->set_table($this->table);
        $crud->set_subject('Akun');
        $crud->set_relation('Induk', 't02_akun', '{Kode} - {Nama}');
        $crud->unset_columns(array('created_at', 'updated_at'));
        $crud->unset_fields(array('created_at', 'updated_at'));
        $crud->order_by('Urut');
        $crud->columns(['Kode', 'Nama']);
        $crud->fields('Induk', 'Kode', 'Nama', 'Urut');
        $crud->change_field_type('Urut', 'invisible');
        $crud->callback_before_insert(array($this, 'cb_before_i_u'));
        $crud->callback_before_update(array($this, 'cb_before_i_u'));
        $crud->callback_column('Nama', array($this, 'formatNama'));
        // $crud->callback_column('Debit', function($value, $row) { return numIndo($value); });
        // $crud->callback_column('Kredit', function($value, $row) { return numIndo($value); });

        $crud->add_action('Tambah', base_url() . 'assets/grocery_crud/themes/flexigrid/css/images/add.png', '', '', array($this, 'tambah'));

        // $crud->callback_field('Debit', function($value = '', $primary_key = null) {
        //     return '<input id="field-Debit" class="form-control form-control-sm" name="Debit" type="text" value="'.numIndo($value).'">';
        // });
        // $crud->callback_field('Kredit', function($value = '', $primary_key = null) {
        //     return '<input id="field-Kredit" class="form-control form-control-sm" name="Kredit" type="text" value="'.numIndo($value).'">';
        // });

        $output = $crud->render();
        $output->_caption = 'Klasifikasi Akun';

        $output->_js_output = '
            <script>
                $(\'.add\').hide();

                // check parameter kode
                var urlParams = new URLSearchParams(window.location.search);
                var foo = urlParams.get(\'kode\');
                if(foo) {
                    $(\'input[name="Kode"]\').attr("value", "'.$_GET['kode'].'");
                }

                // check parameter induk
                var urlParams = new URLSearchParams(window.location.search);
                var foo = urlParams.get(\'induk\');
                if(foo) {
                    $(\'select[name="Induk"] option[value="'.$_GET['induk'].'"]\').attr("selected", "selected");
                    $(\'select[name="Induk"]\').attr("disabled", "disabled");
                }

                // $(\'.Debit\').mask("#.##0,00", {reverse: true});
                // $(\'.Kredit\').mask("#.##0,00", {reverse: true});
            </script>
            ';

        $this->_example_output($output);
    }

    /**
     * fungsi untuk mengubah hyperlink pada icon TAMBAH di setiap baris data
     */
    public function tambah($primary_key, $row)
    {
        return (strlen($row->Kode) == 10 ? '' : site_url('akun/index/add?induk=' . $row->idakun . '&kode=' . $row->Kode));
    }

    /**
     * fungsi untuk mengubah posisi NAMA AKUN, disesuaikan dengan level akunnya
     */
    public function formatNama($value, $row)
    {
        $lenKode = strlen($row->Kode);
        switch ($lenKode) {
            case 1:
                $result = '<b>' . $value . '</b>';
                break;
            case 2:
                $result = '&nbsp;&nbsp;&nbsp;&nbsp;<b>' . $value . '</b>';
                break;
            case 4:
                $countId = $this->Akun_model0->totalRows($row->idakun, $this->table);
                $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ($countId == 0 ? $value : '<b>' . $value . '</b>');
                break;
            case 7:
                $countId = $this->Akun_model0->totalRows($row->idakun, $this->table);
                $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ($countId == 0 ? $value : '<b>' . $value . '</b>');
                break;
            case 10:
                $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $value;
                break;
        }
        return $result;
    }

    /**
     * fungsi untuk mensetting urutan tiap akun
     * dan, untuk memformat tanda titik (.) dihilangkan
     * dan, untuk memformat tanda koma (,) diubah menjadi titik
     */
    public function cb_before_i_u($postArray, $pK = null)
    {
        $postArray['Urut']   = substr(trim($postArray['Kode']) . '0000000000', 0, 10);
        // $postArray['Debit']  = str_replace('.', '', $postArray['Debit']);
        // $postArray['Debit']  = str_replace(',', '.', $postArray['Debit']);
        // $postArray['Kredit'] = str_replace('.', '', $postArray['Kredit']);
        // $postArray['Kredit'] = str_replace(',', '.', $postArray['Kredit']);

        return $postArray;
    }

    /**
     * unused
     */
    public function l1()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('t02_akunl1');
        $crud->set_subject('Akun Level-1');
        $crud->unset_columns(array('created_at', 'updated_at'));
        $crud->unset_fields(array('created_at', 'updated_at'));

        $output = $crud->render();
        $output->_caption = 'Akun Level-1';
        $this->_example_output($output);
    }

    public function l2()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('t03_akunl2');
        $crud->set_relation('l1_id', 't02_akunl1', '{Kode} - {Nama}');
        $crud->display_as('l1_id', 'Akun Level-1');
        $crud->unset_columns(array('created_at', 'updated_at'));
        $crud->unset_fields(array('created_at', 'updated_at'));

        $output = $crud->render();
        $output->_caption = 'Akun Level-2';
        $this->_example_output($output);
    }

    public function l3()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('t04_akunl3');
        $crud->set_relation('l1_id', 't02_akunl1', '{Kode} - {Nama}');
        $crud->set_relation('l2_id', 't03_akunl2', '{Kode} - {Nama}');
        $crud->display_as('l1_id', 'Akun Level-1');
        $crud->display_as('l2_id', 'Akun Level-2');
        $crud->unset_columns(array('created_at', 'updated_at'));
        $crud->unset_fields(array('created_at', 'updated_at'));

        $this->load->library('gc_dependent_select');

        $fields = array(
            'l1_id' => array(
                'table_name' => 't02_akunl1',
                'title'      => '{Kode} - {Nama}',
                'relate'     => null
            ),
            'l2_id' => array(
                'table_name' => 't03_akunl2',
                'title'      => '{Kode} - {Nama}',
                'id_field'   => 'id',
                'relate'     => 'l1_id'
            )
        );

        $config = array(
            'main_table' => 't04_akunl3',
            'main_table_primary' => 'id',
            "url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/'
        );

        $akun = new gc_dependent_select($crud, $fields, $config);

        $js = $akun->get_js();
        $output = $crud->render();

        // $output->output .= $js;
        $output->_dependent_js = $js;
        $output->_caption = 'Akun Level-3';

        $this->_example_output($output);
    }

    public function l4()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('t05_akunl4');
        $crud->set_relation('l1_id', 't02_akunl1', '{Kode} - {Nama}');
        $crud->set_relation('l2_id', 't03_akunl2', '{Kode} - {Nama}');
        $crud->set_relation('l3_id', 't04_akunl3', '{Kode} - {Nama}');
        $crud->display_as('l1_id', 'Akun Level-1');
        $crud->display_as('l2_id', 'Akun Level-2');
        $crud->display_as('l3_id', 'Akun Level-3');
        $crud->unset_columns(array('created_at', 'updated_at'));
        $crud->unset_fields(array('created_at', 'updated_at'));

        $this->load->library('gc_dependent_select');

        $fields = array(
            'l1_id' => array(
                'table_name' => 't02_akunl1',
                'title'      => '{Kode} - {Nama}',
                'relate'     => null
            ),
            'l2_id' => array(
                'table_name' => 't03_akunl2',
                'title'      => '{Kode} - {Nama}',
                'id_field'   => 'id',
                'relate'     => 'l1_id'
            ),
            'l3_id' => array(
                'table_name' => 't04_akunl3',
                'title'      => '{Kode} - {Nama}',
                'id_field'   => 'id',
                'relate'     => 'l2_id'
            )
        );

        $config = array(
            'main_table' => 't05_akunl4',
            'main_table_primary' => 'id',
            "url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/'
        );

        $akun = new gc_dependent_select($crud, $fields, $config);

        $js = $akun->get_js();
        $output = $crud->render();

        // $output->output .= $js;
        $output->_dependent_js = $js;
        $output->_caption = 'Akun Level-4';

        $this->_example_output($output);
    }

    public function l5()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('t06_akunl5');
        $crud->set_relation('l1_id', 't02_akunl1', '{Kode} - {Nama}');
        $crud->set_relation('l2_id', 't03_akunl2', '{Kode} - {Nama}');
        $crud->set_relation('l3_id', 't04_akunl3', '{Kode} - {Nama}');
        $crud->set_relation('l4_id', 't05_akunl4', '{Kode} - {Nama}');
        $crud->display_as('l1_id', 'Akun Level-1');
        $crud->display_as('l2_id', 'Akun Level-2');
        $crud->display_as('l3_id', 'Akun Level-3');
        $crud->display_as('l4_id', 'Akun Level-4');
        $crud->unset_columns(array('created_at', 'updated_at'));
        $crud->unset_fields(array('created_at', 'updated_at'));

        $this->load->library('gc_dependent_select');

        $fields = array(
            'l1_id' => array(
                'table_name' => 't02_akunl1',
                'title'      => '{Kode} - {Nama}',
                'relate'     => null
            ),
            'l2_id' => array(
                'table_name' => 't03_akunl2',
                'title'      => '{Kode} - {Nama}',
                'id_field'   => 'id',
                'relate'     => 'l1_id'
            ),
            'l3_id' => array(
                'table_name' => 't04_akunl3',
                'title'      => '{Kode} - {Nama}',
                'id_field'   => 'id',
                'relate'     => 'l2_id'
            ),
            'l4_id' => array(
                'table_name' => 't05_akunl4',
                'title'      => '{Kode} - {Nama}',
                'id_field'   => 'id',
                'relate'     => 'l3_id'
            )
        );

        $config = array(
            'main_table' => 't06_akunl5',
            'main_table_primary' => 'id',
            "url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/'
        );

        $akun = new gc_dependent_select($crud, $fields, $config);

        $js = $akun->get_js();
        $output = $crud->render();

        // $output->output .= $js;
        $output->_dependent_js = $js;
        $output->_caption = 'Akun Level-5';

        $this->_example_output($output);
    }
}
