<?php 
	$db = new PDO('mysql:host=database;
        dbname=stockage_formulaire_restaurant;charset=utf8',
         'root',
         'root');

$getData = $_GET;

    if(!isset($getData['user_id']) && is_numeric($getData['user_id'])){
        echo("Il faut un identifiant de recette afin d'utiliser la fonction éditer !");
        return;
    };

    $donnéesFormulaire = $db-> prepare('SELECT * FROM users WHERE user_id=:user_id');
    $donnéesFormulaire -> execute([
        'user_id' => $getData['user_id'],
    ]);

    $donnéesFetch = $donnéesFormulaire ->fetch(PDO::FETCH_ASSOC);
?>


<!-- ------------------- HTML / BOOTSTRAP ----------------------------->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Contact</title>
  </head>
  <body class="bg-dark">
    
    <!--Navbar-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top opacity-75">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="#" class="Gerbotron"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg></a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.html">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.html">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pictures.html">Photos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="locations.html">Localisations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<!--Formulaire-->

<div class="container">
  <div class="row mt-5"></div>
  <h1 class="mt-5 text-light">Nous contacter</h1>
<form class="formulaire bg-light border" action="postUpdate.php" method="POST">
    <div class="mb-3 visually-hidden">Il manque des informations pour permettre des modifications.
        <label for="id" class="form-label">Identifiant de ligne de formulaire</label>
        <input type="text" class="form-control" id="id" name="user_id" value="<?php echo $donnéesFetch['user_id']; ?>">
    </div>
  <div class="mb-3">
    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" name="firstname" value="<?php echo $donnéesFetch['firstname']; ?>" class="form-control" id="firstName" aria-describedby="firstName" placeholder="Entrez votre prénom" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputLastName" class="form-label">Nom</label>
    <input type="text" name="lastname" value="<?php echo $donnéesFetch['lastname']; ?>" class="form-control" id="lastName" aria-describedby="lastName" placeholder="Entrez votre nom de famille" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" value="<?php echo $donnéesFetch['email']; ?>" class="form-control" id="email" aria-describedby="email" placeholder="Entrez votre adresse mail" required>
    <div id="email" class="form-text">Nous ne partagerons jamais votre adresse mail.</div>
  </div>
  <div class="mb-3">
    <label for="Select" class="form-label">Objet du message</label>
    <select id="Select" class="form-select">
      <option>Informations</option>
      <option>Réservation</option>
      <option>Suggestion(s)</option>
    </select>
    <div class="input-group">
      <textarea name="texte" class="form-control" aria-label="With textarea"><?php echo $donnéesFetch['message'];?></textarea>
    </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="isChecked" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">J'accepte les risques</label>
  </div>
  <button type="submit" class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
  </svg>Envoyer</button>
</form>
</div>
<div class="row mb-5"></div>

<!--Footer-->

<footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

    </section>
    <!-- Section: Social media -->
  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="https://clement-leger.github.io/restaurant-css-framework/index.html">Gerbotron</a>
  </div>
  <!-- Copyright -->
</footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
