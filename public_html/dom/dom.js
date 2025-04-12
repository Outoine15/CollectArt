
function affiche_json(json_data){
    console.log(json_data);
    let table = document.createElement("table");
    for (let x in json_data) {
        let td = document.createElement("td");
        for (let y in json_data[x]) {
            let data = json_data[x][y];
            let tr = document.createElement("tr");
            let text = document.createTextNode(data);
            console.log(x);
            console.log(y);
            tr.appendChild(text);
            td.appendChild(tr);
        }
        table.appendChild(td);
    }
    document.body.appendChild(table);
}

load_json();
async function load_json(){
    const request_pos = "../sources/map/testmap.json";
    const request = new Request(request_pos);

    const response = await fetch(request);
    const json_data = await response.json();
    affiche_json(json_data);
}