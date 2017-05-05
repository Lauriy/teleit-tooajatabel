<?php
	class Asukohad_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_asukohad()
		{
			$this->db->order_by("id", "asc");
			$query = $this->db->get_where('asukohad', array('suletud' => '0'));
			return $query->result_array();
		}
		public function lisa_asukoht()
		{
			$data = array(
				'avaja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_asukoha_nimi'),
				'suletud' => 0
			);
			$this->db->set('avamisaeg', 'NOW()', false);
			return $this->db->insert('asukohad', $data);
		}
		public function muuda_asukoht()
		{
			$data = array(
				'muutja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_asukoha_nimi')
			);
			$this->db->set('muudetud', 'NOW()', false);
			$this->db->where('id', $this->input->post('muudetava_asukoha_id'));
			$this->db->update('asukohad', $data); 
		}
		public function kustuta_asukoht()
		{
			$data = array(
				'sulgeja_id' => $this->session->userdata('id'),
				'suletud' => '1'
			);
			$this->db->where('id', $this->input->post('kustutatava_asukoha_id'));
			$this->db->update('asukohad', $data);
		}
	}
	