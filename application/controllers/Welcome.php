<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$this->load->view('landing_page');
	}

	public function start() {
	    $this->load->view('start_game');
    }
}
