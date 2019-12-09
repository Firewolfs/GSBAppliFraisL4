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

        $id = $this->generagetId(strtolower(substr($name, 0,1)));

        $bdd->addUser($id, $name, $firstName, $login, $mdp, $address, $cp, $ville, $dateEmb, $tel, $mail, $region);

        return view('confirmInscript', compact('login', 'mdp'));
    }

    public function getRegion() {
        $bdd = new GsbFrais();
        $lesRegion = $bdd->getRegion();

        return view('formUser', compact('lesRegion'));
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
        for ($i = 0; $i < 5; $i++){
            $password .= $chaine[rand(0, strlen($chaine) - 1)];
        }

        return $password;
    }
}