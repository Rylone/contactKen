<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;

class Api extends BaseController

{

    public $contactsModel = null;
	
	public function __construct() {

		$this->contactsModel = new ContactModel();

	}

	/***************************************************************************************
     Dans l'index , on va gérer la liste et la recherche
     index administrates list contact and searching for a contact
    **************************** ********************************************************** */
    
    public function index() {
		
        
        //$listContacts = $this->contactsModel->findAll();
		
        $listContacts = $this->contactsModel->orderBy('last_Name','ASC')
                                            ->orderBy('first_Name','ASC')
                                            ->paginate(10);

            
            if (!empty($this->request->getVar('type')) && !empty($this->request->getVar('contenuRecherche'))) {
                
                $contenuRecherche = $this->request->getVar('contenuRecherche');
                $type = $this->request->getVar('type');
        

                switch($type) {

                    case 'recherche':

                    $listContacts = $this->contactsModel->like('last_Name',$contenuRecherche,'both',null,true);
                    $listContacts = $this->contactsModel->orLike('first_Name',$contenuRecherche,'both',null,true);
                    $listContacts = $this->contactsModel->orderBy('last_Name','ASC');
                    $listContacts = $this->contactsModel->orderBy('first_Name','ASC');
                    $listContacts = $this->contactsModel->paginate(2);

                    break;

                }

            }

            return $this->response->setJSON($listContacts); 


	}

    
    /*********************************************************************************************
     
     Dans delete , on gère la suppression d'un ou plusieurs contacts
     delete adminstrates deleting one or more contacts
     
     **************************** **************************************************************** */
    
    public function delete() {
        
        /*********************************************************************************************
         
         1 je recupère identifiant du contact a supprimer
         2 si il existe je passe au 3
         3 je fais la requete pour supprimer
         
         4 j'informe l'etat de la suppression
         **************************** **************************************************************** */
        
        $id = $this->request->getVar('id');
        
        $etatSuppression = ['response'=>'NOK'] ;
        
        if (!empty($id)) {
            
            $contact = $this->contactsModel->where('id',$id)->first();
            
            $this->contactsModel->where('id',$id)->delete();
            
            $etatSuppression = ['response'=>'OK'] ;
            
            return $this->response->setJSON($etatSuppression); 
            
        }
        
        return $this->response->setJSON($etatSuppression); 
        
    }
    /****************************************************************************************
     Dans edit , on gère l'ajout et la modification d'un contact
     edit administrates adding and editing a contact
    **************************** ******************************************************** */
    
    public function edit() {

        $etatAction = ['response'=>false] ;
        
        $rules = [
            'id'        => 'required',
            'last_Name' => 'required',
            'phone'     => 'required'
        ];
        
        if ($this->validate($rules)) {
            
            $id = $this->request->getVar('id');
    
            $contact = $this->contactsModel->where('id',$id)->first();
                    
                if (!empty($contact)) {

                    $last_Name = $this->request->getVar('last_Name');
                    
                    $phone = $this->request->getVar('phone');
                
                    $dataSave = [
                        'last_Name'     => $last_Name,
                        'phone'    	    => $phone,
                        'first_Name'    => $this->request->getVar('last_Name'),
                        'email'         => $this->request->getVar('email')

                    ];

                    $this->contactsModel->where('id',$id)->set($dataSave)->update();

                    $etatAction = ['response'=>true] ;
                
                }  else {

                    $etatAction["ERROR"]["ID"] = "Le contact/L'ID n'existe pas";

                }       
    
            } else {
                
                if (empty($this->request->getVar('last_Name'))) {

                    $etatAction["ERROR"]["Nom"] = "Le nom n'a pas été rempli";

                }
                
                    if (empty($this->request->getVar('phone'))) {

                        $etatAction["ERROR"]["Téléphone"] = "Le téléphone n'a pas été rempli";

                    }

            }

        return $this->response->setJSON($etatAction);

        //Test de rajout de first name & email, check en base, test de rajout
        
    }

     /****************************************************************************************
     Dans create , on gère l'ajout d'un contact
      recup infos form post code igniter avec getVar de ces valeurs :
     'Nom'(text),
     'Prenom'(text),
     'company',
     Profession(text),
     email(email),
     NumTel(number),
     Note(text),
     Favoris(text),
     Image(file)
     return true si reussite et false si echec et pourquoi
     Valeurs obligatoires : nom et num tel

    **************************** ******************************************************** */

    public function create() {

        $etatAction = ['response'=>false] ;

        $rules = [
            'last_Name'        => 'required',
            'phone'     => 'required'
        ];
         
            if($this->validate($rules)) {
                
            $last_Name = $this->request->getVar('last_Name');
            
            $phone = $this->request->getVar('phone');

            $dataSave = [
                'last_Name'     => $last_Name,
                'phone'    	    => $phone
            ];

            $this->contactsModel->save($dataSave);            

            $etatAction = ['response'=>true] ;

            } else {
                
                if (empty($this->request->getVar('last_Name'))) {

                    $etatAction["ERROR"]["Nom"] = "Le nom n'a pas été rempli";

                }
                
                    if (empty($this->request->getVar('phone'))) {

                        $etatAction["ERROR"]["Téléphone"] = "Le téléphone n'a pas été rempli";

                    }   

            }

        return $this->response->setJSON($etatAction); 
    }

    /**************************************************************************************************************
     
    Dans favori , on gère si un contact peut être un favori ou être retiré des favoris
    favori administrates if a contact can be added or removed from favorites

    **************************** *********************************************************************************** */
    
    public function favori() {
    
    /*********************************************************************************************
     1 je recupère identifiant du contact a mettre en favoris
     2 si il existe je passe au 3
     3 je fais la requete qui interroge la base qui dit si le contact est favori ou pas
     4 si oui on retire des favoris
     5 sinon on le rajoute
     6 j'informe l'etat de l'action
    **************************** **************************************************************** */
    $etatFav = ['response'=>'NOK'] ;
    
    $id = $this->request->getVar('id');

        if (!empty($id)) {

            $contact = $this->contactsModel->where('id',$id)->first();

    /**************************************************************************************************************
     
    On verifie si la requete a un resultat

    **************************** *********************************************************************************** */

                if (!empty($contact)) {

                    if ($contact['favory'] == 'Yes') {
                        
                        $contact = $this->contactsModel->where('id',$id)->set('favory','No')->update();

                        $etatFav = ['response'=>"Il n'est plus favori !"] ;

                        return $this->response->setJSON($etatFav); 


                    } else {

                        $contact = $this->contactsModel->where('id',$id)->set('favory','Yes')->update();

                        $etatFav = ['response'=>"Il est favori !"] ;

                        return $this->response->setJSON($etatFav); 

                    }

                }
                                   

        }

    }

}
