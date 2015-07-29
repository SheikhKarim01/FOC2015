var canvas, ctx, flag = false,
    prevX = 0,
    currX = 0,
    prevY = 0,
    currY = 0,
    dot_flag = false;

var x = "#0C0C0C",
    y = 5;

$(document).ready(function(){
    
    canvas = document.getElementById('can');
    ctx = canvas.getContext("2d");
    w = canvas.width;
    h = canvas.height;

    canvas.addEventListener("mousemove", function (e) {
        findxy('move', e)
    }, false);
    canvas.addEventListener("mousedown", function (e) {
        findxy('down', e)
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        findxy('up', e)
    }, false);
    canvas.addEventListener("mouseout", function (e) {
        findxy('out', e)
    }, false);
    
    initButtons();
    
});

function color(obj) {
    switch (obj.id) {
        case "green":
            x = "#2ECC40";
            break;
        case "blue":
            x = "#0074D9";
            break;
        case "red":
            x = "#FF4136";
            break;
        case "yellow":
            x = "#FFDC00"
            break;
        case "orange":
            x = "#FF851B";
            break;
        case "black":
            x = "#0C0C0C";
            break;
        case "white":
            x = "white";
            break;
    }

}

function check(){
    if (x == "white"){
        document.getElementById("can").style.cursor = "url(Assets/Images/eraser2.png)";
    }else{
        document.getElementById("can").style.cursor = "crosshair";
    }
}

function draw() {
    ctx.beginPath();
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    ctx.strokeStyle = x;
    ctx.lineCap = 'round';
    ctx.lineWidth = y;
    ctx.stroke();
    ctx.closePath();
}

function initButtons(){
    
    console.log('Initialise buttons...');

    $('.button-save').on("click",  function() {

            var dataURL = canvas.toDataURL();

            console.log(dataURL);

            $.ajax({
                type: "POST",
                url: "/submit",
                data: { 
                 imgBase64: dataURL
                }
            }).done(function(o) {
                console.log('saved'); 
                // If you want the file to be visible in the browser 
                // - please modify the callback in javascript. All you
                // need is to return the url to the file, you just saved 
                // and than put the image in your browser.
            });

    });

    $('.button-clear').on("click", function(){

        var m = confirm("Are you sure you want to clear?");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }

    });

    $('.button-back').on("click", function() {

        var m = confirm("Are you sure you want to go back to the main menu?");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }

    });

}

function findxy(res, e) {
    if (res == 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.clientX - canvas.offsetLeft;
        currY = e.clientY - canvas.offsetTop;

        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = x;
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    }
    if (res == 'up' || res == "out") {
        flag = false;
    }
    if (res == 'move') {
        if (flag) {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            draw();
        }
    }
}


function brushChange(size){
    y = size;
}