<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;

class Formulaire extends BaseController {

    public function index() {

        helper('form');

        $rules = [
            'nom' => 'required',
            'prenom' => 'required|min_length[3]',
            "email" => 'required',
        ];
                
            if($this->validate($rules)) 
            { 

                $nom = $this->request->getVar('nom');
                $prenom = $this->request->getVar('prenom');
                $email = $this->request->getVar('email');
          
                $contact = new ContactModel();

                $dataSave = [
                    "last_Name"=> $nom,
                    "first_Name"=>$prenom,
                    'email' => $email,
                ];

            $contact->save($dataSave);
            }

        $data = ['validation'=>$this->validator,
                  'request'  =>$this->request
                ];

        echo view('formulaire',$data);

    }

}