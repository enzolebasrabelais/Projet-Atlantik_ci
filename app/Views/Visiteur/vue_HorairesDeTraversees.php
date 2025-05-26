<?php
foreach ($secteurs as $uneliaison) :
    echo '<h3>'.anchor('horairesdetraversee/'.$uneliaison->nosecteur, $uneliaison->nomsec).'</h3>';
    $noSecteur = $uneliaison->nosecteur;
endforeach ?>

<?php
if ($noSecteur != null) {
foreach ($secteurs as $uneliaison) :
    echo $uneliaison->portd.' - '.$uneliaison->porta.'<br/>';
endforeach 
;}
?>