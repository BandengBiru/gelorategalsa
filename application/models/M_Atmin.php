<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Atmin extends CI_Model
{
	public function getAllAtmin()
	{
		// queri sql
		// SELECT * FROM user;

		// query builder
		return $this->db->get('atmin')->result();
	}

	// mengambil 1 data user berdasarkan id
	public function getOneAtmin($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('atmin')->row();
	}

	// untuk hapus data user
	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('atmin');
	}

	// untuk tambah data user
	public function addAtmin($data)
	{
		return $this->db->insert('atmin', $data);
	}

	// untuk edit data user
	public function editAtmin($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('atmin', $data);
	}
}
