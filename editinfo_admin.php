<?php include('inc/header.php');?>
<?php 
    if (empty($_SESSION["login_adm"]) || $_SESSION["login_adm"] != 1)
    {
        header("Location: connexion.php");
        exit();   
    }
    if(empty($_GET) || empty($_GET['id']))
    {
        header("location : 404.php");
        exit();
    }
    else
    {
        $utilisateur = $pdo->query("select * from utilisateur where id_utilisateur = ".$_GET['id'].";")->fetch();
        if(empty($utilisateur))
        {
            header('location : 404.php');
        }

        if(!empty($_POST))
        {
            if(!empty($_POST["nom"]))
            {
                $_POST["nom"]= str_replace("'", "\'", $_POST['nom']);
                $_POST["nom"] = str_replace('"', '\"', $_POST["nom"]);

                $sql = "update utilisateur set nom ='". $_POST['nom']."'where id_utilisateur =".$utilisateur['id_utilisateur'].";";
                $pdo->exec($sql); 
            }
            
            if(!empty($_POST["prenom"]))
            {
                $_POST["prenom"]= str_replace("'", "\'", $_POST['prenom']);
                $_POST["prenom"] = str_replace('"', '\"', $_POST["prenom"]);

                $sql = "update utilisateur set prenom ='". $_POST['prenom']."'where id_utilisateur =".$utilisateur['id_utilisateur'].";";
                $pdo->exec($sql); 
            }
            
            $sql = "update utilisateur set sexe ='". $_POST['sexe']."'where id_utilisateur =".$utilisateur['id_utilisateur'].";";
            $pdo->exec($sql); 

            if(!empty($_POST["email"]))
            {
                $_POST["email"]= str_replace("'", "\'", $_POST['email']);
                $_POST["email"] = str_replace('"', '\"', $_POST["email"]);

                $sql = "update utilisateur set email ='". $_POST['email']."'where id_utilisateur =".$utilisateur['id_utilisateur'].";";
                $pdo->exec($sql); 
            }

            if(!empty($_POST["mdp"]))
            {
                $sql = "update utilisateur set mot_de_passe ='". md5($_POST['mdp'])."'where id_utilisateur =".$utilisateur['id_utilisateur'].";";
                $pdo->exec($sql);
            }

            $sql = "update utilisateur set capital ='". $_POST['capital']."'where id_utilisateur =".$utilisateur['id_utilisateur'].";";
            $pdo->exec($sql); 

            if(!empty($_POST['spprpdp']) && $_POST['spprpdp'] == 'on')
            {
                $sql = 'update utilisateur set image_profil = "img/site/profil_defaut.jpg" where id_utilisateur = '.$utilisateur["id_utilisateur"].';';
                $pdo->exec($sql);
            }

            $utilisateur = $pdo->query("select * from utilisateur where id_utilisateur = ".$_GET['id'].";")->fetch();
        }?>


            <section>
                <div>
                    <div>
                        <h1>
                        Modifier les infos de <?php echo $utilisateur['prenom'] ?>
                        </h1>
                    </div>
                    <div>
                        <form action="" method = "POST">
                            <div>
                                <label for="id">ID</label><br>
                                <input type="text" name='id' id='id' placeholder = "<?php echo $utilisateur['id_utilisateur'];?>" readonly>
                            </div>
                            <div>
                                <label for="prenom">Prénom</label><br>
                                <input type="text" name='prenom' id='prenom' placeholder = "<?php echo $utilisateur['prenom'];?>">
                            </div>
                            <div>
                                <label for="nom">Nom</label><br>
                                <input type="text" name='nom' id='nom' placeholder = "<?php echo $utilisateur['nom'] ; ?>">
                            </div>
                                <label for="sexe">Sexe</label><br>
                                <select id="sexe" name="sexe">
                                    <?php if($utilisateur['sexe'] == 'm'){?>
                                    <option value="m" selected>Homme</option> 
                                    <option value="f">Femme</option>
                                    <?php } 
                                    else { ?>
                                        <option value="m">Homme</option>
                                        <option value="f" selected>Femme</option>
                                        <?php } ?>
                                </select>

                            <div>
                                <label for="mdp">Mot de passe</label><br>
                                <input type="password" name='mdp' id='mdp'>
                            </div>
                            <div>
                                <label for="capital">Capital</label><br>
                                <input type="number" name='capital' id='capital' value= "<?php echo $utilisateur['capital'] ;?>">
                            </div>
                            <div>
                                <label for="pdp">Image de profil : </label><br>
                                <img class="pdp" style="width:300px"  src="<?php echo $utilisateur['image_profil'];?>" ><br>
                                <label for="boite">Supprimer ? </label>
                                <input type="checkbox" id='boite' name = "spprpdp" placeholder = 'supprimer ?' alt="photo de profil">
                            <div>
                            <div>
                                <input type="submit" value= "Enregistrer les modifications">
                            </div>
                        </div>
                    </div>
                        
                        </form>
                    </div>
                </div>
            
            </section>
            <?php
        }
    
?>




<?php include('inc/footer.php');?>