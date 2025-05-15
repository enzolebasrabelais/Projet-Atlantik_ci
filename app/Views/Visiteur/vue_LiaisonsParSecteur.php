<?php

$attributsTableau = ["table_open" => "<table class='table table-striped'>",]; // classe Bootstrap
$table = new \CodeIgniter\View\Table($attributsTableau);
$table->setHeading(['Secteur', 'Code Liaison', 'Distance', 'Port de départ',
'Port arrivée']); // entête tableau

echo $table->generate($liaisons);

foreach ($liaisons as $uneLiaison)
{?>
    <a href="<?php echo site_url('')?>"><?php $uneLiaison->noliaison;?></a><?php
}