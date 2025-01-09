let produits = document.getElementById("produits");
let accompagnements = document.getElementById("accompagnements");
let boissons = document.getElementById("boissons");
let form = document.getElementById("form");

let produit = document.getElementById("produitSelectionne");
let accompagnement = document.getElementById("accompagnementSelectionne");
let boisson = document.getElementById("boissonSelectionne");

function jsonOnLoad() {
  fetch(
    "http://localhost/test_stage/php/api.php"
    // {
    //   method: 'GET', // ou 'POST', 'PUT', etc.
    //   headers: {
    //     'Content-Type': 'application/json',
    //     'Access-Control-Allow-Origin': '*',
    //     'Access-Control-Allow-Credentials': 'true',
    //     'Access-Control-Allow-Headers': 'Content-Type, Authorization',
    //     'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE',
    //     'Access-Control-Expose-Headers': 'Content-Length, X-JSON',
    //     'Access-Control-Request-Headers': 'Content-Type', 'Access-Control-Request-Method': 'GET'
    //   },
    //   credentials: 'include' // inclure les cookies si nécessaire)
    // }
  )
    .then((response) => {
      console.log(response);
      return response.json();
    })
    .then((data) => {
      console.log(data);
      // Boucle pour afficher tous les produits
      data.produits.forEach((produit) => showProduit(produit));
      // Boucle pour afficher tous les accompagnements
      data.accompagnements.forEach((accompagnement) =>
        showAccompa(accompagnement)
      );
      // Boucle pour afficher toutes les boissons
      data.boissons.forEach((boisson) => showBsn(boisson));
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

//Fonction qui va afficher mes produits
function showProduit(produit) {
  let produitDiv = document.createElement("div");
  produitDiv.setAttribute("class", "card");
  produitDiv.innerHTML = ` <img src="${produit.prod_img}" alt="${produit.prod_libelle}" width="">
  <h4 id="produitSelectionne">${produit.prod_libelle}</h4>
  <p>Prix: ${produit.prod_prix} €</p>
  <p>Description: ${produit.prod_description}</p>
  <div class="labelInline"><label for="quantite_${produit.prod_id}">Quantité Produit:</label>
  <input type="number" id="quantite_${produit.prod_id}" name="quantite_produit" min="1" value="1"> </div>
  <button class="btnAjout" onclick="ajouterAuPanier('${produit.prod_libelle}', ${produit.prod_prix},
    document.getElementById('quantite_${produit.prod_id}').value)">Ajouter au panier</button>`;
  produits.appendChild(produitDiv);
}

//Fonction qui va afficher mes accompagnements
function showAccompa(accompagnement) {
  let accompagnementDiv = document.createElement("div");
  accompagnementDiv.setAttribute("class", "card");
  accompagnementDiv.innerHTML = ` <img src="${accompagnement.a_img}" alt="${accompagnement.a_libelle}" width=""> 
  <h4 id="accompagnementSelectionne">${accompagnement.a_libelle}</h4> 
  <p>Prix: ${accompagnement.a_prix} €</p> 
  <p>Description: ${accompagnement.a_description}</p> 
  <div class="labelInline"><label for="quantite_${accompagnement.a_id}">Quantité Accompagnement:</label> 
  <input type="number" id="quantite_${accompagnement.a_id}" name="quantite_accompagnement" min="1" value="1"> </div> 
  <button class="btnAjout" onclick="ajouterAuPanier('${accompagnement.a_libelle}', ${accompagnement.a_prix}, 
    document.getElementById('quantite_${accompagnement.a_id}').value)">Ajouter au panier</button>`;
  document.getElementById("accompagnements").appendChild(accompagnementDiv);
}

//Fonction qui va afficher mes boissons
function showBsn(boisson) {
  let boissonDiv = document.createElement("div");
  boissonDiv.setAttribute("class", "card");
  boissonDiv.innerHTML = ` <img src="${boisson.bsn_img}" alt="${boisson.bsn_libelle}" width=""> 
  <h4 id="boissonSelectionne">${boisson.bsn_libelle}</h4> 
  <p>Prix: ${boisson.bsn_prix} €</p> 
  <p>Description: ${boisson.bsn_description}</p> 
  <div class="labelInline"><label for="quantite_${boisson.bsn_id}">Quantité Boisson:</label> 
  <input type="number" id="quantite_${boisson.bsn_id}" name="quantite_boisson" min="1" value="1"> </div> 
  <button class="btnAjout" onclick="ajouterAuPanier('${boisson.bsn_libelle}', ${boisson.bsn_prix}, 
    document.getElementById('quantite_${boisson.bsn_id}').value)">Ajouter au panier</button>`;
  document.getElementById("boissons").appendChild(boissonDiv);
}

//Evénements qui affiche au chargement de la page
document.addEventListener("DOMContentLoaded", function () {
  jsonOnLoad();
});

let panier = [];
let total = 0;

//Fonctions qui va ajouter les produits, accompagnemants et boissons dans un panier
function ajouterAuPanier(nom, prix, quantite) {
  quantite = parseInt(quantite);
  panier.push({ nom: nom, prix: prix, quantite: quantite });
  total += prix * quantite;
  afficherPanier();
}

//Fonction qui va afficher mon panier
function afficherPanier() {
  const listePanier = document.getElementById("liste-panier");
  listePanier.innerHTML = "";
  panier.forEach((item) => {
    const li = document.createElement("li");
    li.textContent = `${item.quantite} - ${item.nom} - ${item.prix}€ l'unité `;
    listePanier.appendChild(li);
  });
  document.getElementById("total").textContent = total;

  // Fais défiler la liste pour afficher le dernier élément ajouté
  if (listePanier.lastElementChild) {
    listePanier.lastElementChild.scrollIntoView({ behavior: "smooth" });
  }
}

//Evénement qui va envoyer le panier
form.addEventListener("submit", function (event) {
  event.preventDefault();
  envoyerPanier();
});

//Fonction qui va envoyer le panier
function envoyerPanier() {
  let quantite_produit = Array.from(
    document.querySelectorAll("[id^='quantite_']")
  )
    .filter((input) => input.name === "quantite_produit")
    .map((input) => input.value);

  let quantite_accompagnement = Array.from(
    document.querySelectorAll("[id^='quantite_']")
  )
    .filter((input) => input.name === "quantite_accompagnement")
    .map((input) => input.value);

  let quantite_boisson = Array.from(
    document.querySelectorAll("[id^='quantite_']")
  )
    .filter((input) => input.name === "quantite_boisson")
    .map((input) => input.value);

  fetch("http://localhost/test_stage/php/post.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      produit: produit,
      quantite_produit: quantite_produit,
      accompagnement: accompagnement,
      quantite_accompagnement: quantite_accompagnement,
      boisson: boisson,
      quantite_boisson: quantite_boisson,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Succès:", data);
      afficherRecap(data)
    })
    .catch((error) => {
      console.error("Erreur:", error);
    });
}

//Fonction qui va afficher une modal
function afficherRecap(data) {
  // Affichage du récapitulatif dans la modal
  const recapList = document.getElementById("recap-list");
  recapList.innerHTML = "";
  data.panier.forEach((item) => {
    const li = document.createElement("li");
    li.textContent = `${item.quantite} - ${item.nom} - ${item.prix}€ l'unité `;
    recapList.appendChild(li);
  });
  document.getElementById("recap-total").textContent = data.total;
  // Affichage de la modal
  const modal = document.getElementById("recapModal");
  modal.style.display = "block";
  // Fermeture de la modal
  const span = document.getElementsByClassName("close")[0];
  span.onclick = function () {
    modal.style.display = "none";
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}

// let produit = document.getElementById("produits");
// function jsonOnLoad() {
//   fetch("./php/api.php")
//     .then((response) => {
//       return response.json();
//     })
//     .then((data) => {
//       console.log(data);
//       showProduit(data);
//     })
//     .catch((error) => {
//       console.error("Error:", error);
//     });
// }

// document.addEventListener("DOMContentLoaded", function () {
//   jsonOnLoad();
// });
// function show(mcdo) {
//     //let produitsDiv = document.getElementById('produits');
//         mcdo.forEach(produitData => {
//             let produitDiv = document.createElement('div');
//             produitDiv.innerHTML = `<h2>${produitData.prod_libelle}</h2>
//             <p>Prix: ${produitData.prod_prix} €</p>
//             <p>Description: ${produitData.prod_description}</p>
//             <img src="${produitData.prod_img}" alt="${produitData.prod_libelle}" width="100">`;
//             produit.appendChild(produitDiv);
//         });
// }

// let produits = document.getElementById("produits");
// let accompagnements = document.getElementById("accompagnements");
// let boissons = document.getElementById("boissons");

// document.addEventListener("DOMContentLoaded", function jsonOnLoad() {
//   console.log("Fetching data...");
//   fetch("../php/api.php")
//   .then((response) => {
//     if (!response.ok) {
//       throw new Error("Network response was not ok " + response.statusText);
//     }
//       return response.json();
//     })
//     .then((data) => {
//       console.log("Data received:", data);
//       showProd(data);
//     })
//     .catch((error) => {
//       console.error("Error:", error);
//     });
// });

// function showProd(produit) {
//   produit.forEach((produitData) => {
//     let produitDiv = document.createElement("div");
//     produitDiv.setAttribute("class", "card");
//     produitDiv.innerHTML = `
//     <img src="${produitData.prod_img}" alt="${produitData.prod_libelle}" width="100">
//     <h4>${produitData.prod_libelle}</h4>
//     <p>Prix: ${produitData.prod_prix} €</p>
//     <p>Description: ${produitData.prod_description}</p>
//     `;
//     produits.appendChild(produitDiv);
//   });
// }

// function showProduit(produit) {
//   let produitDiv = document.createElement("div");
//   produitDiv.setAttribute("class", "card");
//   produitDiv.innerHTML = `
//     <img src="${produit.prod_img}" alt="${produit.prod_libelle}" width="100">
//      <h4>${produit.prod_libelle}</h4>
//      <p>Prix: ${produits.prod_prix} €</p>
//      <p>Description: ${produit.prod_description}</p>`;
//   produits.appendChild(produitDiv);
// }

// showProduit();

// function showAccompa(accompagnement) {
//   accompagnement.forEach((accompagnementData) => {
//     let accompagnementDiv = document.createElement("div");
//     accompagnementDiv.setAttribute("class", "card");
//     accompagnementDiv.innerHTML = `
//     <img src="${accompagnementData.a_img}" alt="${accompagnementData.a_libelle}" width="100">
//     <h4>${accompagnementData.a_libelle}</h4>
//     <p>Prix: ${accompagnementData.a_prix} €</p>`;
//     accompagnements.appendChild(accompagnementDiv);
//   });
// }

// showAccompa();

// function showBsn(boisson) {
//   boisson.forEach((boissonData) => {
//     let boissonDiv = document.createElement("div");
//     boissonDiv.setAttribute("class", "card");
//     boissonDiv.innerHTML = `<img src="${boissonData.bsn_img}" alt="${boissonData.bsn_libelle}" width="100">
//     <h4>${boissonData.bsn_libelle}</h4>
//     <p>Prix: ${boissonData.bsn_prix} €</p>`;
//     boissons.appendChild(boissonDiv);
//   });
// }

// showBsn();

// function showProduit(produit) {
//   let produitDiv = document.createElement("div");
//   produitDiv.setAttribute("class", "card");
//   produitDiv.setAttribute(
//     "onclick",
//     `ajouterAuPanier('${produit.prod_libelle}', ${produit.prod_prix})`
//   );
//   produitDiv.innerHTML = `
//     <img src="${produit.prod_img}" alt="${produit.prod_libelle}" width="">
//      <h4>${produit.prod_libelle}</h4>
//      <p>Prix: ${produit.prod_prix} €</p>
//      <p>Description: ${produit.prod_description}</p>
//      <label for="quantite_produit">Quantité Produit:</label>
//      <input type="number" id="quantite_produit" name="quantite_produit">`;
//   produits.appendChild(produitDiv);
// }
