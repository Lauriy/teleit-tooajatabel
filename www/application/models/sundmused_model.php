<?php
	class Sundmused_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_kasutaja_sundmused()
		{
			$this->db->order_by("kuupaev", "desc");
			$this->db->select('sundmused.odomeeter_algus, sundmused.odomeeter_lopp, sundmused.id, sundmused.kuupaev, sundmused.algus, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.hind_kmta, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id', $this->session->userdata('id'));
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			$praegu = getdate();
			$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($praegu['year']."-1-1")));
			$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime(($praegu['year'] + 1)."-1-1")));
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_koik_kasutaja_filtreeritud_sundmused()
		{
			$this->db->order_by("kuupaev", "desc");
			$this->db->select('sundmused.odomeeter_algus, sundmused.odomeeter_lopp, sundmused.id, sundmused.kuupaev, sundmused.algus, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.hind_kmta, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id', $this->session->userdata('id'));
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('alates'))));
			$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('kuni'))));
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_koik_kasutaja_filtreeritud_sundmused2()
		{
			$this->db->order_by("kuupaev", "desc");
			$this->db->select('sundmused.odomeeter_algus, sundmused.odomeeter_lopp, sundmused.id, sundmused.kuupaev, sundmused.algus, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.hind_kmta, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id', $this->session->userdata('id'));
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			if($this->input->get('kuu') == 1 || $this->input->get('kuu') == 3 || $this->input->get('kuu') == 5 || $this->input->get('kuu') == 7 || $this->input->get('kuu') == 8 || $this->input->get('kuu') == 10 || $this->input->get('kuu') == 12)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-31')));
			}
			else if($this->input->get('kuu') == 2 && date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-29')));
			}
			else if($this->input->get('kuu') == 2 && !date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-28')));
			}
			else
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-30')));
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_kuude_kaupa_filtreeritud_sundmused_admin()
		{
			$this->db->order_by("kuupaev", "desc");
			$this->db->select('users.username as kasutaja, sundmused.odomeeter_algus, sundmused.odomeeter_lopp, sundmused.id, sundmused.kuupaev, sundmused.algus, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.hind_kmta, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.suletud = 0');
			if($this->input->get('kuu') == 1 || $this->input->get('kuu') == 3 || $this->input->get('kuu') == 5 || $this->input->get('kuu') == 7 || $this->input->get('kuu') == 8 || $this->input->get('kuu') == 10 || $this->input->get('kuu') == 12)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-31')));
			}
			else if($this->input->get('kuu') == 2 && date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-29')));
			}
			else if($this->input->get('kuu') == 2 && !date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-28')));
			}
			else
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-30')));
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_koik_sundmused()
		{
			$this->db->select('sundmused.odomeeter_algus, sundmused.odomeeter_lopp, users.username as kasutaja, sundmused.algus, sundmused.kuupaev, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus, sundmused.id, sundmused.hind_kmta');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			$praegu = getdate();
			$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($praegu['year']."-1-1")));
			$this->db->order_by('kuupaev', 'desc');
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_lukustamata_sundmused()
		{
			$this->db->select('sundmused.odomeeter_algus, sundmused.odomeeter_lopp, users.username as kasutaja, sundmused.algus, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.kuupaev, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus, sundmused.id, sundmused.hind_kmta');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			$this->db->where('sundmused.lukustatud = 0');
			$this->db->order_by("kuupaev", "desc");
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_koik_sundmused_filtreeritult()
		{
			$this->db->select('sundmused.odomeeter_algus, sundmused.odomeeter_lopp, users.username as kasutaja, sundmused.algus, sundmused.kuupaev, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus, sundmused.id, sundmused.hind_kmta');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			if($this->input->get('kid'))
			{
				$this->db->where('sundmused.kasutaja_id', $this->input->get('kid'));
			}
			if($this->input->get('alates'))
			{
				$alates = date('Y-m-d', strtotime($this->input->get('alates')));
				$kuni = date('Y-m-d', strtotime($this->input->get('kuni')));
			}
			else
			{
				$kuu = date('m');
				$aasta = date('Y');
				$alates = date('Y-m-d', strtotime($aasta."-".$kuu."-1"));
				$kuni = date('Y-m-d', strtotime("3000-1-1"));
			}
			$this->db->where('sundmused.kuupaev >=', $alates);
			$this->db->where('sundmused.kuupaev <=', $kuni);
			$this->db->order_by("kuupaev", "desc");
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_filtreeritud_sundmused_ekspordiks()
		{
			$this->db->select('ettevotted.reg as ettevote_reg, sundmused.odomeeter_algus, sundmused.odomeeter_lopp, users.username as kasutaja, sundmused.algus, sundmused.kuupaev, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus, sundmused.id, sundmused.hind_kmta');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			if($this->input->get('kid'))
			{
				$this->db->where('sundmused.kasutaja_id', $this->input->get('kid'));
			}
			if(!$this->input->get('alates'))
			{
				$kuu = date('m');
				$aasta = date('Y');
				$alates = date('Y-m-d', strtotime($aasta."-".$kuu."-1"));
				$kuni = date('Y-m-d', strtotime("3000-1-1"));
			}
			else
			{
				$alates = date('Y-m-d', strtotime($this->input->get('alates')));
				$kuni = date('Y-m-d', strtotime($this->input->get('kuni')));
			}
			$this->db->where('sundmused.kuupaev >=', $alates);
			$this->db->where('sundmused.kuupaev <=', $kuni);
			$this->db->order_by("kuupaev", "desc");
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_filtreeritud_sundmused_ekspordiks2()
		{
			$this->db->select('ettevotted.reg as ettevote_reg, sundmused.odomeeter_algus, sundmused.odomeeter_lopp, users.username as kasutaja, sundmused.algus, sundmused.kuupaev, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus, sundmused.id, sundmused.hind_kmta');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			if($this->input->get('kuu') == 1 || $this->input->get('kuu') == 3 || $this->input->get('kuu') == 5 || $this->input->get('kuu') == 7 || $this->input->get('kuu') == 8 || $this->input->get('kuu') == 10 || $this->input->get('kuu') == 12)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-31')));
			}
			else if($this->input->get('kuu') == 2 && date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-29')));
			}
			else if($this->input->get('kuu') == 2 && !date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-28')));
			}
			else if($this->input->get('kuu') == 4 || $this->input->get('kuu') == 6 || $this->input->get('kuu') == 9 || $this->input->get('kuu') == 11)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-30')));
			}
			$this->db->order_by("kuupaev", "desc");
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_filtreeritud_tulemuste_tooaeg_ja_transpordiaeg()
		{
			$this->db->select('liigid.nimetus as liik, sisud.nimetus as sisu, ettevotted.nimetus, sundmused.algus, sundmused.lopp, sundmused.transport, sundmused.odomeeter_lopp, sundmused.odomeeter_algus');
			$this->db->from('sundmused, ettevotted, liigid, sisud');
			$this->db->where('sundmused.suletud = 0');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			if($this->input->get('alates'))
			{
				$alates = date('Y-m-d', strtotime($this->input->get('alates')));
				$kuni = date('Y-m-d', strtotime($this->input->get('kuni')));
				$this->db->where('sundmused.kuupaev >=', $alates);
				$this->db->where('sundmused.kuupaev <=', $kuni);
			}
			else if($this->input->get('aasta'))
			{
				if($this->input->get('kuu') == 1 || $this->input->get('kuu') == 3 || $this->input->get('kuu') == 5 || $this->input->get('kuu') == 7 || $this->input->get('kuu') == 8 || $this->input->get('kuu') == 10 || $this->input->get('kuu') == 12)
				{
					$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
					$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-31')));
				}
				else if($this->input->get('kuu') == 2 && date('L'))
				{
					$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
					$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-29')));
				}
				else if($this->input->get('kuu') == 2 && !date('L'))
				{
					$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
					$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-28')));
				}
				else if($this->input->get('kuu') == 4 || $this->input->get('kuu') == 6 || $this->input->get('kuu') == 9 || $this->input->get('kuu') == 11)
				{
					$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
					$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-30')));
				}
			}
			if($this->input->get('kid'))
			{
				$this->db->where('sundmused.kasutaja_id', $this->input->get('kid'));
			}
			$query = $this->db->get();
			$results = $query->result_array();
			$vastus['minutid_toole'] = 0;
			$vastus['minutid_transpordile'] = 0;
			$vastus['kilomeetreid'] = 0;
			$vastus['tasustatud_minuteid'] = 0;
			foreach($results as $result)
			{
				$algus = strtotime($result['algus']);
				$lopp = strtotime($result['lopp']);
				$vahe = ($lopp - $algus) / 60;
				$vastus['minutid_toole'] += $vahe;
				$vastus['minutid_transpordile'] += $result['transport'];
				$vastus['kilomeetreid'] += ($result['odomeeter_lopp'] - $result['odomeeter_algus']);
				if($result['nimetus'] == 'Tele-IT OÜ')
				{
					
				}
				else if(($result['liik'] == 'Hooldus') && ($result['sisu'] != 'Kuuhooldus' || $result['sisu'] != 'Regulaarhooldus'))
				{
					
				}
				else
				{
					$vastus['tasustatud_minuteid'] += $vahe;
				}
			}
			return $vastus;
		}
		public function lisa_sundmus()
		{
			$data = array(
				'kasutaja_id' => $this->session->userdata('id'),
				'algus' => date('H:i', strtotime($this->input->post('a'))),
				'lopp' => date('H:i', strtotime($this->input->post('l'))),
				'kuupaev' => date('Y-m-d', strtotime($this->input->post('kp'))),
				'transport' => $this->input->post('t'),
				'asukoht_id' => $this->input->post('aid'),
				'ettevote_id' => $this->input->post('eid'),
				'liik_id' => $this->input->post('lid'),
				'sisu_id' => $this->input->post('sid'),
				'lisainfo' => $this->input->post('lisa'),
				'hind_kmta' => $this->input->post('hkmta'),
				'hind_kmga' => $this->input->post('hkmta') * (($this->input->post('kmtuup') / 100) + 1),
				'odomeeter_algus' => $this->input->post('odoa'),
				'odomeeter_lopp' => $this->input->post('odol'),
				'kmtuup' => $this->input->post('kmtuup')
			);
			return $this->db->insert('sundmused', $data);
		}
		public function lisa_sundmus_admin()
		{
				$data = array(
				'kasutaja_id' => $this->input->post('kid'),
				'algus' => date('H:i', strtotime($this->input->post('a'))),
				'lopp' => date('H:i', strtotime($this->input->post('l'))),
				'kuupaev' => date('Y-m-d', strtotime($this->input->post('kp'))),
				'transport' => $this->input->post('t'),
				'asukoht_id' => $this->input->post('aid'),
				'ettevote_id' => $this->input->post('eid'),
				'liik_id' => $this->input->post('lid'),
				'sisu_id' => $this->input->post('sid'),
				'lisainfo' => $this->input->post('lisa'),
				'hind_kmta' => $this->input->post('hkmta'),
				'hind_kmga' => $this->input->post('hkmta') * (($this->input->post('kmtuup') / 100) + 1),
				'odomeeter_algus' => $this->input->post('odoa'),
				'odomeeter_lopp' => $this->input->post('odol'),
				'kmtuup' => $this->input->post('kmtuup')
			);
			return $this->db->insert('sundmused', $data);
		}
		public function kustuta_sundmus()
		{
			$data = array(
				'sulgeja_id' => $this->session->userdata('id'),
				'suletud' => '1'
			);
			$this->db->set('sulgemisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->get('id'));
			$this->db->update('sundmused', $data);
		}
		public function kas_on_selle_kasutaja_sundmus()
		{
			$this->db->select('*');
			$this->db->from('sundmused');
			$this->db->where('sundmused.kasutaja_id =', $this->session->userdata('id'));
			$this->db->where('sundmused.id =', $this->input->get('id'));
			return $this->db->count_all_results();
		}
		public function kas_sundmus_on_lukustamata()
		{
			$this->db->select('sundmused.lukustatud');
			$this->db->from('sundmused');
			$this->db->where('sundmused.id =', $this->input->get('id'));
			$query = $this->db->get();
			return $query->result_array();
		}
		public function lukusta_sundmus()
		{
			$data = array(
				'muutja_id' => $this->session->userdata('id'),
				'lukustatud' => '1'
			);
			$this->db->set('muutmisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->get('id'));
			$this->db->update('sundmused', $data);
		}
		public function muuda_sundmust()
		{
			if($this->ion_auth->is_admin())
			{
				$kasutaja_id = $this->input->post('kid');
			}
			else
			{
				$kasutaja_id = $this->session->userdata('id');
			}
			$data = array(
				'kasutaja_id' => $kasutaja_id,
				'algus' => date('H:i', strtotime($this->input->post('a'))),
				'lopp' => date('H:i', strtotime($this->input->post('l'))),
				'kuupaev' => date('Y-m-d', strtotime($this->input->post('kp'))),
				'transport' => $this->input->post('t'),
				'asukoht_id' => $this->input->post('aid'),
				'ettevote_id' => $this->input->post('eid'),
				'liik_id' => $this->input->post('lid'),
				'sisu_id' => $this->input->post('sid'),
				'lisainfo' => $this->input->post('lisa'),
				'hind_kmta' => $this->input->post('hkmta'),
				'hind_kmga' => $this->input->post('hkmta') * (($this->input->post('kmtuup') / 100) + 1),
				'odomeeter_algus' => $this->input->post('odoa'),
				'odomeeter_lopp' => $this->input->post('odol'),
				'kmtuup' => $this->input->post('kmtuup')
			);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('sundmused', $data);
		}
		public function kysi_sundmus_id_jargi()
		{
			$this->db->limit(1);
			$this->db->select('sundmused.kasutaja_id, sundmused.kmtuup, sundmused.odomeeter_algus, sundmused.odomeeter_lopp, sundmused.id, sundmused.kuupaev, sundmused.algus, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, sundmused.hind_kmta, sundmused.lukustatud, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			$this->db->where('sundmused.id =', $this->input->get('id'));
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_sundmused_soidupaevikusse()
		{
			$this->db->select('sundmused.kuupaev, sundmused.odomeeter_algus, sundmused.odomeeter_lopp, ettevotted.nimetus');
			$this->db->from('sundmused');
			$this->db->from('ettevotted');
			$this->db->where('sundmused.kasutaja_id', $this->session->userdata('id'));
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.suletud = 0');
			$this->db->order_by('kuupaev', 'desc');
			$praegu = getdate();
			if($this->input->get('kuu') == 1 || $this->input->get('kuu') == 3 || $this->input->get('kuu') == 5 || $this->input->get('kuu') == 7 || $this->input->get('kuu') == 8 || $this->input->get('kuu') == 10 || $this->input->get('kuu') == 12)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-31')));
			}
			else if($this->input->get('kuu') == 2 && date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-29')));
			}
			else if($this->input->get('kuu') == 2 && !date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-28')));
			}
			else if($this->input->get('kuu') == 4 || $this->input->get('kuu') == 6 || $this->input->get('kuu') == 9 || $this->input->get('kuu') == 11)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-30')));
			}
			else
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($praegu['year'].'-'.$praegu['month'].'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($praegu['year'].'-'.$praegu['month'].'-31')));
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_valitud_sundmused_ekspordiks()
		{
			$this->db->select('ettevotted.reg as ettevote_reg, sundmused.odomeeter_algus, sundmused.odomeeter_lopp, users.username as kasutaja, sundmused.algus, sundmused.kuupaev, sundmused.lopp, sundmused.transport,
			sundmused.lisainfo, sundmused.hind_kmga, asukohad.nimetus as asukoht_nimetus, ettevotted.nimetus as ettevote_nimetus,
			liigid.nimetus as liik_nimetus, sisud.nimetus as sisu_nimetus, sundmused.id, sundmused.hind_kmta');
			$this->db->from('users');
			$this->db->from('sundmused');
			$this->db->from('asukohad');
			$this->db->from('ettevotted');
			$this->db->from('liigid');
			$this->db->from('sisud');
			$this->db->where('sundmused.kasutaja_id = users.id');
			$this->db->where('sundmused.asukoht_id = asukohad.id');
			$this->db->where('sundmused.ettevote_id = ettevotted.id');
			$this->db->where('sundmused.liik_id = liigid.id');
			$this->db->where('sundmused.sisu_id = sisud.id');
			$this->db->where('sundmused.suletud = 0');
			$tunnused = $this->input->post('raamatupidamisse');
			$this->db->where_in('sundmused.id', $tunnused);
			if($this->input->get('kuu') == 1 || $this->input->get('kuu') == 3 || $this->input->get('kuu') == 5 || $this->input->get('kuu') == 7 || $this->input->get('kuu') == 8 || $this->input->get('kuu') == 10 || $this->input->get('kuu') == 12)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-31')));
			}
			else if($this->input->get('kuu') == 2 && date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-29')));
			}
			else if($this->input->get('kuu') == 2 && !date('L'))
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-28')));
			}
			else if($this->input->get('kuu') == 4 || $this->input->get('kuu') == 6 || $this->input->get('kuu') == 9 || $this->input->get('kuu') == 11)
			{
				$this->db->where('sundmused.kuupaev >=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-1')));
				$this->db->where('sundmused.kuupaev <=', date('Y-m-d', strtotime($this->input->get('aasta').'-'.$this->input->get('kuu').'-30')));
			}
			$this->db->order_by("kuupaev", "desc");
			$query = $this->db->get();
			return $query->result_array();
		}
	}