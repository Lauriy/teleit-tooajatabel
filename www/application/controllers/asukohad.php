<?php
	class Asukohad extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('asukohad_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function lisa()
		{
			if($this->ion_auth->is_admin())
			{
				$data['title'] = "Asukoha lisamine";
				$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
				$this->form_validation->set_rules('uus_asukoha_nimi', 'Nimetus', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('asukohad/lisa', $data);
					$this->load->view('templates/footer', $data);
				}
				else
				{
					$this->asukohad_model->lisa_asukoht();
					$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
					$this->load->view('templates/header', $data);	
					$this->load->view('asukohad/lisa', $data);
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