// ============================
// 1. FONCTIONS PRINCIPALES 
// ============================

// Fonction qui permet d'afficher toutes les toiles
function displayToiles(button) {
    var container = document.getElementById("toiles-container");
    var toilesList = document.createElement("div");
    toilesList.className = "toiles-list";

    // Pré-remplir les éléments sans attendre les données des toiles
    for (let i = 0; i < listToiles.length; i++) {
        let toile = listToiles[i];
        // Crée l'affichage d'une toile
        let toileItem = createDisplayToile(toile, button);

        toilesList.appendChild(toileItem);

        // Charger les données de la toile
        loadToileDataAsync(toile.id, toile.hauteur, toile.largeur);
    }

    container.appendChild(toilesList);
}

// Fonction pour créer une mini toile à partir des données
function createMiniToile(pixelData, hauteur, largeur) {
    var table = document.createElement("table");
    table.className = "mini-toile-table";

    // Ratio pour adapter la taille de la toile
    var cellSize = Math.min(150 / hauteur, 150 / largeur);

    // Si pas de données de pixels, on crée une toile vide
    if (!pixelData || pixelData.length === 0) {
        // Crée une toile vide
        createEmptyToile(table, hauteur, largeur, cellSize);
    } else {
        // Crée une toile non vide
        createFillToile(table, pixelData, cellSize);
    }

    return table;
}

// ============================
// 2. SOUS FONCTIONS
// ============================

// Fonction permettant de créer une toile vide
function createEmptyToile(table, hauteur, largeur, cellSize) {
    for (let i = 0; i < hauteur; i++) {
        let tr = document.createElement("tr");
        tr.style.height = cellSize + "px";

        for (let j = 0; j < largeur; j++) {
            let td = document.createElement("td");

            td.style.backgroundColor = "#ffffff";
            td.style.width = cellSize + "px";
            td.style.height = cellSize + "px";

            tr.appendChild(td);
        }

        table.appendChild(tr);
    }
}

// Fonction permettant de créer une toile à partir de ses données
function createFillToile(table, pixelData, cellSize) {
    for (let i = 0; i < pixelData.length; i++) {
        let tr = document.createElement("tr");
        tr.style.height = cellSize + "px";

        for (let j = 0; j < pixelData[i].length; j++) {
            let td = document.createElement("td");

            td.style.backgroundColor = pixelData[i][j];
            td.style.width = cellSize + "px";
            td.style.height = cellSize + "px";

            tr.appendChild(td);
        }

        table.appendChild(tr);
    }
}

function createDisplayToile(toile, button) {
    /*
    TODO rajouter hauteur et largeur dans BDD et crud
    Par défaut définit les dimensions en 30x30
    */
    if(!toile.hauteur){toile.hauteur = 30;}
    if(!toile.largeur){toile.largeur = 30;}

    var toileItem = document.createElement("div");
    toileItem.className = "toile-item";
    toileItem.id = "toile-" + toile.id;

    // Affichage de la toile 

    var preview = document.createElement("div");
    preview.className = "toile-preview";
    preview.id = "preview-" + toile.id;

    // Vide en attendant les données
    var miniToile = createMiniToile(null, toile.hauteur, toile.largeur);
    preview.appendChild(miniToile);

    // Informations de la toile

    var info = document.createElement("div");
    info.className = "toile-info";

    var name = document.createElement("h3");
    name.className = "toile-name";
    name.innerHTML = toile.name;

    var blocDescription = document.createElement("div");
    blocDescription.className = "toile-description";
    blocDescription.innerHTML = "<strong>Créateur : </strong><em>" + toile.creator_name + "</em>" +
        "<br><br><strong>Description : </strong>" + toile.description;

    var htmlBtn;
    if(button === "modifier") {
        htmlBtn = editButton(toile);
    }else if(button === "supprimer") {
        htmlBtn = deleteButton(toile);
    }else {
        htmlBtn = detailsButton(toile);
    }

    info.appendChild(name);
    info.appendChild(blocDescription);
    info.appendChild(htmlBtn);

    toileItem.appendChild(preview);
    toileItem.appendChild(info);

    return toileItem;
}

// ============================ 
// 3. FONCTIONS UTILITAIRES
// ============================

// Fonction pour charger les données JSON d'une toile
function loadToileData(id) {
    // let toileData = [];
    // for (const i in listToiles) {
    //     const toile = listToiles[i];
    //     if(toile["id"]==id){
    //         toileData=toile["0"];
    //     }
    // }
    // console.log(toileData);
    // return toileData;

    // just ça ca marche: (DO NOT TOUCH IT)
    return fetch("../toilesJSON/" + id + ".json").then(jsonToData);
}

// Convertit le contenu en json
function jsonToData(rep) {
    return rep.json();
}

// Supprime tous les enfants d'un élément
function deleteChilds(div) {
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
}

// Chargement asynchrone des données des toiles
function loadToileDataAsync(id, hauteur, largeur) {
    loadToileData(id).then(pixelData => {
        //le problème c'est que si c'est pas dans un fetch ça casse tout:
        // Mise à jour de mini toile
        var previewElement = document.getElementById("preview-" + id);
        
        if (previewElement) {
            // Supprimer old mini toile
            deleteChilds(previewElement);
        
            // Ajouter mini toile mise à jour
            var miniToile = createMiniToile(pixelData, hauteur, largeur);
            previewElement.appendChild(miniToile);
        }
    });
}

function detailsButton(toile) {
    var btn = document.createElement("a");
    btn.href = "../pages/toile_details.php?action=toile&id=" + toile["id"];
    btn.className = "toile-details-btn";
    btn.innerHTML = "Voir détails";

    return btn;
}

function editButton(toile) {
    var btn = document.createElement("a");
    btn.href = "../toile_edit/toile_edit.php?action=toile&id=" + toile["id"];
    btn.className = "toile-edit-btn";
    btn.innerHTML = "Modifier";

    return btn;
}

function deleteButton(toile) {
    var btn = document.createElement("a");
    btn.href = "../dom/json.delete.php?id=" + toile["id"];
    btn.className = "toile-delete-btn";
    btn.innerHTML = "Supprimer";

    return btn;
}