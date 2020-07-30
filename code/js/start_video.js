window.onload = function() {
    let snap = false;
    let constraints = {
        audio: false,
        video: {
                facingMode: "user",
                width: { min: 500, ideal: 900 },
                height: { min: 300, ideal: 506 }
        }
    }

    navigator.getUserMedia = (navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia);

    if (navigator.getUserMedia) {
        navigator.getUserMedia(constraints, 
        function(mediaStream) {
            let video = document.querySelector('video');
            video.srcObject = mediaStream;
            video.onloadedmetadata = function(e) {
                video.play();
            };
        },
        function(err) {
            console.log(err.name + ":" + err.mesage);
        });
    }
    else
        console.log("Error");

    document.getElementById('snapshot').onclick = function() {
        let video = document.querySelector('video');
        let video_image = document.getElementById("video_container_image");
        let canvas = document.getElementById('canvas'); 
        let ctx = canvas.getContext('2d');
        let xtr = new XMLHttpRequest();
        let spb = document.getElementById("spb_image");
        let spb_name;

        if (video.readyState == 0 &&
            video_image.style['display'] == "none") {
            alert("Video not loaded yet");
            return;
        }
        if (spb == null) {
            alert("You should choose sticker");
            return;
        }
        spb_name = spb.style.backgroundImage;
        xtr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                let image = new Image();
                image.src = "data:image/jpeg;base64," + this.response;
                image.onload = function() {
                    ctx.drawImage(image, 0, 0);
                };
            }
            else
                console.log(this.statusText);
        };
        spb_name = spb_name.slice(spb_name.lastIndexOf("/") + 1);
        if (video_image.style['display'] == "block") {
            video = video_image;
        }
        ctx.drawImage(video, 0, 0, 900, 506);
        xtr.open("POST", "snapshot.php", true);
        xtr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xtr.send("img_content=" + canvas.toDataURL('image/jpeg')
        + "&spb_name=" + spb_name.substring(0, spb_name.lastIndexOf("\""))
        + "&offsetHeight=" + (parseInt(spb.style.top) - video.offsetTop)
        + "&offsetWidth=" + (parseInt(spb.style.left) - video.offsetLeft)
        + "&submit=OK");
        snap = true;
    }

    // This function's purpose is AJAX saving image in db and
    // adding it to thumbnails. Message "Image is saves" in console
    // if success, otherwise response.statusText
    document.getElementById("save").onclick = function() {
        let canvas = document.getElementById('canvas');
        let xtr = new XMLHttpRequest();

        if (snap == false) {
            alert("You should snapshot before");
            return;
        }
        xtr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                let div = document.createElement("div");
                let img = document.createElement("img");
                let close = document.createElement("img");
                let container = document.getElementsByClassName("thumb_container")[0];

                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                snap = false;
                div.className = "thumb_item";
                img.setAttribute("src", "../images/" + this.responseText);
                img.className = "thumb_image";
                close.setAttribute("src", "../site_images/748122.svg");
                close.className = "close_image";
                div.append(img);
                div.append(close);
                container.prepend(div);
                console.log("Image is saved!");
            }
            else
                console.log(this.statusText);
        };
        xtr.open("POST", "save_image.php", true);
        xtr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xtr.send("img_content=" + canvas.toDataURL('image/jpeg') + "&submit=OK");
    }

    document.getElementById("reset").onclick = function() {
        let canvas = document.getElementById('canvas'); 
        let context = canvas.getContext('2d')

        context.clearRect(0, 0, canvas.width, canvas.height);
        snap = false;
    }

    document.addEventListener("click", function (e) {
        if (e.target.className == "close_image") {
                let image_name = e.target.parentNode.getElementsByClassName("thumb_image")[0].src;
                let xtr = new XMLHttpRequest();

                if (confirm("Are you sure?") == false)
                    return;
                image_name = image_name.slice(image_name.lastIndexOf("/") + 1);
                xtr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        if (this.responseText == "OK") {
                            alert("Your image is deleted");
                            e.target.parentNode.remove();
                        } else {
                            alert("It isn't your image");
                        }
                    }
                    else
                        console.log(this.statusText);
                };
                xtr.open("get", "../php/delete_image.php?image_name=" + image_name);
                xtr.send();
            }   
    });

    function uploadImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            let img = document.getElementById("video_container_image");
            
            reader.onload = function (e) {
                img.src = e.target.result;
                img.style = "display: block;"
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById("upload_input").onchange = function() {
        uploadImage(this);
    };

}
