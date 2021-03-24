<?php

namespace App\Controllers;
use App\Models\ContactModel;


class DbAndJquery extends BaseController {


	public function index()
	{

		
        $contact = new ContactModel();

        $listContact = $contact->orderBy('id','ASC')->orderBy("createDate", "DESC")->paginate(10);
        // dd($listContact);

		$data = ['allContacts' => $listContact];

	
		echo view('Common/Header');
		 echo view('dbjquery', $data);
		echo view('Common/Footer');
	}
	public function delete($id = null)
    {
        $contact = new ContactModel();

        $delete = $contact->where('id', $id)->delete();
        if($delete)
        {
            return redirect()->to('/dbandjquery/index');
        }
    }
}
