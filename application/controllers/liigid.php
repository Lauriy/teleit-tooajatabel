<?php
	class Liigid extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('liigid_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function lisa()
		{
			if($this->ion_auth->is_admin())
			{
				$data['title'] = "Liigi lisamine";
				$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
				$this->form_validation->set_rules('uus_liigi_nimi', 'Nimetus', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('liigid/lisa', $data);
					$this->load->view('templates/footer', $data);
				}
				else
				{
					$this->liigid_model->lisa_liik();
					$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
					$this->load->view('templates/header', $data);	
					$this->load->view('liigid/lisa', $data);
					$this->load->view('templates/footer', $data);
				}
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function muuda()
		{
			if($this->ion_auth->is_admin())
			{
			
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function kustuta()
		{
			if($this->ion_auth->is_admin())
			{

			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
	}