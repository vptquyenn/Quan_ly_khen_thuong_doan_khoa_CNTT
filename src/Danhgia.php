<?php

namespace Ct271\Labs;

class Danhgia extends Contact
{
	private $db;
	private $id = -1;
    public $stt;
	public $m_tc;
	public $ten_tc;
	public $diem_td;
	public $dl_k;
	public $sv_dg;
	public $cvht_dg;
	public $thuong_tru;
	public $diem_t;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
        if (isset($data['stt'])) {
			$this->stt = trim($data['stt']);
		}

		if (isset($data['m_tc'])) {
			$this->m_tc = trim($data['m_tc']);
		}

		if (isset($data['ten_tc'])) {
			$this->ten_tc = trim($data['ten_tc']);
		}

		if (isset($data['diem_td'])) {
			$this->diem_td = trim($data['diem_td']);
		}

		if (isset($data['dl_k'])) {
			$this->dl_k = trim($data['dl_k']);
		}

		if (isset($data['sv_dg'])) {
			$this->sv_dg = trim($data['sv_dg']);
		}

		if (isset($data['cvht_dg'])) {
			$this->cvht_dg = trim($data['cvht_dg']);
		}

		if (isset($data['diem_t'])) {
			$this->diem_t = trim($data['diem_t']);
		}

		if (isset($data['diem_tl'])) {
			$this->diem_tl = trim($data['diem_tl']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->ten_tc) {
			$this->errors['ten_tc'] = 'Tên Tiêu Chí Không Rỗng.';
		}

        if (!$this->mssv) {
			$this->errors['mssv'] = 'MSSV Không Rỗng.';
		}

		return empty($this->errors);
	}

	public function all()
	{
		$list_danhgia = [];

		$stmt = $this->db->prepare('select * from list_danhgia');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$danhgia = new Danhgia($this->db);
			$danhgia->fillFromDB($row);
			$list_danhgia[] = $danhgia;
		} 

		return $list_danhgia;
	} 
	
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
            'stt' => $this->stt,
			'm_tc' => $this->m_tc,
			'ten_tc' => $this->ten_tc,
			'diem_td' => $this->diem_td,
			'dl_k' => $this->dl_k,
			'sv_dg' => $this->sv_dg,
			'cvht_dg' => $this->cvht_dg,
			'diem_t' => $this->diem_t,
		] = $row;
		return $this;
	}

	public function save()
		{
			$result = false;

			if ($this->id >= 0) {
				$stmt = $this->db->prepare('update list_danhgia set stt = :stt, m_tc = :m_tc,
					ten_tc = :ten_tc, diem_td = :diem_td, dl_k = :dl_k, sv_dg = :sv_dg, cvht_dg = :cvht_dg, diem_t = :diem_t
					where id = :id');
				$result = $stmt->execute([
                    'stt' => $this->stt,
					'm_tc' => $this->m_tc,
					'ten_tc' => $this->ten_tc,
					'diem_td' => $this->diem_td,
					'dl_k' => $this->dl_k,
					'sv_dg' => $this->sv_dg,
					'cvht_dg' => $this->cvht_dg,
					'diem_t' => $this->diem_t,
					'id' => $this->id]);
			} 	else {
				$stmt = $this->db->prepare(
					'insert into list_danhgia (stt, m_tc, ten_tc, diem_td, dl_k, sv_dg, cvht_dg, diem_t)
					values (:stt, :m_tc, :ten_tc, :diem_td, :dl_k, :sv_dg, :cvht_dg, :diem_t)');
				$result = $stmt->execute([
                    'stt' => $this->stt,
					'm_tc' => $this->m_tc,
					'ten_tc' => $this->ten_tc,
					'diem_td' => $this->diem_td,
					'dl_k' => $this->dl_k,
					'sv_dg' => $this->sv_dg,
					'cvht_dg' => $this->cvht_dg,
					'diem_t' => $this->diem_t]);
				if ($result) {
					$this->id = $this->db->lastInsertId();
				}
			} 
			
			return $result;
		}
	
		public function find($id)
		{
			$stmt = $this->db->prepare('select * from list_danhgia where id = :id');
			$stmt->execute(['id' => $id]);

			if ($row = $stmt->fetch()) {
				$this->fillFromDB($row);
				return $this;
			} 
			
			return null;
		} 
		
		public function update(array $data)
		{
			$this->fill($data);
			if ($this->validate()) {
				return $this->save();
			} 
			return false;
		}

		public function delete()
		{
			$stmt = $this->db->prepare('delete from list_danhgia where id = :id');
			return $stmt->execute(['id' => $this->id]);
		}
}