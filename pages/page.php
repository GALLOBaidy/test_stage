<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Commandez votre Menu MCDO</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <header>
    <section id="bloc">
      <div id="img">
        <a href="../index.php">
          <img id="logo" src="../img/Logo_France_Mcdo.png" alt="logo_Mcdo" />
        </a>
        <span>
          <h1>Bienvenue chez Mc DONALD'S</h1>
        </span>
      </div>
    </section>
  </header>
  <main>
    <form id="form" action="http://localhost/test_stage/php/post.php" method="post">
      <h2>Produits disponibles</h2>
      <p>Veuillez choisir un produit</p>
      <div id="produits" class="menu"></div>
      <h2>Accompagnements disponibles</h2>
      <p>Veuillez choisir un accompagnement</p>
      <div id="accompagnements" class="menu"></div>
      <h2>Boissons disponibles</h2>
      <p>Veuillez choisir une boisson</p>
      <div id="boissons" class="menu"></div>

      <div id="panier">
        <div id="panier-contenu">
          <h3>Panier</h3>
          <ul id="liste-panier" class="scrollable-list"></ul>
          <p>Total : <span id="total">0</span>€</p>
        </div> <button type="submit" id="valider-commande">Valider commande</button>
      </div>
    </form>

    <!-- Modal -->
    <div id="recapModal" class="modal">
      <div class="modal-content"> <span class="close">&times;</span>
        <h2>Récapitulatif de la commande</h2>
        <ul id="recap-list"></ul>
        <p>Total: <span id="recap-total"></span> €</p>
      </div>
    </div>

  </main>

  <footer></footer>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="../scripts/app.js"></script>
</body>

</html>