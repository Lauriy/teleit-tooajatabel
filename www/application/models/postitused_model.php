<?php
	class Postitused_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function kysi_koik_postitused()
		{
			$this->db->order_by("kuupaev", "desc");
			$this->db->select('id, pealkiri');
			$this->db->from('postitused');
			$query = $this->db->get();
			return $query->result_array();
		}
		public function kysi_postitus()
		{
			$this->db->limit(1);
			$this->db->select('pealkiri, sisu');
			$this->db->from('postitused');
			$this->db->where('postitused.id', $this->input->get('postid'));
			$query = $this->db->get();
			return $query->result_array();
		}
		public function lisa_uus_postitus()
		{
			$data = array(
				'pealkiri' => $this->input->post('pealkiri'),
				'sisu' => $this->input->post('sisu'),
				'kuupaev' => date("y-m-d")
			);
			return $this->db->insert('postitused', $data);
		}
	}