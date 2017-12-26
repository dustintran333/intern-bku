<?php
// Validation rules
	$config = [
		"sinhvien_create"=>[// Rules set name. Specify route sinhvien/index to auto-match to corresponding route
			[
				'field' => 'ma_so',
				'label' => 'Mã số',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} không được trống',
				]
			],
			[
				'field' => 'username' ,
				'label' => 'Tên người dùng',
				'rules' => 'required|alpha|max_length[20]|trim',
				'errors' => [
					'required' => '{field} không được trống',
					'alpha' =>'{field} không được có kí tự số',
					'max_length' => '{field} không được lớn hơn {param} ký tự',
				]
			],
			[
				'field' => 'password' ,
				'label' => 'Mật khẩu',
				'rules' => 'required',
				'errors' => [
					'required' => "{field} không được trống",
				]
			],
			[
				'field' => 'deadline_chon_dn' ,
				'label' => 'Deadline Chọn Doanh Nghiệp',
				'rules' => 'required',
				'errors' => [
					'required' => "{field} không được trống",
				]
			],
		],
		"sinhvien_update"=>[// Rules set name. Specify route sinhvien/index to auto-match to corresponding route
			[
				'field' => 'ma_so',
				'label' => 'Mã số',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} không được trống',
				]
			],
			[
				'field' => 'username' ,
				'label' => 'Tên người dùng',
				'rules' => 'alpha|max_length[20]|trim',
				'errors' => [
					'required' => '{field} không được trống',
					'alpha' =>'{field} không được có kí tự số',
					'max_length' => '{field} không được lớn hơn {param} ký tự',
				]
			],
			[
				'field' => 'password' ,
				'label' => 'Mật khẩu',
				'rules' => '',
				'errors' => [
					'' => "{field} không được trống",
				]
			],
			[
				'field' => 'deadline_chon_dn' ,
				'label' => 'Deadline Chọn Doanh Nghiệp',
				'rules' => '',
				'errors' => [
					'required' => "{field} không được trống",
				]
			],
		],
	];
?>