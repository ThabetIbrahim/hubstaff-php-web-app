<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$is_logged = $this->session->userdata('logged');
		$data['url'] = base_url("connect");
		if($is_logged)
		{
			$data['logged'] = 1;	
			$data['email'] = $this->session->userdata('email');
			if($this->session->userdata('auth_token'))
			{
				$data['auth_token'] = $this->session->userdata('auth_token');
				$data['act_url'] = base_url("index.php/activities");
				$data['screenshots_url'] = base_url("index.php/screenshots");

			}
		}
		
		$this->load->view('home', $data);
	}
	
	public function login()
	{
		$form_data = $this->input->post();
		$this->session->set_userdata(array('email' => $this->input->post("email"), "logged" => 1));
		redirect('index.php/home');
	}
	
	public function connect()
	{
		require_once APPPATH.'third_party/hubstaff/hubstaff.php';
		
		
		$app_token = $this->input->post("app_token");
		
		$email = $this->input->post("email");
		
		$password = $this->input->post("password");

		$hubstaff = new hubstaff\Client($app_token);
		if(!$this->session->userdata('auth_token'))
		{
			$hubstaff->auth($email, $password);
			$auth_token = $hubstaff->get_auth_token();
			$this->session->set_userdata(array('auth_token' => $auth_token));
		}
		redirect(base_url('index.php/home')); 

	}
	
	
}
