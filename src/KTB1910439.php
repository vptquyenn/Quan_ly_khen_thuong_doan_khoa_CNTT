<?php

namespace Ct271\Labs;

class KTB1910439 extends B1910439
{
	private $db;
	private $id = -1;
	public $noidung_hoatdong;
	public $hoc_ki;
	public $diemrl;
	public $xeploai;
	public $created_at;
	public $updated_at;
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
		if (isset($data['noidung_hoatdong'])) {
			$this->noidung_hoatdong = trim($data['noidung_hoatdong']);
		}

		if (isset($data['hoc_ki'])) {
			$this->hoc_ki = trim($data['hoc_ki']);
		}

		if (isset($data['diemrl'])) {
			$this->diemrl = trim($data['diemrl']);
		}

		if (isset($data['xeploai'])) {
			$this->xeploai = trim($data['xeploai']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		// if (!$this->noidung_hoatdong) {
		// 	$this->errors['noidung_hoatdong'] = 'Chương Trình Hoạt Động Không Rỗng.';
		// }

		// if (!$this->hoc_ki) {
		// 	$this->errors['hoc_ki'] = 'Học Kì Không Rỗng.';
		// }

		// if (!$this->diemrl) {
		// 	$this->errors['diemrl'] = 'Điểm Rèn Luyện Không Rỗng.';
		// }

		// if (!$this->xeploai) {
		// 	$this->errors['xeploai'] = 'Xếp Loại Không Rỗng.';
		// }

		return empty($this->errors);
	}

	public function all()
	{
		$list_hdb1910439 = [];

		$stmt = $this->db->prepare('select list_hdb1910439.id, list_hdb1910439.noidung_hoatdong, list_hdb1910439.hoc_ki, list_hdb1910439.diemrl, list_hdb1910439.xeploai, list_hdb1910439.created_at, list_b1910439.mssv, list_b1910439.ho_ten, list_b1910439.lop, list_b1910439.khoa, list_b1910439.filename
									from list_hdb1910439
									inner join list_b1910439 on list_hdb1910439.fk_b1910439 = list_b1910439.id');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$ktb1910439 = new KTB1910439($this->db);
			$ktb1910439->fillFromDB($row);
			$list_hdb1910439[] = $ktb1910439;
		} 

		return $list_hdb1910439;
	}
	
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'noidung_hoatdong' => $this->noidung_hoatdong,
			'hoc_ki' => $this->hoc_ki,
			'diemrl' => $this->diemrl,
			'xeploai' => $this->xeploai,
			'created_at' => $this->created_at,
			'mssv' => $this->mssv,
			'ho_ten' => $this->ho_ten,
			'lop' => $this->lop,
            'khoa' => $this->khoa,
			'filename' => $this->filename,
		] = $row;
		return $this;
	}

	public function save()
		{
			$result = false;

			if ($this->id >= 0) {
				$stmt = $this->db->prepare('update list_hdb1910439 set noidung_hoatdong = :noidung_hoatdong,
					hoc_ki = :hoc_ki, diemrl = :diemrl, xeploai = :xeploai, created_at = now()
					where id = :id');
				$result = $stmt->execute([
					'noidung_hoatdong' => $this->noidung_hoatdong,
					'hoc_ki' => $this->hoc_ki,
					'diemrl' => $this->diemrl,
					'xeploai' => $this->xeploai,
					'id' => $this->id]);
			} 	else {
				$stmt = $this->db->prepare(
					'insert into list_hdb1910439 (noidung_hoatdong, hoc_ki, diemrl, xeploai, created_at)
					values (:noidung_hoatdong, :hoc_ki, diemrl, xeploai, now())');
				$result = $stmt->execute([
					'noidung_hoatdong' => $this->noidung_hoatdong,
					'hoc_ki' => $this->hoc_ki,
					'diemrl' => $this->diemrl,
					'xeploai' => $this->xeploai]);
				if ($result) {
					$this->id = $this->db->lastInsertId();
				}
			} 
			
			return $result;
		}
	
		public function find($id)
		{
			$stmt = $this->db->prepare('select * from list_hdb1910439 where id = :id');
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

		// public function delete()
		// {
		// 	$stmt = $this->db->prepare('delete from list_hdb1910439 where id = :id');
		// 	return $stmt->execute(['id' => $this->id]);
		// }
}