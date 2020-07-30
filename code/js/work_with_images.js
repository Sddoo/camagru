let image_wrap = document.getElementById("open_image_wrap");
let image = image_wrap.getElementsByTagName("img")[0];
let messages_wrap = document.getElementById("messages_wrap");
let submit_button = document.getElementById("submit_button");
let like_image = document.getElementById("like_image");

document.addEventListener("click", function (e) {
    if (e.target.parentNode.className == "flex_item") {
        let xtr = new XMLHttpRequest();
        let image_name;

        image_wrap.style = "display: block";
        image.src = e.target.getAttribute("src");
        image_name = image.src.slice(image.src.lastIndexOf("/") + 1);
        xtr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                messages_wrap.innerHTML = this.response;
            } else {
                console.log(this.statusText);
            }
        };
        xtr.open("get", "../php/return_comments.php?image_name=" + image_name);
        xtr.send();
        xtr = new XMLHttpRequest();
        xtr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.includes("yes")) {
                    like_image.src = "../site_images/liked.svg";
                    like_image.alt = "liked";
                } else {
                    like_image.src = "../site_images/not_liked.svg";
                    like_image.alt = "not liked";
                }                
                document.getElementById("like_count").innerHTML = parseInt(this.responseText);
            } else {
                console.log(this.statusText);
            }
        };
        xtr.open("get", "../php/return_likes.php?image_name=" + image_name);
        xtr.send();
    }
});

document.getElementById("close_button").addEventListener("click", function (e) {
    let image_wrap = document.getElementById("open_image_wrap");

    image_wrap.style = "display: none";
});

window.onkeydown = function(e) {
    if ( event.keyCode == 27 ) {
        document.getElementById("open_image_wrap").style = "display: none";
    }
};

submit_button.addEventListener("click", function (e) {
    let xtr = new XMLHttpRequest();
    let image_name;

    image_name = image.src.slice(image.src.lastIndexOf("/") + 1);
    xtr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == "Not logged on user") {
                alert("You are not logged on user");
                return;
            } else {
                messages_wrap.innerHTML += this.response;
                document.getElementById("comment_input_content").value = "";
            }
        } else {
            console.log(this.statusText);
        }
    };
    xtr.open("get", "../php/save_comment.php?comment_content=" + document.getElementById("comment_input_content").value +
    "&image_name=" + image_name + "&submit=OK", true);
    xtr.send();
    xtr = new XMLHttpRequest();
    xtr.open("get", "../php/send_notif.php?comment_content=" + document.getElementById("comment_input_content").value +
    "&image_name=" + image_name + "&submit=OK", true);
    xtr.send();
});

like_image.addEventListener("click", function (e) {
    let xtr = new XMLHttpRequest();
    let image_name;

    image_name = image.src.slice(image.src.lastIndexOf("/") + 1);
    xtr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Not logged on user") {
                alert(this.responseText);
                return;
            }
            else if (this.responseText.includes("add")) {
                like_image.src = "../site_images/liked.svg";
                like_image.alt = "liked";
                document.getElementById("like_count").innerHTML = parseInt(this.responseText);
            } else {
                like_image.src = "../site_images/not_liked.svg";
                like_image.alt = "not liked";
                document.getElementById("like_count").innerHTML = parseInt(this.responseText);
            }
        } else {
            console.log(this.statusText);
        }
    };
    xtr.open("get", "../php/like.php?image_name=" + image_name + "&submit=OK");
    xtr.send();
});

function galleryFiller() {
    let d = document.documentElement;

    if (d.scrollTop + window.innerHeight == d.scrollHeight) {
        let xtr = new XMLHttpRequest();
        let item_count = document.getElementsByClassName("flex_item").length;
        let step = 4;
        let container = document.getElementById("flex_container");

        xtr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (container.innerHTML.includes("Images ended") == false)
                    container.innerHTML += this.responseText;
            } else {
                console.log(this.statusText);
            }
        }
        xtr.open("get", "includes/fill_gallery.php?begin=" + item_count + "&step=" + step);
        xtr.send();
    }
}

window.onscroll = galleryFiller;
window.onload = galleryFiller;
