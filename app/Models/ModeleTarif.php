<?php
namespace App\Models;
use CodeIgniter\Model;


class ModeleTarif extends Model
{
    protected $table = 'tarifer tar';
    protected $primaryKey = 'noperiode, lettrecategorie, notype, noliaison';

    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $allowedFields = ['noperiode, lettrecategorie, notype, noliaison', 'tarif'];

    public function getAllLiaisonsParSecteur()
    {
        return $this->join('secteur sec', 'lia.nosecteur = sec.nosecteur', 'inner')
        ->join('port portdepart', 'lia.noport_depart = portdepart.noport', 'inner')
        ->join('port portarrivee', 'lia.noport_arrivee = portarrivee.noport', 'inner')
        ->select('sec.nom, noliaison, distance, portdepart.nom as "portd", portarrivee.nom as "porta"')
        //->where(['portdepart.noport'=>'lia.noport_depart', 'portarrivee.noport'=>'lia.noport_arrivee'])
        ->get();
    }
        
}