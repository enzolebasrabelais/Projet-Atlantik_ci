<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleTarif;
helper(['assets']);

class Visiteur extends BaseController
{
    public function pageDAccueil()
    {
        return view('Templates/Header');
    }

    public function senregistrer()
    {
        if (!$this->request->is('post'))
        {
            helper('form');
            return view('visiteur/vue_CreationCompte');
        }
        else
        {
            $donneesAInserer = array(
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCP'),
            'ville' => $this->request->getPost('txtVille'),
            'telfixe' => $this->request->getPost('txtTF'),
            'telmobile' => $this->request->getPost('txtTM'),
            'mel' => $this->request->getPost('txtMel'),
            'motdepasse' => $this->request->getPost('txtMDP'),
            );
            $modeleClient = new ModeleClient();
            $data['valeurIdGenere'] = $modeleClient->insert($donneesAInserer);
            return view('visiteur/vue_ValidationCompte', $data);
        }
    }
    
    public function liaisonsParSecteur()
    {
        $modeleLiaison = new ModeleLiaison();
        $data['liaisons'] = $modeleLiaison->getAllLiaisonsParSecteur();
        return view('Templates/Header')
        . view('Visiteur/vue_LiaisonsParSecteur', $data);
    }

    public function tarifsDUneLiaison()
    {
        $modeleTarif = new ModeleTarif();
        $data['tarifs'] = $modeleTarif->getAllTarifsDUneLiaison();
        return view('Templates/Header')
        . view('Visiteur/vue_LiaisonsParSecteur', $data);
    }
}