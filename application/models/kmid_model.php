<?php
	class Kmid_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_kmid()
		{
			$this->db->order_by("id", "asc");
			$query = $this->db->get_where('kmid', array('suletud' => '0'));
			return $query->result_array();
		}
		public function lisa_km()
		{
			$data = array(
				'avaja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_km_nimi')
			);
			$this->db->set('avamisaeg', 'NOW()', false);
			return $this->db->insert('kmid', $data);
		}
		public function muuda_km()
		{
			$data = array(
				'muutja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_km_nimi')
			);
			$this->db->set('muutmisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('muudetava_km_id'));
			$this->db->update('kmid', $data); 
		}
		public function kustuta_km()
		{
			$data = array(
				'sulgeja_id' => $this->session->userdata('id'),
				'suletud' => '1'
			);
			$this->db->set('sulgemisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('kustutatava_km_id'));
			$this->db->update('kmid', $data);
		}
	}
	