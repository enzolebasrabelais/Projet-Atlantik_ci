<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleTarif;
use App\Models\ModeleSecteur;
helper(['assets']);

class Client extends BaseController
{
    public function modifcompte()
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
            $data['valeurIdGenere'] = $modeleClient->where()->update($donneesAInserer);
            return view('visiteur/vue_ValidationCompte', $data);
        }
    }
}