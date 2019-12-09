<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;
class GetGestionUtilisateursController extends Controller
{
    public function getVisiteurSecteur() {
        $frais = new GsbFrais();
        $session = Session::get('id');
        $visiteurs = $frais->getVisiteursSecteur($session);  
        
    }
}
