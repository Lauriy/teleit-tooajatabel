<?php
	class Sisud extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('sisud_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function lisa()
		{
			if($this->ion_auth->is_admin())
			{
				$data['title'] = "Sisu lisamine";
				$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
				$this->form_validation->set_rules('uus_sisu_nimi', 'Nimetus', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('sisud/lisa', $data);
					$this->load->view('templates/footer', $data);
				}
				else
				{
					$this->sisud_model->lisa_sisu();
					$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
					$this->load->view('templates/header', $data);	
					$this->load->view('sisud/lisa', $data);
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