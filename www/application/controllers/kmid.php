<?php
	class Kmid extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('kmid_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function lisa()
		{
			if($this->ion_auth->is_admin())
			{
				$data['title'] = "K&auml;ibemaksu lisamine";
				$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
				$this->form_validation->set_rules('uus_km_nimi', 'Nimetus', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('kmid/lisa', $data);
					$this->load->view('templates/footer', $data);
				}
				else
				{
					$this->kmid_model->lisa_km();
					$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
					$this->load->view('templates/header', $data);	
					$this->load->view('kmid/lisa', $data);
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