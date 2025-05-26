<?php

$attributsTableau = ["table_open" => "<table class='table table-striped'>",]; // classe Bootstrap
$table = new \CodeIgniter\View\Table($attributsTableau);
$table->setHeading(['Lettre de catégorie', 'Libellé', 'n° Type', 'Début de la période',
'Fin de la période', 'Tarif']); // entête tableau

echo $table->generate($tarifs);

var_dump($tarifs);