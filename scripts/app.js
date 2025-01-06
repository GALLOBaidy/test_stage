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

let produits = document.getElementById("produits");
let accompagnements = document.getElementById("accompagnements");
let boissons = document.getElementById("boissons");

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

function showProduit(produit) {
  let produitDiv = document.createElement("div");
  produitDiv.setAttribute("class", "card");
  produitDiv.setAttribute(
    "onclick",
    `ajouterAuPanier('${produit.prod_libelle}', ${produit.prod_prix})`
  );
  produitDiv.innerHTML = `
    <img src="${produit.prod_img}" alt="${produit.prod_libelle}" width="">
     <h4>${produit.prod_libelle}</h4> 
     <p>Prix: ${produit.prod_prix} €</p> 
     <p>Description: ${produit.prod_description}</p>`;
  produits.appendChild(produitDiv);
}

function showAccompa(accompagnement) {
  let accompagnementDiv = document.createElement("div");
  accompagnementDiv.setAttribute("class", "card");
  accompagnementDiv.setAttribute(
    "onclick",
    `ajouterAuPanier('${accompagnement.a_libelle}', ${accompagnement.a_prix})`
  );
  accompagnementDiv.innerHTML = `
    <img src="${accompagnement.a_img}" alt="${accompagnement.a_libelle}" width="100">
    <h4>${accompagnement.a_libelle}</h4>
    <p>Prix: ${accompagnement.a_prix} €</p>`;
  accompagnements.appendChild(accompagnementDiv);
}

function showBsn(boisson) {
  let boissonDiv = document.createElement("div");
  boissonDiv.setAttribute("class", "card");
  boissonDiv.setAttribute(
    "onclick",
    `ajouterAuPanier('${boisson.bsn_libelle}', ${boisson.bsn_prix})`
  );
  boissonDiv.innerHTML = `<img src="${boisson.bsn_img}" class="card-img-center" alt="${boisson.bsn_libelle}" width="100">
    <h4>${boisson.bsn_libelle}</h4>
    <p>Prix: ${boisson.bsn_prix} €</p>`;
  boissons.appendChild(boissonDiv);
}

document.addEventListener("DOMContentLoaded", function () {
  jsonOnLoad();
});

let panier = [];
let total = 0;

function ajouterAuPanier(nom, prix,) {
  panier.push({ nom: nom, prix: prix});
  total += prix;
  afficherPanier();
}

function afficherPanier() {
  const listePanier = document.getElementById("liste-panier");
  listePanier.innerHTML = "";
  panier.forEach((item) => {
    const li = document.createElement("li");
    li.textContent = `${item.nom} - ${item.prix}€ `;
    listePanier.appendChild(li);
  });
  document.getElementById("total").textContent = total;
}

document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    envoyerPanier();
  });

function envoyerPanier() {
  fetch("http://localhost/test_stage/php/post.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ panier: panier, total: total }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Succès:", data);
    })
    .catch((error) => {
      console.error("Erreur:", error);
    });
}
