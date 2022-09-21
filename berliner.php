<title>Berliner Kebab</title>
<?php
include "header.php";

echo '<nav>
               <ul class="nav nav-pills">';
$db = Database::connect();
$statement = $db->query('SELECT * FROM menu WHERE id in (2,3,5,6,8) ');
$menu = $statement->fetchAll();
foreach($menu as $category){
    if ($category['id'] == '5')
        echo ' <li role="presentation" class="active"><a href="#' . $category['id'] . '" data-toggle="tab">' .$category['nom']. '</a></li>';
    else
        echo ' <li role="presentation"><a href="#' . $category['id'] . '" data-toggle="tab">' .$category['nom']. '</a></li>';
}
echo '</ul>
    </nav>';

echo'<div class="tab-content">';

foreach ($menu as $category){
    if ($category['id'] == '5')
        echo '<div class="tab-pane active" id="' .$category['id']. '">';
    else
        echo '<div class="tab-pane" id="' .$category['id']. '">';
    echo '<div class="row">';
    $statement = $db->prepare('SELECT * FROM repas WHERE `category_id`= ? AND `restau_id`= 4;');
    $statement->execute(array($category['id']));

    while($repas = $statement->fetch())
    {
        echo    '<div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="templates/css/image/'. $repas['image'] .'" alt="...">
                    <div class="price">' .$repas['price'] . 'FCFA</div>
                    <div class="caption">
                        <h4> '.$repas['nom'].' </h4>
                        <p>'.$repas['description'].'</p>
                        <a href="tel:" class="btn btn-order role=button" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Clicker pour appeller">
                                <span class="glyphicon glyphicon-phone"></span> Commander</a>
                    </div>
                </div>
            </div>';
    }
    echo '</div>
                </div>';
}

Database::disconnect();
echo '</div>';
?>
<?php
include "templates/footer.php";
?>
