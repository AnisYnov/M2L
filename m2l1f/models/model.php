<?php
// require_once"config.php";

function cnx(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "m2l";


    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);



        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch(PDOException $e)
    {

        echo "Connection raté: " . $e->getMessage();
    }

    $pdo->exec('set names utf8');
    return $pdo;
}

function user($id_s){
    $pdo = cnx();
    $sql = "SELECT  `prenom`, `credit`, `nbs_jour` FROM `salarie` WHERE `id_s` = :id_s ";
    $req = $pdo-> prepare($sql);
    $req->bindValue(":id_s", $id_s);
    $req->execute();
    return $req->fetch();
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
function login($identifiant,$mdp){
    $pdo = cnx();
    $sql=
        "SELECT `id_s`,`identifiant`,`status`
  FROM `salarie`
  WHERE `identifiant` = :identifiant AND `mot_de_passe` = :mot_de_passe";
    $requser = $pdo->prepare($sql);
    $requser->bindValue(":identifiant", $identifiant);
    $requser->bindValue(":mot_de_passe",$mdp);
    $requser->execute();
    return $requser->fetch() ;
}

function formationAValider($etat,$id_f, $id_s){
    $pdo = cnx();

    if ($_GET['etat'] == "valider" ) {
        $sql='SELECT  nb_place
    FROM formation
    WHERE id_f = :id_f ';

        $req= $pdo->prepare($sql);
        $req->bindValue(":id_f",$_GET['id_f']);
        $req->execute();
        $row= $req->fetch();

        $nb = $row['nb_place'] - 1;

        $sql='UPDATE `formation`
    SET `nb_place` = :nb
    WHERE id_f = :id_f ';

        $req= $pdo->prepare($sql);
        $req->bindValue(":id_f",$_GET['id_f']);
        $req->bindValue(":nb",$nb);
        $req->execute();

        $sql='UPDATE `formation_valide`
    SET `etat_f` = "valider"
    WHERE id_f = :id_f AND id_s = :id_s ';

        $req= $pdo->prepare($sql);
        $req->bindValue(":id_f",$_GET['id_f']);
        $req->bindValue(":id_s",$_GET['id_s']);
        $req->execute();

    }

    elseif ($_GET['etat'] == "refusé" ) {
        $sql='SELECT duree, cout FROM formation WHERE id_f = :id_f';
        $req= $pdo->prepare($sql);
        $req->bindvalue(":id_f",$_GET['id_f']);
        $req->execute();
        $data = $req->fetch();

        $cout = $data['cout'];
        $duree = $data['duree'];

        // $totalJ= $nbs_jour + $duree;
        // $totalC= $credit + $cout;
        //
        // $sql = "UPDATE `salarie` SET credit = :tCout, nbs_jour = :tJour WHERE `id_s` = :id_s";
        // $req = $pdo-> prepare($sql);
        // $req->bindValue(":id_s", $_SESSION['id_s']);
        // $req->bindValue(":tJour", $totalJ);
        // $req->bindValue(":tCout", $totalC);
        // $req->execute();


        $sql = "SELECT  credit, nbs_jour FROM `salarie` WHERE `id_s` = :id_s ";
        $req = $pdo-> prepare($sql);
        $req->bindValue(":id_s", $id_s);
        $req->execute();
        $data = $req->fetch();

        $nbs_jour = $data['nbs_jour'];
        $credit = $data['credit'];

        $totalJ= $nbs_jour + $duree;
        $totalC= $credit + $cout;

        $sql = "UPDATE `salarie` SET credit = :tCout, nbs_jour = :tJour WHERE `id_s` = :id_s";
        $req = $pdo-> prepare($sql);
        $req->bindValue(":id_s", $_SESSION['id_s']);
        $req->bindValue(":tJour", $totalJ);
        $req->bindValue(":tCout", $totalC);
        $req->execute();

        $sql='UPDATE `formation_valide`
    SET `etat_f` = "refusé"
    WHERE id_f = :id_f AND id_s = :id_s ';

        $req= $pdo->prepare($sql);
        $req->bindValue(":id_f",$_GET['id_f']);
        $req->bindValue(":id_s",$_GET['id_s']);
        $req->execute();
    }
}
function formationAboner($id_f, $id_s){
    $pdo = cnx();
    $sql='SELECT duree, cout FROM formation WHERE id_f = :id_f';
    $req= $pdo->prepare($sql);
    $req->bindvalue(":id_f",$id_f);
    $req->execute();
    $data = $req->fetch();

    $cout = $data['cout'];
    $duree = $data['duree'];


    $sql = "SELECT  credit, nbs_jour FROM `salarie` WHERE `id_s` = :id_s ";
    $req = $pdo-> prepare($sql);
    $req->bindValue(":id_s", $id_s);
    $req->execute();
    $data = $req->fetch();

    $credit = $data['credit'];
    $nbs_jour = $data['nbs_jour'];

    if ($credit == 0) {
        echo "plus de credit";
    }elseif ($credit < $cout) {
        echo "pas asser de credit";}
    elseif ($nbs_jour == 0) {
        echo "plus de jour de formation";
    }elseif ($nbs_jour < $duree) {
        echo "pas asser de jour de formation";
    }else {
        $totalJ= $nbs_jour - $duree;
        $totalC= $credit - $cout;

        $sql = "UPDATE `salarie` SET credit = :tCout, nbs_jour = :tJour WHERE `id_s` = :id_s";
        $req = $pdo-> prepare($sql);
        $req->bindValue(":id_s", $id_s);
        $req->bindValue(":tJour", $totalJ);
        $req->bindValue(":tCout", $totalC);
        $req->execute();

        $sql = "INSERT INTO `formation_valide`(`id_f`, `id_s`) VALUES (:id_f, :id_s) ";
        $req = $pdo->prepare($sql);
        $req->bindvalue(":id_f",$id_f);
        $req->bindvalue(":id_s",$id_s);
        $req->execute();
        echo "formation ajouter";

    }
}

function formation(){
    $pdo = cnx();
    $sql='SELECT f.id_f, titre, duree, cout, date_debut, nb_place, contenu, numero_rue, rue, ville, code_postal, raison_social FROM formation f, adresse a, prestataire p WHERE f.id_a=a.id_a AND f.id_p=p.id_p';
    $req= $pdo->prepare($sql);
    $req->execute();
    while($row = $req->fetch()): ?>
        <tr>
            <td><?= $row['titre']; ?></td>
            <td><?= $row['duree'];  ?></td>
            <td><?= $row['cout'];  ?></td>
            <td><?= $row['date_debut'];  ?></td>
            <td><?= $row['nb_place'];  ?></td>
            <td><?= $row['contenu'];  ?></td>
            <td><?= $row['numero_rue'];  ?></td>
            <td><?= $row['rue'];  ?></td>
            <td><?= $row['ville'];  ?></td>
            <td><?= $row['code_postal'];  ?></td>
            <td><?= $row['raison_social'];  ?></td>
            <td><a href="../controllers/formation-aboner.php?id_f=<?= $row['id_f']; ?>"php>acepter</a></td>
        </tr>
    <?php endwhile;
    return $row;
}
function formationValider($id_s){
    $pdo = cnx();
    $sql='SELECT f.id_f,raison_social, titre, duree, cout, date_debut, nb_place, contenu, numero_rue, rue, ville, code_postal, nom, etat_f FROM formation f,formation_valide fv, adresse a, prestataire p WHERE f.id_a=a.id_a AND f.id_p=p.id_p and fv.id_f=f.id_f and etat_f="valider" AND fv.id_s = :id_s';
    $req= $pdo->prepare($sql);
    $req->bindVAlue(":id_s",$id_s);
    $req->execute();
    while($row = $req->fetch()): ?>
        <tr>
            <td><?= $row['titre']; ?></td>
            <td><?= $row['duree'];  ?></td>
            <td><?= $row['cout'];  ?></td>
            <td><?= $row['date_debut'];  ?></td>
            <td><?= $row['nb_place'];  ?></td>
            <td><?= $row['contenu'];  ?></td>
            <td><?= $row['numero_rue'];  ?></td>
            <td><?= $row['rue'];  ?></td>
            <td><?= $row['ville'];  ?></td>
            <td><?= $row['code_postal'];  ?></td>
            <td><?= $row['raison_social'];  ?></td>
            <td><a href="../model/fromationAboner.php?id_f=<?= $row['id_f']; ?>"php>acepter</a></td>
        </tr>
    <?php endwhile;
    return $row;
}
function formationHistorique($id_s){
    $pdo = cnx();

    $sql='SELECT f.id_f, titre, duree, cout, date_debut, nb_place, contenu, numero_rue, rue, ville, code_postal, raison_social, etat_f FROM formation f,formation_valide fv, adresse a, prestataire p WHERE f.id_a=a.id_a AND f.id_p=p.id_p and fv.id_f=f.id_f and etat_f="effectuée " AND fv.id_s = :id_s';
    $req= $pdo->prepare($sql);
    $req->bindVAlue(":id_s",$id_s);
    $req->execute();
    while($row = $req->fetch()): ?>
        <tr>
            <td><?= $row['titre']; ?></td>
            <td><?= $row['duree'];  ?></td>
            <td><?= $row['cout'];  ?></td>
            <td><?= $row['date_debut'];  ?></td>
            <td><?= $row['nb_place'];  ?></td>
            <td><?= $row['contenu'];  ?></td>
            <td><?= $row['numero_rue'];  ?></td>
            <td><?= $row['rue'];  ?></td>
            <td><?= $row['ville'];  ?></td>
            <td><?= $row['code_postal'];  ?></td>
            <td><?= $row['raison_social'];  ?></td>
        </tr>
    <?php endwhile;
    return $row;
}
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

function listeSalarie(){
    $pdo = cnx();
    $sql=
        "SELECT `id_s`,`nom`,`prenom`,`email`,`credit`,`nbs_jour`
  FROM `salarie`
  WHERE `status`='salarié'";
    $req= $pdo->prepare($sql);
    $req->execute();
    while($row = $req->fetch()): ?>
        <tr>
            <td><?= $row['nom']; ?></td>
            <td><?= $row['prenom'];  ?></td>
            <td><?= $row['email'];  ?></td>
            <td><?= $row['credit'];  ?></td>
            <td><?= $row['nbs_jour'];  ?></td>
            <td><a href="./detail-salarie.php?id_s=<?= $row['id_s']; ?>"php>details</a></td>
        </tr>
    <?php endwhile;
    return $row;
}
function detailSalarie($id_s){
    $pdo = cnx();
    $sql='SELECT f.id_f, titre, duree, cout, date_debut, nb_place, contenu, numero_rue, rue, ville, code_postal, raison_social, etat_f FROM formation f,formation_valide fv, adresse a, prestataire p WHERE f.id_a=a.id_a AND f.id_p=p.id_p AND fv.id_f=f.id_f and etat_f="en cours de validation" AND id_s = :id_s';
    $req= $pdo->prepare($sql);
    $req->bindvalue(":id_s",$id_s);
    $req->execute();
    while($row = $req->fetch()): ?>
        <tr>
            <td><?= $row['titre'];  ?></td>
            <td><?= $row['duree'];  ?></td>
            <td><?= $row['cout'];  ?></td>
            <td><?= $row['date_debut'];  ?></td>
            <td><?= $row['nb_place'];  ?></td>
            <td><?= $row['contenu'];  ?></td>
            <td><?= $row['numero_rue'];  ?></td>
            <td><?= $row['rue'];  ?></td>
            <td><?= $row['ville'];  ?></td>
            <td><?= $row['code_postal'];  ?></td>
            <td><?= $row['raison_social'];  ?></td>
            <td><?= $row['etat_f']; ?></a></td>
            <td><a href="../controllers/formation-valider.php?id_f=<?= $row['id_f']; ?>&etat=valider&id_s=<?= $_GET['id_s']; ?> "php>valider</a>
                <a href="../controllers/formation-valider.php?id_f=<?= $row['id_f']; ?>&etat=refusé&id_s=<?= $_GET['id_s']; ?>  "php>refusé</a></td>

        </tr>
    <?php endwhile;
    return $row;
}
