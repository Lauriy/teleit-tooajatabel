<?php
	//require_once('recaptchalib.php');
	defined('BASEPATH') OR exit('No direct script access allowed');
	if (!class_exists('Controller'))
	{
		class Controller extends CI_Controller {}
	}
	class Auth extends Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('ion_auth');
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->database();
			$this->load->helper('url');
			$this->load->model('kasutajad_model');
		}
		function login()
		{
			$this->data['title'] = "Login";
			//$privatekey = "6Ldk388SAAAAADNvzPmyfJ7--q-iP8GlvPpAwMtU";
			if ($this->ion_auth->logged_in())
			{
				redirect($this->config->item('base_url'), 'refresh');
			}
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == true)
			{
				//$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
				//if(!$resp->is_valid)
				//{
					//redirect('auth/login', 'refresh');
				//}
				//else
				//{
					$remember = (bool) $this->input->post('remember');
					if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect($this->config->item('base_url'), 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/login', 'refresh');
					}
				//}
			}
			else
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['email'] = array('name' => 'email',
					'id' => 'email',
					'type' => 'text',
					'value' => $this->form_validation->set_value('email'),
				);
				$this->data['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
				);
				$this->load->view('templates/header', $this->data);
				$this->load->view('auth/login', $this->data);
				$this->load->view('templates/footer', $this->data);
			}
		}
		function logout()
		{
			$this->data['title'] = "Logout";
			$logout = $this->ion_auth->logout();
			redirect('', 'refresh');
		}
		function change_password()
		{
			$this->form_validation->set_rules('old', 'Old password', 'required');
			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');
			$this->data['title'] = "Muuda parooli";
			if (!$this->ion_auth->logged_in())
			{
				redirect('auth/login', 'refresh');
			}
			$user = $this->ion_auth->get_user($this->session->userdata('user_id'));
			if ($this->form_validation->run() == false)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['old_password'] = array('name' => 'old',
					'id' => 'old',
					'type' => 'password',
				);
				$this->data['new_password'] = array('name' => 'new',
					'id' => 'new',
					'type' => 'password',
				);
				$this->data['new_password_confirm'] = array('name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
				);
				$this->data['user_id'] = array('name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				);
				$this->load->view('templates/header', $this->data);
				$this->load->view('auth/change_password', $this->data);
				$this->load->view('templates/footer', $this->data);
			}
			else
			{
				$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
				$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
				if ($change)
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->logout();
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/change_password', 'refresh');
				}
			}
		}
		function change_password_admin()
		{
			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');
			$this->data['title'] = "Muuda kasutaja parooli";
			if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
			{
				redirect('auth/login', 'refresh');
			}
			$user = $this->ion_auth->get_user($this->input->post('user_id'));
			if ($this->form_validation->run() == false)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['new_password'] = array('name' => 'new',
					'id' => 'new',
					'type' => 'password',
				);
				$this->data['new_password_confirm'] = array('name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
				);
				$this->data['user_id'] = array('name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $this->input->get('user_id'),
				);
				$this->load->view('templates/header', $this->data);
				$this->load->view('auth/change_password_admin', $this->data);
				$this->load->view('templates/footer', $this->data);
			}
			else
			{
				$identity = $user->email;
				$change = $this->ion_auth->change_password_admin($identity, $this->input->post('new'));
				if ($change)
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('adminhaldus/index', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/change_password_admin', 'refresh');
				}
			}
		}
		function forgot_password()
		{
			$identity = $this->config->item('identity', 'ion_auth');
			$identity_human = ucwords(str_replace('_', ' ', $identity));
			$this->form_validation->set_rules($identity, $identity_human, 'required');
			if ($this->form_validation->run() == false)
			{
				$this->data[$identity] = array('name' => $identity,
					'id' => $identity,
				);
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['identity'] = $identity; $this->data['identity_human'] = $identity_human;
				$this->load->view('templates/header', $this->data);
				$this->load->view('auth/forgot_password', $this->data);
				$this->load->view('templates/footer', $this->data);
			}
			else
			{
				$forgotten = $this->ion_auth->forgotten_password($this->input->post($identity));
				if ($forgotten)
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('auth/login', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/forgot_password', 'refresh');
				}
			}
		}
		public function reset_password($code)
		{
			$reset = $this->ion_auth->forgotten_password_complete($code);

			if ($reset)
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('auth/login', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/forgot_password', 'refresh');
			}
		}
		function activate($id, $code=false)
		{
			if ($code !== false)
				$activation = $this->ion_auth->activate($id, $code);
			else if ($this->ion_auth->is_admin())
				$activation = $this->ion_auth->activate($id);
			if ($activation)
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('adminhaldus/lisakasutaja', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('adminhaldus/lisakasutaja', 'refresh');
			}
		}
		function deactivate($id = NULL)
		{
			$id = (int)$this->input->get('user_id');
			$this->form_validation->set_rules('confirm', 'confirmation', 'required');
			$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');
			$this->data['title'] = 'Desaktiveeri kasutaja';
			if ($this->form_validation->run() == FALSE)
			{
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['user'] = $this->ion_auth->get_user_array($id);
				$this->load->view('templates/header', $this->data);
				$this->load->view('auth/deactivate_user', $this->data);
				$this->load->view('templates/footer', $this->data);
			}
			else
			{
				if ($this->input->post('confirm') == 'yes')
				{
					if ($this->_valid_csrf_nonce() === FALSE)
					{
						show_404();
					}
					if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
					{
						$this->ion_auth->deactivate($this->input->post('id'));
						$this->data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad_haldus();
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						$this->data['first_name'] = array('name' => 'first_name',
							'id' => 'first_name',
							'type' => 'text',
							'value' => $this->form_validation->set_value('first_name'),
						);
						$this->data['last_name'] = array('name' => 'last_name',
							'id' => 'last_name',
							'type' => 'text',
							'value' => $this->form_validation->set_value('last_name'),
						);
						$this->data['email'] = array('name' => 'email',
							'id' => 'email',
							'type' => 'text',
							'value' => $this->form_validation->set_value('email'),
						);
						$this->data['password'] = array('name' => 'password',
							'id' => 'password',
							'type' => 'password',
							'value' => $this->form_validation->set_value('password'),
						);
						$this->data['password_confirm'] = array('name' => 'password_confirm',
							'id' => 'password_confirm',
							'type' => 'password',
							'value' => $this->form_validation->set_value('password_confirm'),
						);
						$this->load->view('templates/header', $this->data);
						$this->load->view('auth/create_user', $this->data);
						$this->load->view('templates/footer', $this->data);
					}
				}
			}
		}
		function create_user()
		{
			$this->data['title'] = "Lisa kasutaja";
			$this->data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad_haldus();
			if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
			{
				redirect('auth', 'refresh');
			}
			$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
			if ($this->form_validation->run() == true)
			{
				$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$additional_data = array('first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name')
				);
			}
			if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
			{
				$this->session->set_flashdata('message', "User Created");
				$this->data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
				redirect('lisakasutaja', 'refresh');
			}
			else
			{
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['first_name'] = array('name' => 'first_name',
					'id' => 'first_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('first_name'),
				);
				$this->data['last_name'] = array('name' => 'last_name',
					'id' => 'last_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('last_name'),
				);
				$this->data['email'] = array('name' => 'email',
					'id' => 'email',
					'type' => 'text',
					'value' => $this->form_validation->set_value('email'),
				);
				$this->data['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
					'value' => $this->form_validation->set_value('password'),
				);
				$this->data['password_confirm'] = array('name' => 'password_confirm',
					'id' => 'password_confirm',
					'type' => 'password',
					'value' => $this->form_validation->set_value('password_confirm'),
				);
				$this->load->view('templates/header', $this->data);
				$this->load->view('auth/create_user', $this->data);
				$this->load->view('templates/footer', $this->data);
			}
		}
		function _get_csrf_nonce()
		{
			$this->load->helper('string');
			$key = random_string('alnum', 8);
			$value = random_string('alnum', 20);
			$this->session->set_flashdata('csrfkey', $key);
			$this->session->set_flashdata('csrfvalue', $value);

			return array($key => $value);
		}
		function _valid_csrf_nonce()
		{
			if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
					$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}