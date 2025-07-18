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
        helper(['form']);

        if (!$this->request->is('post'))
        {
            
            return view('visiteur/vue_CreationCompte');
        }
        
        $reglesValidation = [ // Régles de validation
            'txtNom' => 'required',
            'txtPrenom' => 'required',
            'txtAdresse' => 'required',
            'txtCP' => 'required',
            'txtVille' => 'required',
            'txtMel' => 'required',
            'txtMDP' => 'required',
        ];

        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé */
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_CreationCompte'); // Renvoi formulaire de connexion

        }

        else
        {
            $donneesAInserer = array(
            $n = 'nom' => $this->request->getPost('txtNom'),
            $p ='prenom' => $this->request->getPost('txtPrenom'),
            $a = 'adresse' => $this->request->getPost('txtAdresse'),
            $c = 'codepostal' => $this->request->getPost('txtCP'),
            $v = 'ville' => $this->request->getPost('txtVille'),
            $tf = 'telephonefixe' => $this->request->getPost('txtTF'),
            $tm = 'telephonemobile' => $this->request->getPost('txtTM'),
            $m = 'mel' => $this->request->getPost('txtMel'),
            $mdp = 'motdepasse' => $this->request->getPost('txtMDP'),
            );

            
            $modeleClient = new ModeleClient();
            $data['valeurIdGenere'] = $modeleClient->insert($donneesAInserer);
            $condition = ['nom'=>$n, 'prenom'=>$p, 'adresse'=>$a, 'codepostal'=>$c, 'ville'=>$v, 'telephonefixe'=>$tf, 'telephonemobile'=>$tm, 'mel'=>$m, 'motdepasse'=>$mdp];
            $utilisateurInsere = $modeleClient->where($condition)->first();

            if (utilisateurInsere != null) {
            return view('visiteur/vue_ValidationCompte');
            }else {
                /* identifiant et/ou mot de passe OK : on renvoie le formulaire  */
                $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
                return view('Templates/Header', $data)
                . view('Visiteur/vue_CreationCompte');
            }
        }
    }
    
    public function liaisonsParSecteur()
    {
        $modeleLiaison = new ModeleLiaison();
        $data['liaisons'] = $modeleLiaison->getAllLiaisonsParSecteur();
        return view('Templates/Header')
        . view('Visiteur/vue_LiaisonsParSecteur', $data);
    }

    public function tarifsDUneLiaison($noliaison = null)
    {
        $modeleTarif = new ModeleTarif();
        $data['tarifs'] = $modeleTarif->getAllTarifsDUneLiaison($noliaison);
        return view('Templates/Header')
        . view('Visiteur/vue_TarifsDUneLiaison', $data);
    }

    public function voirLesHoraires($nosecteur = null)
    {
        $modSecteur = new ModeleSecteur();
        $modeleLiaison = new ModeleLiaison();
        if ($nosecteur === null)
        {
            $data['secteurs'] = $modSecteur->findAll();

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
            $session->set('connecte', 'Oui');
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