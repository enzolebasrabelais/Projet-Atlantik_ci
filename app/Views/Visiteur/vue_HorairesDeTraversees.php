<?php
foreach ($liaisonsbis as $uneliaison) :
    echo '<h3>'.anchor('horairesdetraversee/'.$uneliaison->nosecteur, $uneliaison->nomsec).'</h3>';
endforeach ?>

<?php
if ($noSecteur != null) {
foreach ($liaisonsbis as $uneliaison) :
    echo $uneliaison->portd.' '.$uneliaison->porta;
endforeach 
;}
?>