<?php
	class Liigid_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_liigid()
		{
			$this->db->order_by("id", "asc");
			$query = $this->db->get_where('liigid', array('suletud' => '0'));
			return $query->result_array();
		}
		public function lisa_liik()
		{
			$data = array(
				'avaja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_liigi_nimi')
			);
			$this->db->set('avamisaeg', 'NOW()', false);
			return $this->db->insert('liigid', $data);
		}
		public function muuda_liik()
		{
			$data = array(
				'muutja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_liigi_nimi')
			);
			$this->db->set('muutmisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('muudetava_liigi_id'));
			$this->db->update('liigid', $data); 
		}
		public function kustuta_liik()
		{
			$data = array(
				'sulgeja_id' => $this->session->userdata('id'),
				'suletud' => '1'
			);
			$this->db->set('sulgemisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('kustutatava_liigi_id'));
			$this->db->update('liigid', $data);
		}
	}
	