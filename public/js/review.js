window.onload = init;

function init() {
    input = document.getElementById("input");

    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
          event.preventDefault();
          document.getElementById("button").click();
        }
      }); 


    document.getElementById("loading").style.display = "none";
    document.getElementById("loaded").style.display = "";
    data = JSON.parse(JSON.stringify(infoData));
    counter = 0;

    shuffle();

}

function review() {
    let input = document.getElementById("input").value;

    let success = false;
    let words = item["palabrasOrigen"].split(",");
    for (let i = 0; i < words.length && !success; i++) {
        if (words[i].trim().toLowerCase() === input.trim().toLowerCase()) {
            success = true;
        }
    }


    if (success) {

        let isSuccess = !item["fallada"];

        $.ajax({
            method: "POST",
            url: "/ajaxreview",
            dataType: "json",
            data: {
                "data": item["id"],
                "success": isSuccess
            },
            success: function(data)
            {

            },
            error: function(jqXHR, exception)
            {
                
            }
        });

        document.getElementById("input").classList.add("success");
        document.getElementById("button").textContent = "CORRECTO";

        data.splice(data.indexOf(item), 1);
        counter++;
        document.getElementById("currentCounter").textContent = counter;
    }
    else {
        
        $.ajax({
            method: "POST",
            url: "/ajaxreview",
            dataType: "json",
            data: {
                "data": item["id"],
                "fallada": true
            },
            success: function(data)
            {

            },
            error: function(jqXHR, exception)
            {
                
            }
        });

        document.getElementById("input").classList.add("failure");
        document.getElementById("button").textContent = "INCORRECTO";
        data[data.indexOf(item)]["fallada"] = true;
    }
    
    document.getElementById("button").onclick = shuffle;
    document.getElementById("description").textContent = item["descripcion"];
}

function shuffle() {
    if (data.length == 0) {
        window.location.href = '/dashboard';
        document.getElementById("button").disabled = true;
    }
    else {
        item = data[Math.floor(Math.random()*data.length)];
    
        document.getElementById("problem").textContent = item["palabrasObjetivo"];
        document.getElementById("description").textContent = item["descripcion"];
        document.getElementById("button").textContent = "Review";
        document.getElementById("button").onclick = review;
        document.getElementById("input").classList.remove("success");
        document.getElementById("input").classList.remove("failure");
    }

}