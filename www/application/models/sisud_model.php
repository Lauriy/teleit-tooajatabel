<?php
	class Sisud_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_sisud()
		{
			$this->db->order_by("id", "asc");
			$query = $this->db->get_where('sisud', array('suletud' => '0'));
			return $query->result_array();
		}
		public function lisa_sisu()
		{
			$data = array(
				'avaja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_sisu_nimi')
			);
			$this->db->set('avamisaeg', 'NOW()', false);
			return $this->db->insert('sisud', $data);
		}
		public function muuda_sisu()
		{
			$data = array(
				'muutja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_sisu_nimi')
			);
			$this->db->set('muutmisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('muudetava_sisu_id'));
			$this->db->update('sisud', $data); 
		}
		public function kustuta_sisu()
		{
			$data = array(
				'sulgeja_id' => $this->session->userdata('id'),
				'suletud' => '1'
			);
			$this->db->set('sulgemisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('kustutatava_sisu_id'));
			$this->db->update('sisud', $data);
		}
	}
	