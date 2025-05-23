<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleTarif;
use App\Models\ModeleSecteur;
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
        . view('Visiteur/vue_TarifsDUneLiaison', $data);
    }

    public function voirLesHoraires($nosecteur = null)
    {
        $modeleLiaison = new ModeleLiaison();
        if ($nosecteur === null)
        {
            $data['secteurs'] = $modeleLiaison->getAllLiaisonsParSecteurBis();

            return view('Templates/Header')
            . view('Visiteur/vue_HorairesDeTraversees', $data);
        } else
        {
            $data['secteurs'] = $modeleLiaison->getAllLiaisonsParSecteurBis($nosecteur);

            return view('Templates/Header')
            . view('Visiteur/vue_HorairesDeTraversees', $data);
        }
        
        
        
        //$modeleLiaison = new modeleLiaison()
        //$data['liaisonsdusecteur'] = $modeleLiaison->where($condition)->first();

        
    }

    public function seConnecter()
    {
        helper(['form']);
        $session = session();

        $data['TitreDeLaPage'] = 'Se connecter';

        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }

        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */

        /* VALIDATION DU FORMULAIRE */

        $reglesValidation = [ // Régles de validation
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required',
        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé */
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter'); // Renvoi formulaire de connexion

        }

        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */

        /* RECHERCHE UTILISATEUR DANS BDD */
        $Identifiant = $this->request->getPost('txtIdentifiant');
        $MdP = $this->request->getPost('txtMotDePasse');

 

        /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */

        $modClient = new ModeleClient(); // instanciation modèle
        $condition = ['mel'=>$Identifiant,'motdepasse'=>$MdP];
        $utilisateurRetourne = $modClient->where($condition)->first();

        /* where : méthode, QueryBuilder, héritée de Model (), retourne,
        ici sous forme d'un objet, le résultat de la requête :
        SELECT * FROM utilisateur  WHERE identifiant='$pId' and motdepasse='$MotdePasse
        utilisateurRetourne = objet utilisateur ($returnType = 'object')
        */

        if ($utilisateurRetourne != null) {
            /* identifiant et mot de passe OK : identifiant et profil sont stockés en session */
            $session->set('identifiant', $utilisateurRetourne->MEL);
            // profil = "SuperAdministrateur ou "Administrateur"
            $data['Identifiant'] = $Identifiant;
            echo view('Templates/Header', $data);
            echo view('Visiteur/vue_ConnexionReussie');
        } else {
            /* identifiant et/ou mot de passe OK : on renvoie le formulaire  */
            $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
    } // Fin seConnecter
}