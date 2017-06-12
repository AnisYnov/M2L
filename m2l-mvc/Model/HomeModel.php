<?php

namespace Model;

use Core\Model;

class HomeModel extends Model
{
    public function getUser($id){

        $pdo = self::$pdo;
        $sql = "
          SELECT  
            `prenom`, 
            `credit`, 
            `nbs_jour` 
          FROM 
            `salarie` 
          WHERE 
            `id_s` = :id_s ";
        $req = $pdo-> prepare($sql);
        $req->bindValue(":id_s", $id);
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return $req->fetch(\PDO::FETCH_OBJ);
    }
    public function getAllUserSalarie(){
        $pdo = self::$pdo;
        $sql="
          SELECT 
            `id_s`, 
            `nom`, 
            `prenom`, 
            `email`, 
            `credit`, 
            `nbs_jour`
          FROM 
            `salarie`
          WHERE 
            `status`='salarié'";
        $req= $pdo->prepare($sql);
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return $req->fetchAll(\PDO::FETCH_OBJ);
    }
    public function getUserSalarie($id_s){
        $pdo = self::$pdo;
        $sql = "
         SELECT 
           `id_s`, 
           `nom`, 
           `prenom`, 
           `email`, 
           `credit`, 
           `nbs_jour`
         FROM 
           `salarie`
         WHERE 
           `status`='salarié'
            AND `id_s` = :id_s ";
        $req= $pdo->prepare($sql);
        $req->bindValue(":id_s", $id_s);
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return $req->fetch(\PDO::FETCH_OBJ);
    }
    public function getUserCreditNbsJ($id_s){
        $pdo = self::$pdo;
        $sql = "
        SELECT  
          `credit`, 
          `nbs_jour` 
        FROM 
          `salarie` 
        WHERE 
          `id_s` = :id_s ";
        $req = $pdo-> prepare($sql);
        $req->bindValue(":id_s", $id_s);
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return $req->fetch(\PDO::FETCH_OBJ);
    }
    public function setUserCreditNbsJ($id_s, $tCredit, $tJour){
        $pdo = self::$pdo;
        $sql = "
        UPDATE 
          `salarie` 
        SET 
          `credit` = :tCredit, 
          `nbs_jour` = :tJour 
        WHERE 
          `id_s` = :id_s ";
        $req = $pdo-> prepare($sql);
        $req->bindValue(":id_s", $id_s);
        $req->bindValue(":tCredit", $tCredit);
        $req->bindValue(":tJour", $tJour);
        $req->execute();

        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return true;
    }

    public function getLogin($identifiant,$mdp)
    {
        $pdo = self::$pdo;
        $sql= "
        SELECT 
          `id_s`,
          `identifiant`,
          `status`
        FROM 
          `salarie`
        WHERE 
          `identifiant` = :identifiant
          AND `mot_de_passe` = :mot_de_passe";
        $req = $pdo->prepare($sql);
        $req->bindValue(":identifiant", $identifiant);
        $req->bindValue(":mot_de_passe",$mdp);
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return $req->fetch(\PDO::FETCH_OBJ) ;
    }

    public function getListFormation()
    {
        $pdo = self::$pdo;
        $sql = "
        SELECT 
          f.id_f, 
          titre, 
          duree, 
          cout, 
          date_debut, 
          nb_place, 
          contenu, 
          numero_rue, 
          rue, 
          ville, 
          code_postal, 
          raison_social 
        FROM 
          formation f, 
          adresse a, 
          prestataire p 
        WHERE 
          f.id_a=a.id_a 
          AND f.id_p=p.id_p";
        $req = $pdo->prepare($sql);
        $req->execute();
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return $row = $req->fetchAll(\PDO::FETCH_OBJ);
    }
    public function getFormationCoutDuree($id_f){
        $pdo = self::$pdo;
        $sql="
        SELECT 
          `duree`, 
          `cout` 
        FROM 
          `formation` 
        WHERE 
          `id_f` = :id_f";
        $req= $pdo->prepare($sql);
        $req->bindvalue(":id_f",$id_f);
        $req->execute();
        return  $req->fetch(\PDO::FETCH_OBJ);
    }
    public function setAddFormationValide($id_s, $id_f){

        $pdo = self::$pdo;
        $sql = "
          INSERT 
          INTO 
            `formation_valide`(`id_f`, `id_s`)
          VALUES (
            :id_f,
            :id_s
          ) ";
        $req = $pdo->prepare($sql);
        $req->bindvalue(":id_f",$id_f);
        $req->bindvalue(":id_s",$id_s);
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('insert formation Valid');
        }
        return true;
    }
    public function getListFormationAbonnee($id_s,$etat_f)
    {
        $pdo = self::$pdo;
        $sql = "
        SELECT 
            f.id_f, 
            titre, 
            duree, 
            cout, 
            date_debut, 
            nb_place, 
            contenu, 
            numero_rue, 
            rue, 
            ville, 
            code_postal, 
            raison_social, 
            etat_f 
        FROM 
            formation f, 
            formation_valide fv, 
            adresse a, 
            prestataire p 
        WHERE 
          f.id_a=a.id_a 
          AND f.id_p=p.id_p 
          AND fv.id_f=f.id_f 
          AND etat_f= :etat_f
          AND fv.id_s = :id_s ";
        $req = $pdo->prepare($sql);
        $req->bindVAlue(":id_s",$id_s);
        $req->bindVAlue(":etat_f",$etat_f);
        $req->execute();
        $req->execute();
        if($req->errorCode() !== '00000'){
            throw new \Exception('err affiche list formation abonnée');
        }
        return $row = $req->fetchAll(\PDO::FETCH_OBJ);
    }
    public function setUpdateFormationValide($id_s, $id_f,$etat_f){
        $pdo = self::$pdo;
        $sql="
        UPDATE 
          `formation_valide`
        SET 
          `etat_f` = :etat_f
        WHERE 
          id_f = :id_f 
          AND id_s = :id_s ";
        $req = $pdo->prepare($sql);
                $req->bindvalue(":id_f",$id_f);
                $req->bindvalue(":id_s",$id_s);
                $req->bindvalue(":etat_f",$etat_f);
                $req->execute();
                if($req->errorCode() !== '00000'){
                    throw new \Exception('insert formation Valid');
                }
                return true;
    }
}
