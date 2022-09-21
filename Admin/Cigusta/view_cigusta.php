<?php
include "../headers.php";
if (!empty($_GET['id'])){
    $id = checkInput ($_GET['id']);
}

$db = Database::connect();
$statement =  $db->prepare('SELECT repas.id, repas.nom, repas.description, repas.image, repas.price,
            menu.nom AS category_id FROM repas LEFT JOIN menu ON repas.category_id = menu.id 
            WHERE repas.id = ?');

$statement->execute(array($id));
    $repas = $statement->fetch();
    Database::disconnect();

    function checkInput($data)
    {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    ?>
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Voir un item <span class=""></strong></h1>
            <br>
            <form>
                <div class="form-group">
                    <label>Nom:</label><?php echo ' ' .$repas['nom'];?>
                </div>
                <div class="form-group">
                    <label>Description:</label><?php echo ' ' .$repas['description'];?>
                </div>
                <div class="form-group">
                    <label>Prix:</label><?php echo ' ' .$repas['price'] . 'FCFA';?>
                </div>
                <div class="form-group">
                    <label>Catégorie:</label><?php echo ' ' .$repas['category_id'];?>
                </div>
                <div class="form-group">
                    <label>Image:</label><?php echo ' ' .$repas['image'];?>
                </div>
            </form>
            <br>
            <div class="form-action">
                <a class="btn btn-primary" href="index_cigusta.php"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="Retourner à la liste des repas"><span class="glyphicon glyphicon-arrow-left"> Retour</span> </a>
            </div>
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