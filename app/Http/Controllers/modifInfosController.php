<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;

class modifInfosController extends Controller {
    
    /**
     * Initialise le formulaire de saisie des Frais 
     * 
     * @return type Vue formSaisirFrais
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

}
