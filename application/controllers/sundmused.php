<?php
	class Sundmused extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('sundmused_model');
			$this->load->model('asukohad_model');
			$this->load->model('ettevotted_model');
			$this->load->model('liigid_model');
			$this->load->model('sisud_model');
			$this->load->model('kmid_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function index()
		{
			if($this->ion_auth->logged_in())
			{
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['title'] = "S&uuml;ndmuste nimekiri";
				$data['sundmused'] = $this->sundmused_model->kysi_koik_kasutaja_sundmused();
				$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
				$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
				$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
				$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
				$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
				$data['jooksevaasta'] = date("Y");
				$this->form_validation->set_rules('a', 'Alguse aeg', 'required');
				$this->form_validation->set_rules('l', 'L&otilde;puaeg', 'required');
				$this->form_validation->set_rules('aid', 'Asukoha ID', 'required');
				$this->form_validation->set_rules('eid', 'Ettev&otilde;tte ID', 'required');
				$this->form_validation->set_rules('lid', 'Liik ID', 'required');
				$this->form_validation->set_rules('sid', 'Sisu ID', 'required');
				$this->form_validation->set_rules('lisa', 'Lisainfo', 'required');
				$this->form_validation->set_rules('kmtuup', 'Käibemaksu tüüp', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('sundmused/index', $data);
					$this->load->view('templates/footer');
				}
				else
				{
					$this->sundmused_model->lisa_sundmus();
					$data['sundmused'] = $this->sundmused_model->kysi_koik_kasutaja_sundmused();
					$this->load->view('templates/header', $data);	
					$this->load->view('sundmused/index', $data);
					$this->load->view('templates/footer');
				}
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function filtreeri()
		{
			if($this->ion_auth->logged_in())
			{
				$data['sundmused'] = $this->sundmused_model->kysi_koik_kasutaja_filtreeritud_sundmused();
				$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
				$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
				$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
				$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
				$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
				$data['title'] = "S&uuml;ndmuste nimekiri";
				$this->load->view('templates/header', $data);
				$this->load->view('sundmused/index', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function filtreeri2()
		{
			if($this->ion_auth->logged_in())
			{
				$data['sundmused'] = $this->sundmused_model->kysi_koik_kasutaja_filtreeritud_sundmused2();
				$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
				$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
				$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
				$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
				$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
				$data['valitudaasta'] = $this->input->get('aasta');
				$data['title'] = "S&uuml;ndmuste nimekiri";
				$this->load->view('templates/header', $data);
				$this->load->view('sundmused/index', $data);
				$this->load->view('templates/footer');
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
				if($this->ion_auth->is_admin() || ($this->sundmused_model->kas_on_selle_kasutaja_sundmus() && ($this->sundmused_model->kas_sundmus_on_lukustamata() == 0)))
				{
					$this->sundmused_model->kustuta_sundmus();
					$data['sundmused'] = $this->sundmused_model->kysi_koik_kasutaja_sundmused();
					$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
					$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
					$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
					$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
					$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
					$data['title'] = "S&uuml;ndmuste nimekiri";
					$this->load->view('templates/header', $data);
					$this->load->view('sundmused/index', $data);
					$this->load->view('templates/footer');
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
				if(($this->sundmused_model->kas_on_selle_kasutaja_sundmus()) && ($this->sundmused_model->kas_sundmus_on_lukustamata()))
				{
					$this->load->helper('form');
					$this->load->library('form_validation');
					$data['sundmused'] = $this->sundmused_model->kysi_sundmus_id_jargi();
					$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
					$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
					$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
					$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
					$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
					$data['title'] = "S&uuml;ndmuse muutmine";
					$this->form_validation->set_rules('a', 'Alguse aeg', 'required');
					$this->form_validation->set_rules('l', 'L&otilde;puaeg', 'required');
					$this->form_validation->set_rules('t', 'Transpordi minutid', 'required');
					$this->form_validation->set_rules('aid', 'Asukoha ID', 'required');
					$this->form_validation->set_rules('eid', 'Ettev&otilde;tte ID', 'required');
					$this->form_validation->set_rules('lid', 'Liik ID', 'required');
					$this->form_validation->set_rules('sid', 'Sisu ID', 'required');
					$this->form_validation->set_rules('lisa', 'Lisainfo', 'required');
					$this->form_validation->set_rules('kmtuup', 'Käibemaksu tüüp', 'required');
					if ($this->form_validation->run() === FALSE)
					{
						$data['sundmused'] = $this->sundmused_model->kysi_sundmus_id_jargi();
						$this->load->view('templates/header', $data);	
						$this->load->view('sundmused/muuda', $data);
						$this->load->view('templates/footer');
					}
					else
					{
						$this->sundmused_model->muuda_sundmust();
						$data['sundmused'] = $this->sundmused_model->kysi_sundmus_id_jargi();
						$this->load->view('templates/header', $data);	
						$this->load->view('adminhaldus/index', $data);
						$this->load->view('templates/footer');
					}
				}
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function soidupaevik()
		{
			if($this->ion_auth->logged_in())
			{
				$data['sundmused'] = $this->sundmused_model->kysi_sundmused_soidupaevikusse();
				$data['title'] = 'Minu s&otilde;idup&auml;evik';
				$data['valitudaasta'] = $this->input->get('aasta');
				$this->load->view('templates/header', $data);	
				$this->load->view('soidupaevik/index', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
	}