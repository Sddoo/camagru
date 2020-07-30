function includeHTML() {
    let allTags, i, xtr, file;

    allTags = document.getElementsByTagName("*");
    for (i = 0; i < allTags.length; i++) {
        file = allTags[i].getAttribute("w3-include-html");
        if (file) {
            xtr = new XMLHttpRequest();
            xtr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) { allTags[i].innerHTML = this.responseText; }
                    else if (this.status == 400) { allTags[i].innerHTML = "Page not found"; }
                    allTags[i].removeAttribute("w3-include-html");
                    includeHTML();
                }
            }
            xtr.open("get", file, true);
            xtr.send();
            return;
        }
    }
}

includeHTML();

window.onkeydown = function(e) {
    if ( event.keyCode == 27 && document.getElementById("open_image_wrap")) {
        document.getElementById("open_image_wrap").style = "display: none";
    }
    if ( event.keyCode == 27 && document.getElementById("message")) {
        document.getElementById("message").remove();
    }
};
