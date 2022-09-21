<?php
include "../headers.php";

if (!empty($_GET['id']))
{
    $id = $_GET['id'];
}

if (!empty($_POST['id']))
{
    $id = $_POST['id'];
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM repas WHERE id= ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index_mcbouffe.php");
}
?>



    <div class="row">
        <h1><strong>Supprimer un item <span class="glyphicon glyphicon-ban-circle"></span></strong></h1>
        <br>
        <form class="form" role="form" action="delete_mcbouffe.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert-warning">Etes vous sûr de vouloir supprimer <span class="glyphicon glyphicon-ban-circle"></span></p>

            <div class="form-action">
                <button type="submit" class="btn btn-warning"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Cette action est irréverssible">Oui</button>
                <a class="btn btn-default" href="index_mcbouffe.php"
               data-bs-toggle="tooltip" data-bs-placement="top" title="Retourner à la liste des repas">Non</a>
            </div>
        </form>
    </div>