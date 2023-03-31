<?php

namespace Ct271\Labs;

class Fileup
{
	private $db;
	private $id = -1;
	public $filename;
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
		// if (!$this->filename) {
		// 	$this->errors['filename'] = 'filename Không Rỗng.';
		// }

		return empty($this->errors);
	}

	public function all()
	{
		$list_fileup = [];

		$stmt = $this->db->prepare('select * from list_fileup');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$fileup = new Fileup($this->db);
			$fileup->fillFromDB($row);
			$list_fileup[] = $fileup;
		} 

		return $list_fileup;
	} 
	
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'filename' => $this->filename,
		] = $row;
		return $this;
	}

// 	public function save()
// 		{
// 			$result = false;

// 			if ($this->id >= 0) {
// 				$stmt = $this->db->prepare('update list_student set mssv = :mssv,
// 					ho_ten = :ho_ten, lop = :lop, khoa = :khoa, gioi_tinh = :gioi_tinh, ngay_sinh = :ngay_sinh, noi_sinh = :noi_sinh, thuong_tru = :thuong_tru, date_entered = now()
// 					where id = :id');
// 				$result = $stmt->execute([
// 					'mssv' => $this->mssv,
// 					'ho_ten' => $this->ho_ten,
// 					'lop' => $this->lop,
// 					'khoa' => $this->khoa,
// 					'gioi_tinh' => $this->gioi_tinh,
// 					'ngay_sinh' => $this->ngay_sinh,
// 					'noi_sinh' => $this->noi_sinh,
// 					'thuong_tru' => $this->thuong_tru,
// 					'id' => $this->id]);
// 			} 	else {
// 				$stmt = $this->db->prepare(
// 					'insert into list_student (mssv, ho_ten, lop, khoa, gioi_tinh, ngay_sinh, noi_sinh, thuong_tru, date_entered)
// 					values (:mssv, :ho_ten, :lop, :khoa, :gioi_tinh, :ngay_sinh, :noi_sinh, :thuong_tru, now())');
// 				$result = $stmt->execute([
// 					'mssv' => $this->mssv,
// 					'ho_ten' => $this->ho_ten,
// 					'lop' => $this->lop,
// 					'khoa' => $this->khoa,
// 					'gioi_tinh' => $this->gioi_tinh,
// 					'ngay_sinh' => $this->ngay_sinh,
// 					'noi_sinh' => $this->noi_sinh,
// 					'thuong_tru' => $this->thuong_tru]);
// 				if ($result) {
// 					$this->id = $this->db->lastInsertId();
// 				}
// 			} 
			
// 			return $result;
// 		}
	
// 		public function find($id)
// 		{
// 			$stmt = $this->db->prepare('select * from list_student where id = :id');
// 			$stmt->execute(['id' => $id]);

// 			if ($row = $stmt->fetch()) {
// 				$this->fillFromDB($row);
// 				return $this;
// 			} 
			
// 			return null;
// 		} 
		
// 		public function update(array $data)
// 		{
// 			$this->fill($data);
// 			if ($this->validate()) {
// 				return $this->save();
// 			} 
// 			return false;
// 		}

// 		public function delete()
// 		{
// 			$stmt = $this->db->prepare('delete from list_student where id = :id');
// 			return $stmt->execute(['id' => $this->id]);
// 		}
}