<?php
	class Adminhaldus extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('asukohad_model');
			$this->load->model('liigid_model');
			$this->load->model('sisud_model');
			$this->load->model('kmid_model');
			$this->load->model('sundmused_model');
			$this->load->model('ettevotted_model');
			$this->load->model('kasutajad_model');
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
		public function index()
		{
			if($this->ion_auth->is_admin())
			{
				$data['title'] = "Administraatori haldus";
				$data['sundmused'] = $this->sundmused_model->kysi_koik_sundmused();
				$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
				$this->load->view('templates/header', $data);
				$this->load->view('adminhaldus/index', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function filtreeri()
		{
			if($this->ion_auth->is_admin())
			{
				$data['sundmused'] = $this->sundmused_model->kysi_koik_sundmused_filtreeritult();
				$data['title'] = "S&uuml;ndmuste nimekiri";
				$data['filteralates'] = $this->input->get('alates');
				$data['filterkuni'] = $this->input->get('kuni');
				$data['kid'] = $this->input->get('kid');
				$data['ajad'] = $this->sundmused_model->kysi_filtreeritud_tulemuste_tooaeg_ja_transpordiaeg();
				$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
				$this->load->view('templates/header', $data);
				$this->load->view('adminhaldus/filtreeri', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function filtreeri2()
		{
			if($this->ion_auth->is_admin())
			{
				$data['sundmused'] = $this->sundmused_model->kysi_kuude_kaupa_filtreeritud_sundmused_admin();
				$data['title'] = "S&uuml;ndmuste nimekiri";
				$data['ajad'] = $this->sundmused_model->kysi_filtreeritud_tulemuste_tooaeg_ja_transpordiaeg();
				$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
				$data['aasta'] = $this->input->get('aasta');
				$data['kuu'] = $this->input->get('kuu');
				$data['valitudaasta'] = $this->input->get('aasta');
				$this->load->view('templates/header', $data);
				$this->load->view('adminhaldus/filtreeri', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function lukustamata()
		{
			if($this->ion_auth->is_admin())
			{
				$data['sundmused'] = $this->sundmused_model->kysi_lukustamata_sundmused();
				$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
				$data['title'] = "Lukustamata s&uuml;ndmuste nimekiri";
				$this->load->view('templates/header', $data);
				$this->load->view('adminhaldus/index', $data);
				$this->load->view('templates/footer');
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
				$this->sundmused_model->kustuta_sundmus();
				$data['sundmused'] = $this->sundmused_model->kysi_koik_sundmused();
				$data['title'] = "S&uuml;ndmuste nimekiri";
				$this->load->view('templates/header', $data);
				if($this->input->get('alates') && $this->input->get('kuni'))
				{
					$this->load->view('adminhaldus/filtreeri', $data);
				}
				else
				{
					$this->load->view('adminhaldus/index', $data);
				}
				$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function lukusta()
		{
			if($this->ion_auth->is_admin())
			{
					$this->sundmused_model->lukusta_sundmus();
					$data['sundmused'] = $this->sundmused_model->kysi_koik_sundmused();
					$data['title'] = "S&uuml;ndmuste nimekiri";
					$this->load->view('templates/header', $data);
					if($this->input->get('alates') && $this->input->get('kuni'))
					{
						redirect('adminhaldus/filtreeri', 'refresh');
						$this->load->view('adminhaldus/filtreeri', $data);
					}
					else if($data['title'] == 'Lukustamata sündmuste nimekiri')
					{
						redirect('adminhaldus/lukustamatasundmused', 'refresh');
						$this->load->view('adminhaldus/lukustamatasundmused', $data);
					}
					else
					{
						redirect('adminhaldus', 'refresh');
						$this->load->view('/adminhaldus/index', $data);
					}
					$this->load->view('templates/footer');
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function lisasundmus()
		{
			if($this->ion_auth->is_admin())
			{
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['title'] = 'Lisa uus s&uuml;ndmus';
				$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
				$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
				$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
				$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
				$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
				$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
				$this->form_validation->set_rules('a', 'Alguse aeg', 'required');
				$this->form_validation->set_rules('l', 'L&otilde;puaeg', 'required');
				$this->form_validation->set_rules('kp', 'Kuup&auml;ev', 'required');
				$this->form_validation->set_rules('aid', 'Asukoha ID', 'required');
				$this->form_validation->set_rules('eid', 'Ettev&otilde;tte ID', 'required');
				$this->form_validation->set_rules('lid', 'Liik ID', 'required');
				$this->form_validation->set_rules('sid', 'Sisu ID', 'required');
				$this->form_validation->set_rules('kid', 'Kasutaja ID', 'required');
				$this->form_validation->set_rules('lisa', 'Lisainfo', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);	
					$this->load->view('adminhaldus/lisasundmus', $data);
					$this->load->view('templates/footer');
				}
				else
				{
					$this->sundmused_model->lisa_sundmus_admin();
					$this->load->view('templates/header', $data);	
					$this->load->view('adminhaldus/lisasundmus', $data);
					$this->load->view('templates/footer');
				}
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
		public function muuda_sundmust()
		{
			if($this->ion_auth->logged_in())
			{
				if($this->ion_auth->is_admin())
				{
					$this->load->helper('form');
					$this->load->library('form_validation');
					$data['sundmused'] = $this->sundmused_model->kysi_sundmus_id_jargi();
					$data['ettevotted'] = $this->ettevotted_model->kysi_koik_ettevotted();
					$data['asukohad'] = $this->asukohad_model->kysi_koik_asukohad();
					$data['liigid'] = $this->liigid_model->kysi_koik_liigid();
					$data['sisud'] = $this->sisud_model->kysi_koik_sisud();
					$data['kmid'] = $this->kmid_model->kysi_koik_kmid();
					$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
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
						$this->load->view('adminhaldus/muuda', $data);
						$this->load->view('templates/footer');
					}
					else
					{
						$this->sundmused_model->muuda_sundmust();
						$data['title'] = "Administraatori haldus";
						$data['sundmused'] = $this->sundmused_model->kysi_koik_sundmused();
						$data['kasutajad'] = $this->kasutajad_model->kysi_koik_kasutajad();
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
		public function ekspordi()
		{
			if($this->ion_auth->is_admin())
			{
				if($this->input->get('alates'))
				{
					$data['sundmused'] = $this->sundmused_model->kysi_filtreeritud_sundmused_ekspordiks();
				}
				else if(!$this->input->get('alates'))
				{
					$data['sundmused'] = $this->sundmused_model->kysi_filtreeritud_sundmused_ekspordiks();
				}
				else if($this->input->get('aasta'))
				{
					$data['sundmused'] = $this->sundmused_model->kysi_filtreeritud_sundmused_ekspordiks2();
				}
				else if($this->input->post('raamatupidamisse'))
				{
					$data['sundmused'] = $this->sundmused_model->kysi_valitud_sundmused_ekspordiks();
				}
				$data['title'] = 'XML eksport';
				$this->load->view('adminhaldus/ekspordi', $data);
			}
			else
			{
				show_error('Ligip&auml;&auml;s keelatud!', 403);
			}
		}
	}