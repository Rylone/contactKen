<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;

class Formulaire extends BaseController {

    public function index() {

        helper('form');

        $rules = [
            'nom' => 'required',
            'prenom' => 'required|min_length[3]|'
        ];

                
            if($this->validate($rules)) { 

                $nom = $this->request->getVar('nom');

                $prenom = $this->request->getVar('prenom');

            }

        $data = ['validation'=>$this->validator,
                  'request'  =>$this->request
                ];

        echo view('formulaire',$data);

    }

}