<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class userController extends Controller {

    /**
     * @param Request $request
     * @return type Vue confirmInscript, avec tableau associatif de login et mdp
     */
    public function addVisiteur(Request $request) {
        $this->validate($request, [
            'address' => ['bail', 'required', "regex:/[0-9]{1,3}\s[a-z\séèàêâùïüëA-Z-']{1,29}/"],
            'ville' => ['bail', 'required', "regex:/^[a-zéèàêâùïüëA-Z][a-zéèàêâùïüëA-Z-'\s]{1,30}$/"],
            'cp' => ['bail', 'required', 'digits:5'],
            'tel' => ['bail', 'required', 'digits_between:3,15'],
            'mail' => ['bail', 'required', 'email']
        ]);
        $bdd = new GsbFrais();
        $name = $request->input('name');
        $firstName = $request->input('firstName');
        $login = strtolower(substr($firstName, 0,1).$name);
        $mdp = $this->generatePassword();
        $address = $request->input('address');
        $cp = $request->input('cp');
        $ville = $request->input('ville');
        $dateEmb = date('Y-m-d');
        $tel = $request->input('tel');
        $mail = $request->input('mail');
        $region = $request->input('region');
        $role = $request->input('role');

        $id = $this->generagetId(strtolower(substr($name, 0,1)));

        if ($bdd->existVisitor($id, $login)){
            $error = 'Le visiteur existe déjà !';
            return redirect('/ajoutVisiteur')->with(compact('error'));
        } else {
            $bdd->addUser($id, $name, $firstName, $login, $mdp, $address, $cp, $ville, $dateEmb, $tel, $mail, $region, $role);
            return view('confirmInscript', compact('login', 'mdp'));
        }
    }

    /**
     * Initialise le formulaire de saisie des Frais
     *
     * @return type Vue formSaisirFrais, avec tableau associatif des informations
     */
    public function affFormModifInfos() {
        $erreur = "";
        $idVisiteur = Session::get('id');
        $gsbFrais = new GsbFrais();
        $info = $gsbFrais->getInfosPerso($idVisiteur);
        // Affiche le formulaire en lui fournissant les données à afficher
        // la fonction compact équivaut à array('lesFrais' => $lesFrais, ...)
        return view('formModifInfos', compact('info', 'erreur'));
    }

    /**
     * Vérifie les infos et met à jour l'utilisateur dans le base de données
     *
     * @param Request $request
     * @return type Vue confirmModifIngos
     */
    public function verifInfos(Request $request) {
        $this->validate($request, [
            'adresse' => ['bail', 'required', "regex:/[0-9]{1,3}\s[a-z\séèàêâùïüëA-Z-']{1,29}/"],
            'ville' => ['bail', 'required', "regex:/^[a-zéèàêâùïüëA-Z][a-zéèàêâùïüëA-Z-'\s]{1,30}$/"],
            'cp' => ['bail', 'required', 'digits:5'],
            'tel' => ['bail', 'required', 'digits_between:3,15'],
            'email' => ['bail', 'required', 'email']
        ]);
        //Récupérer les donées pour mettre a jour
        $adresse = $request->input('adresse');
        $cp = $request->input('cp');
        $ville = $request->input('ville');
        $idVisiteur = Session::get('id');
        $tel = $request->input('tel');
        $email = $request->input('email');

        //Mise à jour des informations de l'utilisateur en base de données
        $gsbFrais = new GsbFrais();
        $gsbFrais->majInfosUtilisateur($idVisiteur, $adresse, $cp, $ville, $tel, $email);

        // confirmer la mise à jour
        return view('confirmModifInfos');
    }

    /**
     * Récupère la liste des Régions
     *
     * @return type Vue formUser, avec tableau associatif de Région
     */
    public function getRegion() {
        $bdd = new GsbFrais();
        $secteur = Session::get('sec_code');
        $lesRegion = $bdd->getRegion($secteur);

        return view('formUser', compact('lesRegion'));
    }

    /**
     * Fonction qui récupère la liste des visiteurs d'un secteur
     *
     * @return type Vue listeSecteurVisiteur, avec tableau associatif de visiteurs
     */
    public function getSecteurVisiteur() {
        $frais = new GsbFrais();
        $session = Session::get('id');
        $visiteurs = $frais->getSecteurVisiteur($session);
        return view('listeSecteurVisiteur', compact('visiteurs'));
    }

    /**
     * Génère un identifiant aléatoire composer entre 2 et 4 caractères.
     *
     * @param $firstChar
     * @return string
     */
    private function generagetId($firstChar){
        $id = $firstChar;
        $long = rand(1, 3);
        $chaine = '123456789';
        for ($i = 0; $i < $long; $i++){
            $id .= $chaine[rand(0, strlen($chaine) - 1)];
        }

        return $id;
    }

    /**
     * Génère un mot de passe aléatoire de 5 caractères.
     *
     * @return string
     */
    private function generatePassword() {
        $password = '';
        $chaine = '0123456789abcdefghijklmnopqrstuvwxyz';
        for ($i = 0; $i < 6; $i++){
            $password .= $chaine[rand(0, strlen($chaine) - 1)];
        }

        return $password;
    }
}