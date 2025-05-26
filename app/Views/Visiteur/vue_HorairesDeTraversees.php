<?php
var_dump($secteurs);
foreach ($secteurs as $uneliaison) :
    echo '<h3>'.anchor('horairesdetraversee/'.$uneliaison->NOSECTEUR, $uneliaison->NOM).'</h3>';
    //$noSecteur = $uneliaison->nosecteur;
endforeach ?>

<?php
/*if ($noSecteur != null) {
foreach ($secteurs as $uneliaison) :
    echo $uneliaison->portd.' - '.$uneliaison->porta.'<br/>';
endforeach 
;//}*/
?>