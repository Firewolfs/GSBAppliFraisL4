<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class userController extends Controller {

    public function addVisiteur(Request $request) {
        $bdd = new GsbFrais();
        $name = $request->input('name');
        $firstName = $request->input('firstName');
        $login = substr($firstName, 0,1).$name;
        $mdp = $this->generatePassword();
        $address = $request->input('address');
        $cp = $request->input('cp');
        $ville = $request->input('ville');
        $dateEmb = date('Y-m-d');
        $tel = $request->input('tel');
        $mail = $request->input('mail');

        $id = $this->generagetId(substr($name, 0,1));

        $bdd->addUser($id, $name, $firstName, $login, $mdp, $address, $cp, $ville, $dateEmb, $tel, $mail);

        return view('confirmInscript', compact('login', 'mdp'));
    }

    public function getInfoToUpdate(){
        $unVisiteur = new GsbFrais();
        $idVisiteur = Session::get('id');
        $mesInfos = $unVisiteur->getModifInfo($idVisiteur);

        return redirect('/modifierCompte')->with(compact('mesInfos'));
    }

    private function generagetId($firstChar){
        $id = $firstChar;
        $long = rand(1, 3);
        $chaine = '123456789';
        for ($i = 0; $i < $long; $i++){
            $id .= $chaine[rand(0, strlen($chaine) - 1)];
        }

        return $id;
    }

    private function generatePassword() {
        $password = '';
        $chaine = '0123456789abcdefghijklmnopqrstuvwxyz';
        for ($i = 0; $i < 5; $i++){
            $password .= $chaine[rand(0, strlen($chaine) - 1)];
        }

        return $password;
    }
}