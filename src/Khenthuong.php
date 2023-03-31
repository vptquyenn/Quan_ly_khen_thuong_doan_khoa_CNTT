<?php

namespace Ct271\Labs;

class Khenthuong extends Contact
{
	private $db;
	private $id = -1;
	public $noidung_hoatdong;
	public $hoc_ki;
	public $diemrl;
	public $xeploai;
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

		if (isset($data['filename'])) {
			$this->filename = trim($data['filename']);
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
		$list_student = [];

		$stmt = $this->db->prepare('select * from list_student');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$khenthuong = new Khenthuong($this->db);
			$khenthuong->fillFromDB($row);
			$list_student[] = $khenthuong;
		} 

		return $list_student;
	} 
	
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'noidung_hoatdong' => $this->noidung_hoatdong,
			'hoc_ki' => $this->hoc_ki,
			'diemrl' => $this->diemrl,
			'xeploai' => $this->xeploai,
			'mssv' => $this->mssv,
			'ho_ten' => $this->ho_ten,
			'lop' => $this->lop,
			'khoa' => $this->khoa,
			'filename' => $this->filename,
			'date_entered' => $this->date_entered,
		] = $row;
		return $this;
	}

	public function save()
		{
			$result = false;

			if ($this->id >= 0) {
				$stmt = $this->db->prepare('update list_student set noidung_hoatdong = :noidung_hoatdong,
					hoc_ki = :hoc_ki, diemrl = :diemrl, xeploai = :xeploai, date_entered = now()
					where id = :id');
				$result = $stmt->execute([
					'noidung_hoatdong' => $this->noidung_hoatdong,
					'hoc_ki' => $this->hoc_ki,
					'diemrl' => $this->diemrl,
					'xeploai' => $this->xeploai,
					'id' => $this->id]);
			} 	else {
				$stmt = $this->db->prepare(
					'insert into list_student (noidung_hoatdong, hoc_ki, diemrl, xeploai, date_entered)
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
			$stmt = $this->db->prepare('select * from list_student where id = :id');
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
			$stmt = $this->db->prepare('delete from list_student where id = :id');
			return $stmt->execute(['id' => $this->id]);
		}
}