// format toile_status:
// var toile_status = {
//     'nom': '$nom',
//     'toile_id': $id,
//     'hauteur': $hauteur,
//     'largeur': $largeur,
//     'color' : '#000000',
//     'pixelData' : [],
//     'loadData' : [],
//     isDrawing : false
//     };


// ============================
// 1. FONCTIONS PRINCIPALES 
// ============================

// 
// Fonction appelée au chargement de la page
function make_toile(use=""){
    // Création de la toile

    toile = create_toile(use);

    if(use != "create"){
        var container = document.querySelector("#container");
        container.appendChild(toile);

        if(use != "Voir détails"){
            // Gestionnaire des événements
            setupEventListeners();
        }
    }
}

// Création de la toile
function create_toile(use){
    var toile = document.createElement("div");
    toile.className = "toile";

    // Création de la zone de dessin
    var pixel_toile = create_pixel_toile(toile_status["hauteur"],toile_status["largeur"]);
    toile.appendChild(pixel_toile);

    if(use != "Voir détails") {
        var palette = create_palette();
        toile.appendChild(palette);
    }

    return toile;
}

// Crée les informations de la toile
function createToileInformations(){
    var container = document.querySelector("#container");

    var infosContainer = createInfosContainer();

    container.appendChild(infosContainer);
}

function createUserInformations(){
    var container = document.querySelector("#container");

    for (const i in listUsers) {
        user = listUsers[i];
        var infosContainer = createUserInfosContainer(user);
    }

    container.appendChild(infosContainer);
}


// ============================
// 2. SOUS FONCTIONS
// ============================

// Création de la zone de dessin
function create_pixel_toile(hauteur,largeur){
    var pixel_toile = document.createElement("div");
    pixel_toile.className = "pixel_toile";

    var table = document.createElement("table");
    table.className = "table_pixel";

    for(let i = 0; i < hauteur; i++){
        let tr = document.createElement("tr");

        for(let j = 0; j < largeur; j++){
            let td = document.createElement("td");
            td.className = i;
            td.id = j;
            
            tr.appendChild(td);

            // Rajoute la couleur blanche à la case i, j
            fill_pixel_data(i, j, "#ffffff");
        }

        table.appendChild(tr);
    }

    pixel_toile.appendChild(table);
    return pixel_toile;
}

// Mise à jour de la zone de dessin
function update_zone_dessin(){
    var table = document.querySelector(".table_pixel");
    
    // Supprime le contenu de la table (tous les tr/td)
    delete_childs(table);


    // Remplit à nouveau le contenu de la table (remet les tr/td)
    refill_zone_dessin(table);
}  

// Création de la palette de couleurs
function create_palette(){
    var palette = document.createElement("div");
    palette.className = "palette";

    var colors = create_palette_colors();
    var buttons = create_palette_buttons();

    palette.appendChild(colors);
    palette.appendChild(buttons);
    return palette;
} 

// Création de la sélection de couleurs dans la palette
function create_palette_colors(){
    var colors = document.createElement("div");
    colors.className = "colors_container";
    
    // Insertion d'un input -> type: color
    insert_color_input(colors);

    var default_color = create_default_color();
    colors.appendChild(default_color);

    return colors;
}

// Création de la zone regroupant un choix de couleurs par défaut
function create_default_color(){
    var default_color = document.createElement("div");
    default_color.className = "default_color";

    // Appel de la fonction utilitaire renvoyant une liste de couleurs
    var liste_default_colors = get_default_colors();

    // Création des div couleurs par défaut
    for(let i in liste_default_colors){
        let color = liste_default_colors[i];

        let div_color = document.createElement("div");
        div_color.style.backgroundColor = color;
        div_color.className = "select_color";
        div_color.id = color;
        
        // Marque une couleur comme étant active
        if(toile_status["color"] === color){
            div_color.className = "select_color_active";
        }

        default_color.appendChild(div_color);
    }

    return default_color;
}

function create_palette_buttons(){
    var div = document.createElement("div");
    div.className = "container_palette_buttons";

    // Récupère le bouton de réinitialisation de la zone de dessin
    var reset_button = get_reset_toile_button();

    // Récupère le bouton de sauvegarde de la zone de dessin
    var save_button = get_save_toile_button();

    div.appendChild(reset_button);
    div.appendChild(save_button);

    return div;
}

function setupEventListeners(){
    var table_pixel = document.querySelector(".table_pixel");

    table_pixel.addEventListener("click", click_dessin);
    table_pixel.addEventListener("mouseover", maintien_click_dessin);

    // Mise à jour de isDrawing en fonction de la souris
    document.addEventListener("mousedown", ()=>{
        toile_status["isDrawing"] = true;
    });

    document.addEventListener("mouseup", ()=>{
        toile_status["isDrawing"] = false;
    });

    document.addEventListener("mouseleave", ()=>{
        toile_status["isDrawing"] = false;
    });

    // Changements de couleur
    document.querySelector(".color_input").addEventListener("change", (e)=>{
        toile_status["color"] = e.target.value;
        update_palette();
    });

    var select_color = document.querySelectorAll(".select_color");

    for(let elt of select_color){
        elt.addEventListener("click", change_color);
    }
    document.querySelector(".select_color_active").addEventListener("click", change_color);

    // Réinitialiser le dessin
    document.querySelector("#button_reset_toile").addEventListener("click", reset_dessin);

    // Sauvegarder le dessin
    document.querySelector("#button_save_toile").addEventListener("click", send_json_data_for_save);
    
}

function createUserInfosContainer(user){
    var infosContainer = document.createElement("div");
    infosContainer.id = "infos-container";

    var name = user["name"];
    var id = user["id"];

    var h1 = document.createElement("h1");
    h1.innerHTML = name;
    infosContainer.appendChild(h1);

    var divInfos = document.createElement("div");
    divInfos.className = "infos-div";
    divInfos.innerHTML = id;
    
    var deleteBtn = document.createElement("a");
    deleteBtn.href = "../dom/json.delete.php?action=from_admin&id="+id;
    deleteBtn.className = "";
    deleteBtn.innerHTML = "Supprimer";
    
    infosContainer.appendChild(divInfos);
    infosContainer.appendChild(deleteBtn);
    
    return infosContainer;

}


// Crée le conteneur des informations de la toile
function createInfosContainer(){
    var infosContainer = document.createElement("div");
    infosContainer.id = "infos-container";

    var name = toile_informations["name"];
    var creator = toile_informations["creator"];
    var hauteur = toile_informations["hauteur"];
    var largeur = toile_informations["largeur"];
    var description = toile_informations["description"];
    var participants = toile_informations["participants"];

    // Titre de la toile
    var h1 = document.createElement("h1");
    h1.innerHTML = name;
    infosContainer.appendChild(h1);

    var divInfos = document.createElement("div");
    divInfos.className = "infos-div";

    // Créateur de la toile
    var pCreator = document.createElement("p");
    pCreator.innerHTML = "<strong>Créateur :</strong> " + creator;

    // Dimensions de la toile
    var pDimensions = document.createElement("p");
    pDimensions.innerHTML = "<strong>Dimensions : </strong>" + hauteur + " x " + largeur;

    divInfos.appendChild(pCreator);
    divInfos.appendChild(pDimensions);

    infosContainer.appendChild(divInfos);

    // Description
    var divDesc = document.createElement("div");
    divDesc.className = "infos-desc";

    var descTitle = document.createElement("h3");
    descTitle.innerHTML = "Description";

    var desc = document.createElement("p");
    desc.innerHTML = description;

    divDesc.appendChild(descTitle);
    divDesc.appendChild(desc);
    
    infosContainer.appendChild(divDesc);

    // Participants
    var divParticipants = document.createElement("div");
    divParticipants.id = "div-participants";

    var participantsTitle = document.createElement("h2");
    participantsTitle.innerHTML = "Participants";

    divParticipants.appendChild(participantsTitle);

    var participantsList = document.createElement("div");
    participantsList.className = "participants-list";

    if(participants.length > 0){
        for(let i in participants){
            let user = participants[i];
            let username = user["name"];
            
            let p = document.createElement("p");
            p.innerHTML = username;
            p.className = "participant-p";
    
            participantsList.appendChild(p);
        }
    }else {
        let noParticipants = document.createElement("p");
        noParticipants.className = "noparticipants";
        noParticipants.innerHTML = "Il n'y a pas de participants supplémentaire à cette toile";

        participantsList.appendChild(noParticipants);
    }

    divParticipants.appendChild(participantsList);
    infosContainer.appendChild(divParticipants);

    return infosContainer;
}

// ============================ 
// 3. FONCTIONS UTILITAIRES
// ============================

// Rajoute une couleur dans le tableau pixelData de const toileStatus
function fill_pixel_data(i, j, color){
    var pixel_data = toile_status["pixelData"];

    // On crée la ligne si elle n'existe pas
    if(!pixel_data[i]){
        pixel_data[i] = [];
    }

    // Rajoute la couleur à la case i, j
    pixel_data[i][j] = color;
    
}

// Insert un input color dans un élément passé en paramètre
function insert_color_input(elt){
    var p = document.createElement("p");
    p.innerHTML = "Couleur :";

    var input = document.createElement("input");
    input.type = "color";
    input.className = "color_input";
    input.value = toile_status["color"];

    elt.appendChild(p);
    elt.appendChild(input);
}

// Renvoie une liste de couleurs
function get_default_colors(){
    return [
        "#ff0000", // Rouge
        "#0000ff", // Bleu
        "#00ff00", // Vert
        "#ffa500", // Orange
        "#ffff00", // Jaune
        "#ff69b4", // Rose
        "#8a2be2", // Violet
        "#808080", // Gris
        "#ffffff", // Blanc
        "#000000" // Noir
    ]
}

// Renvoie le bouton de réinitialisation de la zone de dessin
function get_reset_toile_button(){
    var button = document.createElement("button");
    button.className = "palette_button";
    button.id = "button_reset_toile";
    button.innerHTML = "Réinitialiser";

    return button;
}

// Renvoie le bouton de sauvegarde de la zone de dessin
function get_save_toile_button(){
    var button = document.createElement("button");
    button.className = "palette_button";
    button.id = "button_save_toile";
    button.innerHTML = "Sauvegarder";

    return button;
}

// Modification d'un pixel sur le dessin à partir d'un click
function click_dessin(e){
    var target = e.target;
    
    // On vérifie qu'on a bien cliqué sur un élément 'TD'
    if(target.nodeName === "TD"){
        var i = parseInt(target.className);
        var j = parseInt(target.id);

        target.style.backgroundColor = toile_status["color"];
        toile_status["pixelData"][i][j] = toile_status["color"];
    }
}

// Modification d'un pixel sur le dessin en maintenant le click
function maintien_click_dessin(e){
    var target = e.target;

    // On vérifie qu'on a bien cliqué sur un élément 'TD' et qu'on est en mode dessin
    if(toile_status["isDrawing"] && target.nodeName === "TD"){
        var i = parseInt(target.className);
        var j = parseInt(target.id);

        target.style.backgroundColor = toile_status["color"];
        toile_status["pixelData"][i][j] = toile_status["color"];
    }
}

// Met à jour l'affichage de la palette
function update_palette(){
    var old_active = document.querySelector(".select_color_active");

    // On vérifie que old_active existe
    if(old_active){
        old_active.className = "select_color";
    }

    // On vérifie si la couleur correspond à celle d'une couleur par défaut sur la palette
    var color = toile_status["color"];
    var select_color = document.querySelectorAll(".select_color");

    for(let elt of select_color){
        if(elt.id === color){
            elt.className = "select_color_active";
        }
    }

}

// Modifie la couleur
function change_color(e){
    toile_status["color"] = e.target.id;
    update_palette();
    document.querySelector(".color_input").value = toile_status["color"];
}

// Réinitialise le dessin
function reset_dessin(){
    let tds = document.querySelectorAll(".table_pixel td");
    const hauteur = toile_status["hauteur"];
    const largeur = toile_status["largeur"];
    
    // Remet les cases en blanches
    for(let td of tds){
        td.style.backgroundColor = "#ffffff";
    }

    // Réinitialise pixelData de toile_status
    for(let i = 0; i < hauteur; i++){
        for(let j = 0; j < largeur; j++){
            fill_pixel_data(i, j, "#ffffff")
        }
    }
}

// Supprime tous les enfants d'un élément
function delete_childs(div){
    while(div.firstChild){
        div.removeChild(div.firstChild);
    }
}

// Remet les tr et td dans la table
function refill_zone_dessin(table){
    for(let i = 0; i < toile_status["hauteur"]; i++){
        let tr = document.createElement("tr");

        for(let j = 0; j < toile_status["largeur"]; j++){
            let td = document.createElement("td");
            td.className = i;
            td.id = j;

            pixel_data = toile_status["pixelData"];
            // Rajoute la couleur blanche à la case i, j
            fill_pixel_data(i, j, pixel_data[i][j]);
            
            // Mise à jour de la couleur de la case
            td.style.backgroundColor = pixel_data[i][j];

            tr.appendChild(td);
        }

        table.appendChild(tr);
    }
}

function affiche_json(json_data){
    console.log(json_data);
    // let table = document.createElement("table");
    for (let x in json_data) {
        // let td = document.createElement("td");
        for (let y in json_data[x]) {
            let data = json_data[x][y];
            // let tr = document.createElement("tr");
            // let text = document.createTextNode(data);
            if(toile_status.pixelData[x][y]!=[]){
                toile_status.pixelData[x][y]=data;
            }
            console.log(x);
            console.log(y);
            // tr.appendChild(text);
            // td.appendChild(tr);
        }
        // table.appendChild(td);
    }
    // document.body.appendChild(table);
}

// load_json();
function load_json_data(){
    // fetch("json_name.php?id="+id)
        // .then(fetch("../toilesJSON/"+id+".json")
            // .then(json_to_data)
            // .then(edit_toile_json)
            // .then(update_zone_dessin));
    toile_status["pixelData"]=toile_status["loadData"];
    edit_toile_json(toile_status["pixelData"]);
    update_zone_dessin();
    }

// envoie le json à php pour sauvegarde:
function send_json_data_for_save(){

    let xhr = new XMLHttpRequest();
    let url = "../dom/json.save.php";

    xhr.open("POST", url);

    // // Set the request header i.e. which type of content you are sending
    xhr.setRequestHeader("Content-Type", "application/json");

    // // Converting JSON data to string
    var data = JSON.stringify(toile_status["pixelData"]);
    id=toile_status["toile_id"];
    data="["+data+[","+id+"]"];
    console.log(data);

    // // Sending data with the request
    xhr.send(data);

    // fait tout cassé dans un sense ou dans l'autre:
    // window.setTimeout(window.location = "../pages/mes_toiles.php",5000);
}

// Convertit le contenu en json
function json_to_data(rep){
	return rep.json();
}

function edit_toile_json(json_data){
    for (let hauteur = 0; hauteur < json_data.length; hauteur++) {
        const ligne = json_data[hauteur];
        for (let largeur = 0; largeur < ligne.length; largeur++) {
            let pixel_data = json_data[hauteur][largeur];
            fill_pixel_data(hauteur,largeur,pixel_data);
        }       
    }
}
