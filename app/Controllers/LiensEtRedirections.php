<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;

class LiensEtRedirections extends BaseController {

    public function index($page=null) {

        echo "Page : ".$page;

        echo "<br>";

            switch ($page) {
                
                case 'accueil':

                    return redirect()->to('/liensetredirections/accueil');
                
                break;

                case 'boutique':

                    return redirect()->to('/liensetredirections/boutique');

                break;

                default:

                    return redirect()->to('/liensetredirections/index');

                    echo "Index";

            }

    }

    public function accueil() {

        echo " Je suis dans l'accueil";

        echo "<br>";

        echo "<a href=".base_url('liensetredirections/boutique').">Lien vers Boutique</a>";

    }

    public function boutique() {

        echo "Je suis dans la boutique";

        echo "<br>";

        echo "<a href=".base_url('liensetredirections/accueil').">Lien vers Accueil</a>";

    }


}