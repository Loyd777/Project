<?php
session_start();
require 'Admin/connect.php';
$conn = mysqli_connect("localhost","root","","masterfood");
$db = Database::connect();
$name_Error = $password_Error = "";
    if (isset($_POST['submit']))
    {
         $name = $_POST['nom'];
         $password = $_POST['password'];
         $stm = mysqli_query($conn,"SELECT * FROM restaurant WHERE nom = '$name' AND password = '$password'");
         $result = mysqli_fetch_array($stm);
         if (is_array($result))
         {
             $_SESSION['id'] = $result['id'];
         }
         else
         {
             header("location:  Accueil.php");
         }
         /*
          * for($i = 1; $i < max(id); $i++
          * {
          *   if (($_SESSION["id"] == $i ))
         {
             header("location: Admin/Mimis/index.php");
         }
          }
          * */

         if (($_SESSION["id"] == 1 ))
         {
             header("location: Admin/Mimis/index_mimis.php");
         }
        elseif (($_SESSION["id"] == 2 ))
        {
            header("location: Admin/McBouffe/index_mcbouffe.php");
          }
        elseif (($_SESSION["id"] == 3))
        {
            header("location: Admin/Cigusta/index_cigusta.php");
        }
        elseif (($_SESSION["id"] == 4))
        {
            header("location: Admin/Berliner/index_berliner.php");
        }
        elseif (($_SESSION["id"] == 5))
        {
            header("location: Admin/Cornetto/index_cornetto.php");
        }
        elseif (($_SESSION["id"] ==  6))
        {
            header("location: Admin/King/index_king.php");
        }
        elseif (($_SESSION["id"] == 7))
        {
             header("location: Admin/Domino/index_domino.php");
        }
         else
         {
             echo "<script type='text/javascript'> ";
             echo "alert('Hey!!!')";
             echo "</script>";
         }
  }
    Database::disconnect();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <script src="templates/js/verification.js"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .site{
            font-family: 'Holtwood One SC',sans-serif;
        }
        .text-logo{
            color: #e7480f;
            text-shadow: 2px 2px #ffd301;
            font-size: 50px;
            padding: 40px 0;
            margin-top: 0;
            text-align: center;
        }
        .header{
            z-index: 1;
            background: linear-gradient(70deg,orangered,black,orangered,orangered);
            background-size: 400%;
            width: 100%;
            height: 100vh;
            margin: 0;
            animation: animate 5s ease infinite;
        }
        @keyframes animate {
            0%{
                background-position: 0 50%;
            }
            50%{
                background-position: 50% 100%
            }
            100%{
                background-position: 0 50%
            }
        }
        .btn-success{
            color: rgba(0.5);
            box-shadow: 3px 3px 5px black;
            transform: translate(650px,52px);
        }
        .btn-warning{
            color: rgba(0.5);
            box-shadow: 3px 3px 5px black;
            transform: translate(1180px,600px);
        }
        .carousel{
            z-index: 0.1;
        }
        img{
            max-width: 400px; transform: translate(500px)
        }

        .button
        {
            border: 1px solid #ddd;
            background: darkgreen;
            color: whitesmoke;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            padding: 14px;
            border-radius: 5px;
            transition: 0.3s ease-in 0s;
        }
        .button:hover
        {
            background: limegreen;
            border-color: #ddd;
        }
        .glyphicon-user
        {
            transform: translate(-1px,1px);
            font-size: x-large;
            color: black;
        }
        .fa-lock
        {
            transform: translate(-1px,1px);
            font-size: x-large;
            color: black;
        }
        .error{
            color: #D8000C;
            background-color: #FFBABA;
        }
    </style>
    <title>Loyd_food</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Lien bootstrap.com-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!---->
    <script src=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
          crossorigin="anonymous"/>
    <!--<link rel="stylesheet" href="/assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">-->
</head>
<body>
<div class="header site">

    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Reservé aux Administrateurs">ADMIN
        <?php ?>
    </button>
    <!-- Modal HTML Markup -->
    <div id="myModal" class="modal fade" /*data-backdrop="static"*/>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center" style="color: #e7480f;;
text-shadow: 2px 2px black;font-family: 'Holtwood One SC';">Administrateur</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="" name="myForm" onsubmit="return validateForms() , validateForm()">
                        <span ></span>
                        <div class="form-group">
                            <label class="control-label" style="color: dimgray;
text-shadow: 2px 1px black;font-family: 'Holtwood One SC';">Restaurant</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user" ></span>
                                </div>
                                <input type="text" class="form-control input-lg " placeholder="Nom de votre restaurant" name="nom" id="nom"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Remplir ce champs">
                                <span class="error" id="errorname"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" style="color: dimgray;
text-shadow: 2px 1px black;font-family: 'Holtwood One SC';">Password</label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-lock"></span></div>
                                <input type="password" class="form-control input-lg" placeholder="Votre mot de passe" name="password" id="password"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Remplir ce champs">
                                <span class="error" id="errorpassword"></span>
                            </div>
                        </div>
                        <div class="form-group">
                        <div>
                            <input type="submit" name="submit" class="button" value="Connexion"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Se connecter à la section Admin">
                        </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <h1 class="text-logo"><i class="fas fa-hamburger"></i>Master Food<i class="fas fa-hamburger"></i></h1>
    <div id="#monCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators visually-hidden">
            <button data-bs-target="#monCarousel" data-bs-slide-to="0" class="active"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="1"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="2"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="3"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="4"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="5"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="6"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="7"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="8"></button>
            <button data-bs-target="#monCarousel" data-bs-slide-to="9"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active data-interval=2s">
                <img src="templates/css/image/m1.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Menu Classic</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
            <img src="templates/css/image/b1.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Classic</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/c5.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Chawarma Nuggets</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/p9.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Pizza Américaine</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/k8.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4> Kebab & Chiken</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/s1.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Frites</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/sa1.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>César Poulet Pané</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/bo9.png" alt="..." class="d-block w-100" style="max-width: 320px">
                <div class="carousel-caption">
                    <h4>Jus de Fruit</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/ga1.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Gâteau au Chocolat</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/g9.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Glace Italienne</h4>
                </div>
            </div>

            <div class="carousel-item data-interval=2s">
                <img src="templates/css/image/d1.png" alt="..." class="d-block w-100">
                <div class="carousel-caption">
                    <h4>Fondant au chocolat</h4>
                </div>
            </div>
        </div>
    </div>

    <div><a href="Restau.php" class="btn btn-success"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Clicker pour entrer">Entrer</a></div>


