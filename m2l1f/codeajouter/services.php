<?php
function formationRecherche($search){
    $pdo = cnx();

    $sql="SELECT f.id_f, titre, duree, cout, date_debut, nb_place, contenu, numero_rue, rue, ville, code_postal, raison_social FROM formation f, adresse a, prestataire p WHERE f.id_a=a.id_a AND f.id_p=p.id_p AND `titre` LIKE :search ";
    $req= $pdo->prepare($sql);
    $req->bindvalue(":search",'%'.$search.'%');
    $req->execute();
    while($row = $req->fetch()): ?>
        <tr>
            <td><?= $row['titre']; ?></td>
            <td><?= $row['date_debut'];  ?></td>
            <td><?= $row['duree'];  ?></td>
            <td><?= $row['cout'];  ?></td>
            <td><?= $row['nb_place'];  ?></td>
            <td><?= $row['contenu'];  ?></td>
            <td><?= $row['numero_rue'],$row['rue'],$row['ville'];  ?></td>
            <td><?= $row['raison_social'];  ?></td>
            <td><a href="../model/formation-aboner.php?id_f=<?= $row['id_f']; ?>"php>acepter</a></td>
        </tr>
    <?php endwhile;
    return $row;
}
function userMail($email){
    $pdo = cnx();
    $sql = "SELECT  `id_s`, `email` FROM `salarie` WHERE `email` = :email ";
    $req = $pdo-> prepare($sql);
    $req->bindValue(":email", $email);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}
function editpwd($id_s, $pwd){
    $pdo = cnx();
    $sql ="UPDATE `salarie` SET `mot_de_passe` = :pwd WHERE `salarie`.`id_s` = :id_s";
    $req = $pdo-> prepare($sql);
    $req->bindValue(":pwd", $pwd);
    $req->bindValue(":id_s", $id_s);
    $req->execute();
    return true;
}