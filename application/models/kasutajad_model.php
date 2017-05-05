<?php
	class Kasutajad_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_kasutajad()
		{
			$this->db->select('users.username, users.id');
			$this->db->from('users');
			$this->db->where('users.active = 1');
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_koik_kasutajad_haldus()
		{
			$this->db->select('users.username, users.id, users.active');
			$this->db->from('users');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>