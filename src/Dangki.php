<?php

namespace Ct271\Labs;

class Dangki extends Hoatdong
{
	private $db;
	private $id = -1;
	public $mssv;
	public $ho_ten;
	public $lop;
	public $khoa;
	public $trang_thai;
	public $id_ctht;
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

		if (isset($data['khoa'])) {
			$this->khoa = trim($data['khoa']);
		}

		if (isset($data['gioi_tinh'])) {
			$this->gioi_tinh = trim($data['gioi_tinh']);
		}

		if (isset($data['id_ctht'])) {
			$this->id_ctht = trim($data['id_ctht']);
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

		return empty($this->errors);
	}

	public function all()
	{
		$list_svdkhd = [];

		$stmt = $this->db->prepare('select list_svdkhd.id, list_svdkhd.mssv, list_svdkhd.ho_ten, list_svdkhd.lop, list_svdkhd.gioi_tinh, list_svdkhd.khoa, list_hoatdong.tenhoatdong, list_hoatdong.noidunghoatdong, list_hoatdong.hocki, list_hoatdong.ngay_bd, list_chitiet.trang_thai
									from list_svdkhd
									join list_hoatdong on list_svdkhd.fk_idhd = list_hoatdong.id
									join list_chitiet on list_svdkhd.id_ctht = list_chitiet.id');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$dangki = new Dangki($this->db);
			$dangki->fillFromDB($row);
			$list_svdkhd[] = $dangki;
		} 

		return $list_svdkhd;
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
            'tenhoatdong' => $this->tenhoatdong,
            'noidunghoatdong' => $this->noidunghoatdong,
            'hocki' => $this->hocki,
            'ngay_bd' => $this->ngay_bd,
			'trang_thai' => $this->trang_thai,
		] = $row;
		return $this;
	}

	public function save()
		{
			$result = false;

			if ($this->id >= 0) {
				$stmt = $this->db->prepare('update list_svdkhd set mssv = :mssv,
					ho_ten = :ho_ten, lop = :lop, khoa = :khoa, gioi_tinh = :gioi_tinh, id_ctht = :id_ctht, date_entered = now()
					where id = :id');
				$result = $stmt->execute([
					'mssv' => $this->mssv,
					'ho_ten' => $this->ho_ten,
					'lop' => $this->lop,
					'khoa' => $this->khoa,
					'gioi_tinh' => $this->gioi_tinh,
					'id_ctht' => $this->id_ctht,
					'id' => $this->id]);
			} 	else {
				$stmt = $this->db->prepare(
					'insert into list_svdkhd (mssv, ho_ten, lop, khoa, gioi_tinh, date_entered)
					values (:mssv, :ho_ten, :lop, :khoa, :gioi_tinh, now())');
				$result = $stmt->execute([
					'mssv' => $this->mssv,
					'ho_ten' => $this->ho_ten,
					'lop' => $this->lop,
					'khoa' => $this->khoa,
					'gioi_tinh' => $this->gioi_tinh]);
				if ($result) {
					$this->id = $this->db->lastInsertId();
				}
			} 
			
			return $result;
		}
	
		public function find($id)
		{
			$stmt = $this->db->prepare('select * from list_svdkhd where id = :id');
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
			$stmt = $this->db->prepare('delete from list_svdkhd where id = :id');
			return $stmt->execute(['id' => $this->id]);
		}
}