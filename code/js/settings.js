let checkbox = document.getElementById("checkbox");

function checkBox() {
    let xtr = new XMLHttpRequest();
    let res;
    
    xtr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 1) {
                checkbox.checked = true;
            } else if (this.responseText == 0) {
                checkbox.checked = false;
            }
        } else {
            console.log(this.statusText);
        }
    }
    if (this == window) {
        res = "return";
    } else if (checkbox.checked) {
        res = true;
    } else {
        res = false;
    }
    xtr.open("get", "../php/change_notifs.php?status=" + res);
    xtr.send();  
}

checkbox.onclick = checkBox;
window.onload = checkBox;