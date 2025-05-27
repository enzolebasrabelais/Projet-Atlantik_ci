<html>
<body>
<?php
    echo form_open('modifiermoncompte');
    echo csrf_field(); // Pour sécurité
    echo form_label('Nom : ','txtNom');
    echo form_input('txtNom','');
    echo form_label('Prénom : ','txtPrenom');
    echo form_input('txtPrenom','');
    echo form_label('Adresse : ','txtAdresse');
    echo form_input('txtAdresse','');
    echo form_label('Code postal : ','txtCP');
    echo form_input('txtCP','');
    echo form_label('Ville : ','txtVille');
    echo form_input('txtVille','');
    echo form_label('Téléphone fixe : ','txtTF');
    echo form_input('txtTF','');
    echo form_label('Téléphone mobile : ','txtTM');
    echo form_input('txtTM','');
    echo form_label('Mel : ','txtMel');
    echo form_input('txtMel','');
    echo form_label('Mot de passe : ','txtMDP');
    echo form_password('txtMDP','');
    echo form_submit('btnOK','OK');
    echo form_close();
?>
</body>
</html>