<?php
include "../headers.php";
if (!empty($_GET['id']))
{
    $id = $_GET['id'];
}
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
    $imagePath      ='../image/' .basename($image);
    $imageExtension =pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSucces       =true;


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
        $isImageUpdated = false;
    }
    else{
        $isImageUpdated = true;
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

    if (($isSucces && $isImageUpdated && $isUploadSucces) || ($isSucces &&!$isImageUpdated)){
        $db =Database::connect();
        if ($isImageUpdated)
        {
            $statement = $db->prepare("UPDATE repas set nom= ?,  description= ?,  price= ?,  category_id= ?,  image= ? WHERE id = ?  restau_id = 1");
            $statement->execute(array($nom,$description,$price,$category,$image,$id));
        }
        else{
            $statement = $db->prepare("UPDATE repas set nom= ?,  description= ?,  price= ?,  category_id= ? WHERE id = ? and restau_id = 1");
            $statement->execute(array($nom,$description,$price,$category,$id));
        }
        Database::disconnect();
        header("Location: index_mimis.php");
    }
    else if ($isImageUpdated && !$isUploadSucces)
    {
        $db =Database::connect();
        $statement = $db->prepare("SELECT image FROM repas  WHERE id = ? and restau_id = 1");
        $statement->execute(array($id));
        $repas = $statement->fetch();
        $image      = $repas['image'];
        Database::disconnect();
    }
}
else
{
    $db =Database::connect();
    $statement = $db->prepare("SELECT * FROM repas  WHERE id = ? and restau_id = 1");
    $statement->execute(array($id));
    $repas = $statement->fetch();
    $nom        = $repas['nom'];
    $description= $repas['description'];
    $price      = $repas['price'];
    $category   = $repas['category_id'];
    $image      = $repas['image'];
    Database::disconnect();
}
?>
    <div class="row">
        <div class="col-sm-6">
        <h1><strong>Modifier un item </strong></h1>
        <br>
        <form class="form" role="form" action="<?php echo 'update_mimis.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
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
                    Database::connect();
                    foreach ($db->query('SELECT * FROM menu WHERE id < 10') as $row)
                    {
                        if ($row['id'] == $category)
                        {
                            echo '<option selected="selected" value="' . $row['id'] .'">' . $row['nom'] .'</option>';
                        }
                        else{
                            echo '<option value="' . $row['id'] .'">' . $row['nom'] .'</option>';
                        }
                    }
                    $db = Database::disconnect();
                    ?>
                </select>
                <span class="help-inline"><?php echo $categoryError;?></span>
            </div>
            <div class="form-group">
                <label>Image:</label>
                <p><?php echo $image;?></p>
                <label for="image">Selectionner une image:</label>
                <input type="file" id="image" name="image">
                <span class="help-inline"><?php echo $imageError; ?></span>
            </div>
            <br>
            <div class="form-action">
                <button type="submit" class="btn btn-success"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le repas"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                <a class="btn btn-primary" href="index_mimis.php"
               data-bs-toggle="tooltip" data-bs-placement="top" title="Retourner à la liste des repas"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </form>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail" >
                <img src="<?php echo '../../templates/css/image/' . $repas['image'] ; ?>" alt="...">
                <div class="price"><?php echo $repas['price'] . 'FCFA';?></div>
                <div class="caption">
                    <h4><?php echo $repas['nom']; ?></h4>
                    <p><?php echo $repas['description']; ?></p>
                    <a href="#" class="btn btn-order role=button"><span class="glyphicon glyphicon-shopping-cart"></span>Commander</a>
                </div>
            </div>
        </div>
    </div>


