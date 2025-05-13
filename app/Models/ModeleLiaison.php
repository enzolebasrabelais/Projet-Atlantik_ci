<?php
namespace App\Models;
use CodeIgniter\Model;


class ModeleLiaison extends Model
{
    protected $table = 'liaison lia';
    protected $primaryKey = 'noliaison';

    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $allowedFields = ['noliaison', 'noport_depart', 'nosecteur','noport_arrivee', 'distance'];

   /* public function getAllLiaisonsParSecteurs()
    {
        return $this->join('secteur sec', 'lia.nosecteur = sec.nosecteur', 'inner')
        ->join('port portdepart', 'lia.noport_depart = portdepart.noport', 'inner')
        ->join('port portarrivee', 'lia.noport_arrivee = portarrivee.noport' 'inner')
        ->select('sec.nom, noliaison, ');
    }
        */
}