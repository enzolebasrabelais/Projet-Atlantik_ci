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
        $session = session();
        helper(['form']);
        if (!$this->request->is('post'))
        {
            
            return view('client/vue_ModificationCompte');
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
            $condition = ['mel'=>$session->get('identifiant')];
            var_dump($condition); die();
            $data['valeurIdGenere'] = $modeleClient->where($condition)->update($donneesAInserer);
            return view('client/vue_ModificationValide', $data);
        }
    }

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('meconnecter');
    }
}