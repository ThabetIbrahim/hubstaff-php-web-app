# Hubstaff PHP - Integrate Hubstaff API Into Your PHP App

## Using the Hubstaff PHP client

**Step 1:** include `hubstaff.php` to your php project.

```php
require_once APPPATH.'third_party/hubstaff/hubstaff.php';
```
**Step 2:** Get your [HUBSTAFF_APP_TOKEN](https://developer.hubstaff.com/my_apps), and use it to to initialize hubstaff class.
```php
$app_token = "your hubstaff app token"
$hubstaff = new hubstaff\Client($app_token);
```

**Step 3:** Define a function to retrieve a user's authentication token.

```php
	<?php
	class Home extends CI_Controller {
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
?>
```
**Step 4:** define a function to retrieve a user's report.
```php
	<?php
	class Activities extends CI_Controller {

		public function index()
		{

			require_once APPPATH.'third_party/hubstaff/hubstaff.php';
			$app_token =$this->session->userdata('app_token');
			$hubstaff = new hubstaff\Client($app_token);
			$hubstaff->set_auth_token($this->session->userdata('auth_token'));
			$data['activities'] = $hubstaff->activities("2016-05-22", "2016-05-24", array("projects" => 112761));
			$data['home'] = base_url("");
			$this->load->view('activities_view', $data);
		}
	}
	?>
```
**Step 5:** define a function to retrieve a user's screenshots.

```php
	<?php
	class Screenshots extends CI_Controller {
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
	?>
```
**Step 6:[Your Turn]** Create forms that your users can pass the
required parameters into, so that they retrieve & display the exact data they
want.

