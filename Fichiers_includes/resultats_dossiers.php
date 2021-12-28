<?php if($dossiers) :?>
<table class="register_table">
    <thead>
        <th>ID</th>
        <th>Noms & Prenoms</th>
        <th>Adresse</th>
        <th>montant</th>
    </thead>
    <tbody>
        <?php foreach($dossiers as $dossier) :?>
            <tr>
                <td><?= $dossier['idDossier'];?></td>
                <td><?= $dossier['nomClient'].' '.$dossier['prenomClient'];?></td>
                <td><?= $dossier['adresseGeographieClient'];?></td>
                <td><?= $dossier['montant'];?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
<span style="color:red">Aucune correspondance</span>
<?php endif;?>
