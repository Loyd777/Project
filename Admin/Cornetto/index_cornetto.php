<?php
include "../headers.php";
?>
    <div class="row">
       <h1><strong>Liste des items </strong><a href="insert_cornetto.php" class="btn btn-success btn-lg"
       data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter un repas">
            <span class="glyphicon glyphicon-plus"></span> Ajouter</a>

           <a href="../log-out.php?logout=1" class="btn btn-danger btn-lg" style="transform: translate(500px)"
              type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Se déconnecter du compte">Déconnexion
               <span class="glyphicon glyphicon-log-out"></span></a>

       </h1>
        <h4><a href="../../Cornetto.php" style="color: #e7480f;;
text-shadow: 2px 2px black;font-family: 'Holtwood One SC';">Cornetto</a></h4>
                 <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $db = Database::connect();
        $statement = $db->query('SELECT repas.id, repas.nom, repas.description, repas.price,
        menu.nom AS category_id FROM repas LEFT JOIN menu ON repas.category_id = menu.id WHERE `restau_id`= 5 
        ORDER BY repas.id DESC');
        while($repas = $statement->fetch())
        {
           echo'<tr>' ;
            echo ' ';
           echo'<td>'.$repas['nom']. '</td>' ;
            echo'<td>'.$repas['description']. '</td>' ;
            echo'<td>'.$repas['price']. '</td>' ;
            echo'<td>'.$repas['category_id']. '</td>' ;
            echo'<td width="300"> '  ;
             echo'<a class="btn btn-default" href="view_cornetto.php?id=' . $repas['id'] .'"
 data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le repas"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>' ;
             echo ' ';
              echo'<a class="btn btn-primary" href="update_cornetto.php?id=' . $repas['id'] .'"
 data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le repas"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>'  ;
            echo ' ';
               echo'<a class="btn btn-danger" href="delete_cornetto.php?id=' . $repas['id'] .'"
 data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer le repas"><span class="glyphicon glyphicon-remove"></span>Supprimer</a>' ;
            echo ' ';
           echo'</td>' ;
       echo'</tr>' ;
        }
        Database::disconnect();
          ?>
        </tbody>
    </table>
</div>
