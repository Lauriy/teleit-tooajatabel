<?php
	class Teataveast extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('postitused_model');
		}
		public function index()
		{
			if($this->ion_auth->logged_in())
			{
				$data['title'] = "Vigade teatamine";
				$data['postitused'] = $this->postitused_model->kysi_koik_postitused();
				$this->load->view('templates/header', $data);
				$this->load->view('postitused/index', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function lisa()
		{
			if($this->ion_auth->logged_in())
			{
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['title'] = 'Lisa uus veateade';
				$this->form_validation->set_rules('pealkiri', 'Pealkiri', 'required');
				$this->form_validation->set_rules('sisu', 'Sisu', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$data['postitused'] = $this->postitused_model->kysi_koik_postitused();
					$this->load->view('templates/header', $data);	
					$this->load->view('postitused/index', $data);
					$this->load->view('templates/footer');
				}
				else
				{
					$data['postitused'] = $this->postitused_model->kysi_koik_postitused();
					$this->postitused_model->lisa_uus_postitus();
					$this->load->view('templates/header', $data);	
					$this->load->view('postitused/index', $data);
					$this->load->view('templates/footer');
				}
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function vaata()
		{
			if($this->ion_auth->logged_in())
			{
				$data['title'] = "Vigade teatamine";
				$data['postitused'] = $this->postitused_model->kysi_postitus();
				$this->load->view('templates/header', $data);
				$this->load->view('postitused/vaata', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
	}