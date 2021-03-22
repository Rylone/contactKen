<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;

class Exercice extends BaseController {

    public function index($id=null,$nom=null,$age=null,$sexe=null) {

        

        switch ($sexe) {

            case "homme":

                echo "Vous êtes un homme";

            break;

            case "femme":

                echo "Vous êtes une femme";
            
            break;

            default:
                
                echo "Vous n'avez pas préciser de sexe";
        }
        
        $data = [
            'id'=>$id,
            'nom'=>$nom,
            'age'=>$age,
            'sexe'=>$sexe

        ];
        
        echo view('exercice',$data);

    }

}