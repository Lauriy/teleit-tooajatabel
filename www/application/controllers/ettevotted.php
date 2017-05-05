<?php
	class Ettevotted extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('ettevotted_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function lisa()
		{
			if($this->ion_auth->logged_in())
			{
				$data['title'] = "Ettev&otilde;tte lisamine";
				$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
				$this->form_validation->set_rules('uus_ettevotte_nimi', 'Nimetus', 'required');
				$this->form_validation->set_rules('uus_ettevotte_reg', 'Registrikood', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('ettevotted/lisa', $data);
					$this->load->view('templates/footer', $data);
				}
				else
				{
					$this->ettevotted_model->lisa_ettevote();
					$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
					$this->load->view('templates/header', $data);	
					$this->load->view('ettevotted/lisa', $data);
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
			if($this->ion_auth->logged_in())
			{
			
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function kustuta()
		{
			if($this->ion_auth->logged_in())
			{

			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
	}