<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Screenshots extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
			
		require_once APPPATH.'third_party/hubstaff/hubstaff.php';
		$app_token =$this->session->userdata('app_token');
		$hubstaff = new hubstaff\Client($app_token);
		$hubstaff->set_auth_token($this->session->userdata('auth_token'));
		$data['screenshots'] = $hubstaff->screenshots("2016-05-22", "2016-05-24", array("projects" => 112761));
		$data['home'] = base_url("");
		$this->load->view('screenshots_view', $data);
	}

	
	
}
