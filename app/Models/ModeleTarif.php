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

    public function getAllTarifsDUneLiaison()
    {
        return $this->join('type t', 'tar.lettrecategorie = t.lettrecategorie', 'tar.notype = t.notype', 'inner')
        ->join('liaison lia', 'tar.noliaison = lia.noliaison', 'inner')
        ->join('periode p', 'tar.noperiode = p.noperiode', 'inner')
        ->select('tar.lettrecategorie, t.libelle, tar.notype, p.datedebut, p.datefin, tar.tarif')
        //->where(['portdepart.noport'=>'lia.noport_depart', 'portarrivee.noport'=>'lia.noport_arrivee'])
        ->get();
    }
        
}