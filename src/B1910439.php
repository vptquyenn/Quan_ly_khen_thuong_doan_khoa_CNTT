<?php

namespace Ct271\Labs;

class B1910439
{
	private $db;
	private $id = -1;
	public $mssv;
	public $ho_ten;
	public $lop;
	public $gioi_tinh;
	public $ngay_sinh;
	public $noi_sinh;
	public $thuong_tru;
    public $khoa;
	public $filename;
	public $date_entered;
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
		if (isset($data['mssv'])) {
			$this->mssv = trim($data['mssv']);
		}

		if (isset($data['ho_ten'])) {
			$this->ho_ten = trim($data['ho_ten']);
		}

		if (isset($data['lop'])) {
			$this->lop = trim($data['lop']);
		}

		if (isset($data['gioi_tinh'])) {
			$this->gioi_tinh = trim($data['gioi_tinh']);
		}

		if (isset($data['ngay_sinh'])) {
			$this->ngay_sinh = trim($data['ngay_sinh']);
		}

		if (isset($data['noi_sinh'])) {
			$this->noi_sinh = trim($data['noi_sinh']);
		}

		if (isset($data['thuong_tru'])) {
			$this->thuong_tru = trim($data['thuong_tru']);
		}

        if (isset($data['khoa'])) {
			$this->khoa = trim($data['khoa']);
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
		if (!$this->mssv) {
			$this->errors['mssv'] = 'MSSV Không Rỗng.';
		}

		if (!$this->ho_ten) {
			$this->errors['ho_ten'] = 'Họ Tên Không Rỗng.';
		}

		if (!$this->lop) {
			$this->errors['lop'] = 'Lớp Không Rỗng.';
		}

        if (!$this->khoa) {
			$this->errors['khoa'] = 'Khoa Không Rỗng.';
		}

		if (!$this->gioi_tinh) {
			$this->errors['gioi_tinh'] = 'Giới Tính Không Rỗng.';
		}

		if (!$this->ngay_sinh) {
			$this->errors['ngay_sinh'] = 'Ngày Sinh Không Rỗng.';
		}

		if (!$this->noi_sinh) {
			$this->errors['noi_sinh'] = 'Nơi Sinh Không Rỗng.';
		}

		if (!$this->thuong_tru) {
			$this->errors['thuong_tru'] = 'Thường Trú Không Rỗng.';
		}

		return empty($this->errors);
	}

	public function all()
	{
		$list_B1910439 = [];

		$stmt = $this->db->prepare('select * from list_B1910439');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$b1910439 = new B1910439($this->db);
			$b1910439->fillFromDB($row);
			$list_B1910439[] = $b1910439;
		} 

		return $list_B1910439;
	} 
	
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'mssv' => $this->mssv,
			'ho_ten' => $this->ho_ten,
			'lop' => $this->lop,
            'khoa' => $this->khoa,
			'gioi_tinh' => $this->gioi_tinh,
			'ngay_sinh' => $this->ngay_sinh,
			'noi_sinh' => $this->noi_sinh,
			'thuong_tru' => $this->thuong_tru,
			'filename' => $this->filename,
			'date_entered' => $this->date_entered,
		] = $row;
		return $this;
	}

	public function save()
		{
			$result = false;

			if ($this->id >= 0) {
				$stmt = $this->db->prepare('update list_b1910439 set mssv = :mssv,
					ho_ten = :ho_ten, lop = :lop, gioi_tinh = :gioi_tinh, ngay_sinh = :ngay_sinh, noi_sinh = :noi_sinh, thuong_tru = :thuong_tru, khoa = :khoa, filename = :filename, date_entered = now()
					where id = :id');
				$result = $stmt->execute([
					'mssv' => $this->mssv,
					'ho_ten' => $this->ho_ten,
					'lop' => $this->lop,
                    'khoa' => $this->khoa,
					'gioi_tinh' => $this->gioi_tinh,
					'ngay_sinh' => $this->ngay_sinh,
					'noi_sinh' => $this->noi_sinh,
					'thuong_tru' => $this->thuong_tru,
					'filename' => $this->filename,
					'id' => $this->id]);
			} 	else {
				$stmt = $this->db->prepare(
					'insert into list_b1910439 (mssv, ho_ten, lop, gioi_tinh, ngay_sinh, noi_sinh, thuong_tru, Khoa, filename, date_entered)
					values (:mssv, :ho_ten, :lop, :gioi_tinh, :ngay_sinh, :noi_sinh, :thuong_tru, :khoa, :filename, now())');
				$result = $stmt->execute([
					'mssv' => $this->mssv,
					'ho_ten' => $this->ho_ten,
					'lop' => $this->lop,
                    'khoa' => $this->khoa,
					'gioi_tinh' => $this->gioi_tinh,
					'ngay_sinh' => $this->ngay_sinh,
					'noi_sinh' => $this->noi_sinh,
					'thuong_tru' => $this->thuong_tru,
					'filename' => $this->filename]);
				if ($result) {
					$this->id = $this->db->lastInsertId();
				}
			} 
			
			return $result;
		}
	
		public function find($id)
		{
			$stmt = $this->db->prepare('select * from list_b1910439 where id = :id');
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
			$stmt = $this->db->prepare('delete from list_b1910439 where id = :id');
			return $stmt->execute(['id' => $this->id]);
		}
}