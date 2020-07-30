function put_spb_to_video(e) {
    let name = e.src;
    let index = name.lastIndexOf("/");
    let div = document.createElement("div");
    let style;

    name = name.slice(index + 1);
    if (document.getElementById("spb_image"))
        document.getElementById("spb_image").remove();
    style = "background-image: url('../superposable/" + name + "');"
    div.style = style;
    div.id = "spb_image";
    document.getElementById("video_container").prepend(div);
}

document.onmousedown = function(e) {
    if (e.target == document.getElementById("spb_image")) {
        let spb = document.getElementById("spb_image");
        let x0 = 0, y0 = 0, x1 = e.clientX, y1 = e.clientY;
        let cont_css = getComputedStyle(document.getElementById("video_container"));
        let spb_css = getComputedStyle(spb);
        let video = document.getElementsByTagName("video")[0];
        let video_image = document.getElementById("video_container_image");
        
        document.onmouseup = function(e) {
            document.onmouseup = null;
            document.onmousemove = null;
        }
        if (video_image.style == "display: none;")
            video = video_image;
        document.onmousemove = function(e) {
            x0 = x1 - e.clientX;
            y0 = y1 - e.clientY;
            x1 = e.clientX;
            y1 = e.clientY;
            if (spb.offsetLeft - video.offsetLeft - x0 + parseInt(spb_css.width) < parseInt(cont_css.width)
                && spb.offsetLeft - video.offsetLeft - x0 >= 0
                && spb.offsetTop - video.offsetTop - y0 + parseInt(spb_css.height) < parseInt(cont_css.height)
                && spb.offsetTop - video.offsetTop - y0 >= 0)
            {
                spb.style.left = (spb.offsetLeft - x0) + "px";
                spb.style.top = (spb.offsetTop - y0) + "px";
            }
        }
    }
}
