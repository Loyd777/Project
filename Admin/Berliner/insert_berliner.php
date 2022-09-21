<?php
include "../headers.php";
//Initialisation des variables d'erreur et des variables représentant les champs dans la bdd.
 $nomError = $descriptionError = $priceError = $categoryError = $imageError = $nom = $description = $price = $category = $image="";


//Vérification du remplissement des champs.
 if (!empty($_POST))
 {
     $nom            = $_POST['nom'];
     $description    = $_POST['description'];
     $price          = $_POST['price'];
     $category       = $_POST['category_id'];
     $image          = $_FILES['image']['name'];
     $imagePath      ='../../image/' .basename($image);
     $imageExtension =pathinfo($imagePath, PATHINFO_EXTENSION);
     $isSucces       =true;
     $isUploadSucces =false;

     if(empty($nom))
     {
         $nomError = 'Vous devez remplir ce champ';
         $isSucces       =false;
     }

     if(empty($description))
     {
         $descriptionError = 'Vous devez remplir ce champ';
         $isSucces       =false;
     }

     if(empty($price))
     {
         $priceError = 'Vous devez remplir ce champ';
         $isSucces       =false;
     }
     if(empty($category))
     {
         $categoryError = 'Vous devez remplir ce champ';
         $isSucces       =false;
     }
     //Les contraintes par rapports à l'insertion des images.
     if(empty($image))
     {
         $imageError = 'Vous devez remplir ce champ';
         $isSucces       =false;
     }
     else{
         $isUploadSucces = true;
         if ($imageExtension !="jpg"  && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
             $imageError = "Les fichiers autorisés sont : .jpg, .png, .jpeg, .gif";
             $isUploadSucces = false;
         }
         if (file_exists($imagePath))
         {
             $imageError = "Le fichier existe déjà";
             $isUploadSucces = false;
         }
         if($_FILES["image"]["size"] > 500000)
         {
             $imageError = "Le fichier ne doit pas dépasser les 500KB";
             $isUploadSucces = false;
         }
         if ($isUploadSucces)
         {
             if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
             {
                 $imageError = "Il ya eu une erreur lors de l'upload";
                 $isUploadSucces = false;
             }
         }
     }
     //Vérifier que tous les champs en plus du champs pour l'image sont remplits.
     if ($isSucces && $isUploadSucces){
         $db = Database::connect();
         $statement = $db->prepare("INSERT INTO repas (nom,description,price,category_id,image,restau_id) value(?, ?, ?, ?, ?,4) ");
         $statement->execute(array($nom,$description,$price,$category,$image));
         Database::disconnect();
         header("Location: index_berliner.php");
     }
 }
?>
        <div class="row">
                <h1><strong>Ajouter un item </strong></h1>
        <br>
        <form class="form" role="form" action="insert_berliner.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $nom; ?>">
                <span class="help-inline"><?php echo $nomError;?></span>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;?>">
                <span class="help-inline"><?php echo $descriptionError;?></span>
            </div>
            <div class="form-group">
                <label for="price">Prix: (en FCFA)</label>
                <input type="number" step="10" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price;?>">
                <span class="help-inline"><?php echo $priceError;?></span>
            </div>
            <div class="form-group">
                <label for="category_id">Catégorie:</label>
               <select class="form-control" id="category_id" name="category_id">
                   <?php
                   $db = Database::connect();
                   foreach ($db->query('SELECT * FROM menu WHERE id in (2,3,5,6,8)') as $row)
                   {
                       echo '<option value="' . $row['id'] .'">' . $row['nom'] .'</option>';
                   }

                   Database::disconnect();
                   ?>
               </select>
                <span class="help-inline"><?php echo $categoryError;?></span>
            </div>
            <div class="form-group">
                <label for="image">Selectionner une image:</label>
                <input type="file" id="image" name="image">
                <span class="help-inline"><?php echo $imageError; ?></span>
            </div>
        <br>
        <div class="form-action">
            <button type="submit" class="btn btn-success"
             data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter le repas"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
            <a class="btn btn-primary" href="index_berliner.php"
             data-bs-toggle="tooltip" data-bs-placement="top" title="Retourner à la liste des repas"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>
        </form>
    </div>


