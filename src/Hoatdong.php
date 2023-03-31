<?php

namespace Ct271\Labs;

class Hoatdong
{
	private $db;
	private $id = -1;
	public $tenhoatdong;
	public $noidunghoatdong;
	public $hocki;
	public $gio;
	public $ngay_bd;
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
		if (isset($data['tenhoatdong'])) {
			$this->tenhoatdong = trim($data['tenhoatdong']);
		}

		if (isset($data['noidunghoatdong'])) {
			$this->noidunghoatdong = trim($data['noidunghoatdong']);
		}

		if (isset($data['hocki'])) {
			$this->hocki = trim($data['hocki']);
		}

		if (isset($data['gio'])) {
			$this->gio = trim($data['gio']);
		}

		if (isset($data['ngay_bd'])) {
			$this->ngay_bd = trim($data['ngay_bd']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->tenhoatdong) {
			$this->errors['tenhoatdong'] = 'Tiêu Đề Hoạt Động Không Rỗng.';
		}

		if (!$this->noidunghoatdong) {
			$this->errors['noidunghoatdong'] = 'Chương Trình Hoạt Động Không Rỗng.';
		}

		if (!$this->hocki) {
			$this->errors['hocki'] = 'Học Kì Không Rỗng.';
		}

		if (!$this->gio) {
			$this->errors['gio'] = 'Thời Gian Diễn Ra Chương Trình Không Rỗng.';
		}

		if (!$this->ngay_bd) {
			$this->errors['ngay_bd'] = 'Ngày Diễn Ra Chương Trình Không Rỗng.';
		}

		return empty($this->errors);
	}

	public function all()
	{
		$list_hoatdong = [];

		$stmt = $this->db->prepare('select * from list_hoatdong');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$hoatdong = new Hoatdong($this->db);
			$hoatdong->fillFromDB($row);
			$list_hoatdong[] = $hoatdong;
		} 

		return $list_hoatdong;
	} 
	
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'tenhoatdong' => $this->tenhoatdong,
			'noidunghoatdong' => $this->noidunghoatdong,
			'hocki' => $this->hocki,
			'gio' => $this->gio,
			'ngay_bd' => $this->ngay_bd
		] = $row;
		return $this;
	}

	public function save()
		{
			$result = false;

			if ($this->id >= 0) {
				$stmt = $this->db->prepare('update list_hoatdong set tenhoatdong = :tenhoatdong,
					noidunghoatdong = :noidunghoatdong, hocki = :hocki, gio = :gio, ngay_bd = :ngay_bd
					where id = :id');
				$result = $stmt->execute([
					'tenhoatdong' => $this->tenhoatdong,
					'noidunghoatdong' => $this->noidunghoatdong,
					'hocki' => $this->hocki,
					'gio' => $this->gio,
					'ngay_bd' => $this->ngay_bd,
					'id' => $this->id]);
			} 	else {
				$stmt = $this->db->prepare(
					'insert into list_hoatdong (tenhoatdong, noidunghoatdong, hocki, gio, ngay_bd)
					values (:tenhoatdong, :noidunghoatdong, :hocki, :gio, :ngay_bd)');
				$result = $stmt->execute([
					'tenhoatdong' => $this->tenhoatdong,
					'noidunghoatdong' => $this->noidunghoatdong,
					'hocki' => $this->hocki,
					'gio' => $this->gio,
					'ngay_bd' => $this->ngay_bd]);
				if ($result) {
					$this->id = $this->db->lastInsertId();
				}
			} 
			
			return $result;
		}
	
		public function find($id)
		{
			$stmt = $this->db->prepare('select * from list_hoatdong where id = :id');
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
			$stmt = $this->db->prepare('delete from list_hoatdong where id = :id');
			return $stmt->execute(['id' => $this->id]);
		}
}