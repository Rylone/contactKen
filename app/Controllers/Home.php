<?php

namespace App\Controllers;

class Home extends BaseController {

	public function __construct() {

		parent::__construct();

		$this->client = \Config\Services::curlrequest();
	
	}

	public function index()
	{

		$listContacts = $this->client->request('POST', 'http://contacts/api', [
			'form_params' => [
					'paginate' => 10,
					'type' => '',
					'elements' => '',
			]
		]);

		$contacts = json_decode($listContacts->getBody());

		$data = ['contacts' => $contacts];

		echo view('Common/Header');
		echo view('index',$data);
		echo view('Common/Footer');
	}
}
