<?php
foreach ($secteurs as $unSecteur) :
    echo '<h3>'.anchor('horairesdetraversee/'.$unSecteur->NOSECTEUR, $unSecteur->NOM).'</h3>';
endforeach ?>