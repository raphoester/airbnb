<?php include('inc/header.php');?>
<?php 
    if (empty($_SESSION["login_adm"]) || $_SESSION["login_adm"] != 1)
    {
        header("Location: connexion.php");
        exit();   
    }

    $sql = "select * from utilisateur;";
    $utilisateurs = $pdo->query($sql)->fetchAll();

    if(!empty($_GET))
    {
        if(!empty($_GET['idban']))
        {
            $sql = "update utilisateur set banni = True where id_utilisateur = ".$_GET['idban'].";";
            $pdo->exec($sql);
        }

        if(!empty($_GET['idsuppr']))
        {
            $sql = "delete from utilisateur where id_utilisateur = ".$_GET['idsuppr'].";";
            $pdo->exec($sql);
        }

        if(!empty($_GET['idexpl']))
        {
            $date_fin = strtotime("+7 day");
            $sql = "update utilisateur set date_fin_exclusion ='".date('Y-m-d H:i:s', $date_fin)."where id_utilisateur = ".$_GET['idexpl'].";";
            $pdo->exec($sql);
        }
    }
    


?>

<section>
    <div>
        <h1>
            Liste des inscrits :
        </h1>
    </div>
    <div>
        <table>
            <thead>                
                <th>ID </th>                               
                <th>Prénom </th>                                
                <th>Oester </th>                               
                <th>Adresse mail </th>                              
                <th>Date d'inscription </th>                              
                <th>Sexe </th>                              
                <th>Note </th>               
                <th>Statut </th>
                <th>Solde </th>        
                <th>Bannissement </th>
                <th>Dernier bannissement </th>
                <th>Modifier les détails </th>
                <th>Voir les messages </th>
                <th>Bannir </th>
                <th>Bannir 7 jours </th>
                <th>Supprimer le profil </th>
            </thead>
            <tbody>
            <?php 
            for($i = 0 ; $i < count($utilisateurs) ; $i++)
            {
                ?>
                <tr>
                    <td><?php echo $utilisateurs[$i]["id_utilisateur"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["prenom"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["nom"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["email"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["date_creation_compte"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["sexe"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["note"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["statut"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["capital"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["banni"] ; ?></td>
                    <td><?php echo $utilisateurs[$i]["date_fin_exclusion"] ; ?></td>
                    <td><a href="editinfo_admin.php?id=<?php echo $utilisateurs[$i]['id_utilisateur'] ;?>">👥</a></td>
                    <td><a href="voirmessages_admin.php?id=<?php echo $utilisateurs[$i]['id_utilisateur'] ;?>">💬</a></td>
                    <td><a href="?idban=<?php echo $utilisateurs[$i]['id_utilisateur'];?>">🚫</a></td>
                    <td><a href="?idexpl=<?php echo $utilisateurs[$i]['id_utilisateur'];?>">🗓️</a></td>
                    <td><a href="?idsuppr=<?php echo $utilisateurs[$i]['id_utilisateur'];?>">❌</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<?php include('inc/footer.php');?>