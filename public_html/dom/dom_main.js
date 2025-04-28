// format des toiles:
// var list_toiles = [];

function affiche_list_toiles(){

    let main_div = document.createElement("div");
    for (let index = 0; index < list_toiles.length; index++) {
        let div = document.createElement("div");
        let link = document.createElement("a");
        const toile = list_toiles[index];
        // valeurs temporaires (TODO:supprimer quand elles serons plus undefined (quand elles serons dans la db))
        toile["hauteur"]=30;
        toile["largeur"]=30;
        link.innerHTML+=toile["name"];
        link.href="toile_edit/toile_edit.php?id="+toile["id"]+"&name="+toile["name"]+"&hauteur="+toile["hauteur"]+"&largeur="+toile["largeur"];
        div.id=toile["id"];
        div.appendChild(link);
        div.innerHTML+=" description: "
        div.innerHTML+=toile["description"];
        main_div.appendChild(div);
    }
    console.log(main_div);
    document.body.appendChild(main_div);
}