<?php
include "header.php";

       echo' <p style=" transform: translate(480px);">
            <button class="btn btn-outline-light btn-lg collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse"
            data-bs-toggle="tooltip" data-bs-placement="top" title="En savoir plus">
                        A Propos
                <i class="glyphicon glyphicon-exclamation-sign"></i>
            </button>
        </p>
        <div style="min-height: 100px; transform: translate(300px)">
            <div class="collapse-horizontal collapse" id="collapse" style="color: whitesmoke">
                <div class="card card-body" style="width: 500px; background: black">
                    Cette plateforme vous permet de passer des commandes dans les restaurants présentés ci desous.
                    Entrer dans le restaurant de votre choix et commander le repas qui vous interesse en passant
                    un appel via le bouton commander.
                    Mise à jours à venir dans la prochaine version.
                </div>
            </div>
        </div>
<br><br><br>';
$db = Database::connect();
$statement = $db->prepare('SELECT * FROM restaurant');
$statement->execute(array());

while($restau = $statement->fetch())
{
    echo    '<div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="templates/css/image/restau/'. $restau['img'] . '" alt="...">
                    <div class="caption">
                        <h4> '.$restau['nom'].' </h4>
                       <a href="#" class="btn btn-order role=button" type="button" 
                       data-bs-toggle="tooltip" data-bs-placement="top" title="Clicker pour entrer à '.$restau['nom'].'">
                    <span class="glyphicon glyphicon-log-in"></span> Entrer</a>
                    </div>
                </div>
            </div>';
}
Database::disconnect();
include "templates/footer.php";
?>