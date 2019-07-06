<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_queries');
    }

    public function index() {
		$this->load->view('landing_page');
	}

    public function upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_ext_tolower'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bg')):
            $data = array(
                'women_name' => 'Aisa Mijano',
                'women_img' => $this->upload->data('file_name'),
                'unlocked' => 1,
            );

            if(!$this->db_queries->insertData('women_tbl',$data)):
                echo "failed insert to db";
            endif;
        else: echo "failed upload"; endif;
    }
}
