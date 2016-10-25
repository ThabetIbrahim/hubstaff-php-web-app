# Hubstaff PHP - Integrate Hubstaff API Into Your PHP App

## Using the Hubstaff Ruby API client

**Step 1:** include `hubstaff.php` to your php project`.

```php
require_once APPPATH.'third_party/hubstaff/hubstaff.php';
```
**Step 2:** Get your [HUBSTAFF_APP_TOKEN](https://developer.hubstaff.com/my_apps), and use it to to initialize hubstaff class.
```php
$app_token = "your hubstaff app token"
$hubstaff = new hubstaff\Client($app_token);
```
**Step 3:** Use hubstaff functions in your controllers.

```php
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
```
**Step 4:[Your Turn]** Create forms that your users can pass the
required parameters into, so that they retrieve & display the exact data they
want.
