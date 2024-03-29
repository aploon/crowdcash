<?php 
    require_once(__DIR__.'/../db.php');
    require_once(__DIR__.'/../fonctions.php');

    $output = '';

    if(isset($_POST['btn_action'])){
        if($_POST['btn_action'] == 'view'){
            
            $id_contributeur = $_POST['id_contributeur'];

            $query = "SELECT * FROM contributeur, personne WHERE contributeur.id_personne_fk_contributeur = personne.id_personne AND id_contributeur = $id_contributeur";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetch();

            $query1 = "SELECT * FROM assoc_projet_and_contributeur WHERE id_contributeur_fk_assoc_projet_and_contributeur = $id_contributeur";
            $statement1 = $db->prepare($query1);
            $statement1->execute();
            $nbrContrib = $statement1->rowCount();
            
            

            if ($result['statut_contributeur'] == 'Actif') {
                $status = '<span class="badge badge-primary">Actif</span>';
            } else {
                $status = '<span class="badge badge-danger">Inactif</span>';
            }

            
            $output .= '    <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center;"><img class="rounded-circle" style="width: 150px;" src="/crowdcash/assets/img/img-personne/'.$result['img_personne'].'"></td>
                                    </tr> 
                                    <tr>
                                        <th>Contributeur : </th>
                                        <td>'.$result['nom_personne'].' '.$result['prenom_personne'].'</td>
                                    </tr> 
                                    <tr>
                                        <th>Adresse/Tel du contributeur : </th>
                                        <td>'.$result['adresse_personne'].'</td>
                                    </tr> 
                                    <tr>
                                        <th>Numéro de téléphone : </th>
                                        <td>'.$result['tel_personne'].'</td>
                                    </tr>
                                    <tr>
                                        <th>Email du contributeur: </th>
                                        <td>'.$result['email_personne'].'</td>
                                    </tr> 
                                    <tr>
                                        <th>Date de naissance : </th>
                                        <td>'.$result['date_naiss_personne'].'</td>
                                    </tr>    
                                    <tr>
                                        <th>Nationnalité du contributeur : </th>
                                        <td>'.$result['nationnalite_personne'].'</td>
                                    </tr>  
                                    <tr>
                                        <th>Sexe du contributeur : </th>
                                        <td>'.$result['sexe_personne'].'</td>
                                    </tr>  
                                    <tr>
                                        <th>Nombre de contribution : </th>
                                        <td>'.$nbrContrib.' Projets</td>
                                    </tr>    
                                    <tr>
                                        <th>Statut du contributeur : </th>
                                        <td>'.$status.'</td>
                                    </tr>
                                </tbody>
                            </table>'; 
        }

        if($_POST['btn_action'] == 'update'){

            $id_contributeur = $_POST['id_contributeur'];

            $query = "SELECT * FROM contributeur, personne WHERE contributeur.id_personne_fk_contributeur = personne.id_personne AND id_contributeur = $id_contributeur";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetch();


            $output = '
                        <form method="post" id="id_updateContrib_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title_modif">Modification contributeur</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nom du contributeur </label>
                                        <input type="text" value="'.$result['nom_personne'].'" name="nom_personne" id="nom_personne" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Prenom du contributeur</label>
                                        <input type="text" value="'.$result['prenom_personne'].'" name="prenom_personne" id="prenom_personne" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Adresse </label>
                                        <input type="text" value="'.$result['adresse_personne'].'" name="adresse_personne" id="adresse_personne" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input type="email" value="'.$result['email_personne'].'" name="email_personne" id="email_personne" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Date de naissance </label>
                                        <input type="date" value="'.$result['date_naiss_personne'].'" name="date_naiss_personne" id="date_naiss_personne" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nationnalité </label>
                                        <input type="text" value="'.$result['nationnalite_personne'].'" name="nationnalite_personne" id="nationnalite_personne" class="form-control">
                                    </div>
                    
                                    <div class="form-group">
                                        <label>Sexe </label>
                                        <select name="sexe_personne" id="sexe_personne" class="form-control" required="">'.select('sexe_personne', 'personne', $db, $result['sexe_personne']).'</select>
                                    </div>
                    
                                </div>
                    
                                <div class="modal-footer bg-whitesmoke">
                                    <input type="text" value="'.$result['id_personne'].'" name="id_personne" id="id_personne" class="form-control d-none" required="">
                                    <button type="submit" class="btn btn-primary btn-shadow save-edit-bouton_modif" name="action_modif" id="action_modif">Modifier</button>
                                </div>
                            </div>
                        </form>';
        }

        if($_POST['btn_action'] == 'activity'){

            $id_contributeur = $_POST['id_contributeur'];
            $status = ($_POST['status'] == 'Actif') ? 'Inactif' : 'Actif';
            

            $query = "UPDATE contributeur set statut_contributeur = :statut_contributeur WHERE id_contributeur = $id_contributeur";
            $statement = $db->prepare($query);
            $statement->bindParam('statut_contributeur', $status);

            if($statement->execute()){
                $output = 'Statut modifié';
            }
              
        }

        if($_POST['btn_action'] == 'delete'){

            $id_contributeur = $_POST['id_contributeur'];
            

            $query = "UPDATE contributeur set statut_contributeur = 'delete' WHERE id_contributeur = $id_contributeur";
            $statement = $db->prepare($query);

            if($statement->execute()){
                $output = 'Contributeur supprimé';
            }
              
        }
    }

    if(isset($_POST['id_personne'])){
        $id_personne = $_POST['id_personne'];
        $nom_personne = $_POST['nom_personne'];
        $prenom_personne = $_POST['prenom_personne'];
        $adresse_personne = $_POST['adresse_personne'];
        $email_personne = $_POST['email_personne'];
        $nationnalite_personne = $_POST['nationnalite_personne'];
        $date_naiss_personne = $_POST['date_naiss_personne'];
        $sexe_personne = $_POST['sexe_personne'];
        
    
        $query = "UPDATE personne SET nom_personne = :nom_personne , prenom_personne = :prenom_personne , adresse_personne = :adresse_personne , email_personne = :email_personne , nationnalite_personne = :nationnalite_personne , date_naiss_personne = :date_naiss_personne , sexe_personne = :sexe_personne  WHERE id_personne = $id_personne ;";
        $statement = $db->prepare($query);
        $statement->bindParam(':nom_personne', $nom_personne);
        $statement->bindParam(':prenom_personne', $prenom_personne);
        $statement->bindParam(':adresse_personne', $adresse_personne);
        $statement->bindParam(':email_personne', $email_personne);
        $statement->bindParam(':nationnalite_personne', $nationnalite_personne);
        $statement->bindParam(':date_naiss_personne', $date_naiss_personne);
        $statement->bindParam(':sexe_personne', $sexe_personne);
       
        
        if($statement->execute()){
            $output = 'Contributeur modifié';
        }

    }

    echo json_encode($output);
