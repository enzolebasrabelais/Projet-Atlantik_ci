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

    public function getAllLiaisonsParSecteur()
    {
        return $this->join('secteur sec', 'lia.nosecteur = sec.nosecteur', 'inner')
        ->join('port portdepart', 'lia.noport_depart = portdepart.noport', 'inner')
        ->join('port portarrivee', 'lia.noport_arrivee = portarrivee.noport', 'inner')
        ->select('sec.nom as nomdusecteur, noliaison, distance, portdepart.nom as portd, portarrivee.nom as porta')
        //->where(['portdepart.noport'=>'lia.noport_depart', 'portarrivee.noport'=>'lia.noport_arrivee'])
        ->get()->getResult();
    }

    public function getAllLiaisonsParSecteurBis()
    {
        return $this->join('secteur sec', 'lia.nosecteur = sec.nosecteur', 'inner')
        ->join('port portdepart', 'lia.noport_depart = portdepart.noport', 'inner')
        ->join('port portarrivee', 'lia.noport_arrivee = portarrivee.noport', 'inner')
        //->where(['lia.nosecteur'=>$noSecteur])
        ->select('sec.nom as "nomdusteur, sec.nosecteur as "nosecteur", noliaison, distance, portdepart.nom as "portd", portarrivee.nom as "porta"')
        ->get()->getResult();
    }
}