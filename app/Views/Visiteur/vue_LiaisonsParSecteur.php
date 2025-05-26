<?php
echo "<table class='table table-striped'>";
echo "
<tr>
<th>Secteur</th>
<th>Code liaison</th>
<th>Distance</th>
<th>Port de départ</th>
<th>Port d'arrivée</th>
</tr>";
foreach ($liaisons as $uneLiaison)
{
    echo "<TR>";
    echo /*"<TD>".$uneLiaison->nomdusecteur."</TD>*/"<TD>"
    .$uneLiaison->NoLiaison."</TD><TD>"
    .$uneLiaison->distance."</TD><TD>"
    .$uneLiaison->portd."</TD><TD>"
    .$uneLiaison->porta."</TD>";
    echo "</TR>";
}
echo "</table>";


/*foreach ($liaisons as $uneLiaison)$attributsTableau = ["table_open" => "<table class='table table-striped'>",]; // classe Bootstrap
$table = new \CodeIgniter\View\Table($attributsTableau);
$table->setHeading(['Secteur', 'Code Liaison', 'Distance', 'Port de départ',
'Port arrivée']); // entête tableau

echo $table->generate($liaisons);
{?>
    <a href="<?php echo site_url('')?>"><?php $uneLiaison->noliaison;?></a><?php
}*/