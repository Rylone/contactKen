<?php

namespace App\Controllers;
use App\Models\ContactModel;

class Database extends BaseController {

	public function index()
	{
        $contact = new ContactModel();

        $listContact = $contact->orderBy('id','ASC')->orderBy("createDate", "DESC")->paginate(10);
        // dd($listContact);

		$data = ['allContacts' => $listContact];

        echo view('exercice', $data);
	}

    public function delete($id = null)
    {
        $contact = new ContactModel();

        $delete = $contact->where('id', $id)->delete();
        if($delete)
        {
            return redirect()->to('/database/index');
        }
    }
}
