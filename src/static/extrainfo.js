function change(e) {
    let oi = document.getElementById("other-info-input");
    let d = document.getElementById("other-info");
    let obj = [];
    for (div of d.getElementsByClassName("other-field")) {
        let k = div.children[0];
        let v = div.children[div.childElementCount - 1];
        if (k.value && v.value) {
            obj.push({ key: k.value, value: v.value });
        }
    }
    oi.value = JSON.stringify(obj);
}

function addfield() {
    let d = document.getElementById("other-info");

    let div = document.createElement("div");
    div.classList.add("other-field");

    let key = document.createElement("input");
    key.setAttribute("type", "text");
    key.setAttribute("placeholder", "Key");
    key.onchange = change;
    div.appendChild(key);

    let value = document.createElement("input");
    value.setAttribute("type", "text");
    value.setAttribute("placeholder", "Value");
    value.onchange = change;
    div.appendChild(value);

    d.appendChild(div);
}

document.addEventListener("DOMContentLoaded", change);