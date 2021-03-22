<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class Documentation extends BaseController
{
	public function index()
	{
		echo view('Common/Header');
		echo view('documentation');
		echo view('Common/Footer');
	}
}