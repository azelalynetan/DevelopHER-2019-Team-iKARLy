<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('item_model');
    }

    public function index() {

        $char_stuff = array (
            'characters' => $this->item_model->fetch('women_tbl'),
            'questions' => $this->item_model->fetch('question_tbl'),
        );

		$this->load->view('landing_page', $char_stuff);
	}

//	public function form_upload() {
//        $this->load->view('upload_form', array('error' => ' ' ));
//    }
//
//    public function do_upload() {
//        $config['upload_path'] = './uploads/';
//        $config['allowed_types'] = 'jpg|png';
//        $config['file_ext_tolower'] = true;
//
//        $this->load->library('upload', $config);
//
//        if ($this->upload->do_upload('charfile')):
//            $data = array(
//                'women_name' => 'Maria Ressa',
//                'women_img' => $this->upload->data('file_name'),
//                'unlocked' => 0,
//            );
//
//            if(!$this->item_model->insertData('women_tbl',$data)):
//                echo "failed insert to db";
//            endif;
//        else: echo "failed upload"; endif;
//    }

    public function logout() {
        redirect('game');
    }
}
