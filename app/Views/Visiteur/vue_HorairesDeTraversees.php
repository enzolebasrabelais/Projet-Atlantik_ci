<?php
foreach ($secteurs as $unSecteur) :
    echo '<h3>'.anchor('horairesdetraversee/'.$unSecteur->NOSECTEUR, $unSecteur->NOM).'</h3>';
    $noSecteur = $unSecteur->NOSECTEUR;
endforeach ?>
<?php
if ($noSecteur != null) {
foreach ($liaisonsbis as $uneliaison) :
    echo $uneliaison->portd.' '.$uneliaison->porta;
endforeach 
;}
?>