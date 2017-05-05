<?php
	class Ettevotted_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_ettevotted()
		{
			$this->db->order_by("nimetus", "asc");
			$query = $this->db->get_where('ettevotted', array('suletud' => '0'));
			return $query->result_array();
		}
		public function lisa_ettevote()
		{
			$data = array(
				'avaja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_ettevotte_nimi'),
				'reg' => $this->input->post('uus_ettevotte_reg')
			);
			$this->db->set('avamisaeg', 'NOW()', false);
			return $this->db->insert('ettevotted', $data);
		}
		public function muuda_ettevote()
		{
			$data = array(
				'muutja_id' => $this->session->userdata('id'),
				'nimetus' => $this->input->post('uus_ettevotte_nimi')
			);
			$this->db->set('muutmisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('muudetava_ettevotte_id'));
			$this->db->update('ettevotted', $data); 
		}
		public function kustuta_ettevote()
		{
			$data = array(
				'sulgeja_id' => $this->session->userdata('id'),
				'suletud' => '1'
			);
			$this->db->set('sulgemisaeg', 'NOW()', false);
			$this->db->where('id', $this->input->post('kustutatava_ettevotte_id'));
			$this->db->update('ettevotted', $data);
		}
	}
	