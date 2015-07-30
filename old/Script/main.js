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
    
    $(".button-save").on("click",function(){
        $(".confirm").removeClass("confirmHidden");
    });

    $("#submit").on("click",  function(e) {
        
        e.preventDefault();
            
        var dataURL = canvas.toDataURL();

        $.ajax({
            type: "POST",
            url: "/upload",
            data: { 
             imgBase64: dataURL
            }
        }).done(function(o) {
            console.log('saved'); 
            
        });

    });

    $('.button-clear').on("click", function(){
        
        var r = confirm("Are you sure you want to clear this drawing?");
        
        if (r == true){
            ctx.clearRect(0, 0, w, h);
            return false;
        }else{
            return false;
        }

    });

    $('.button-back').on("click", function() {

        var m = confirm("Are you sure you want to go back to the main menu?");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.location.href = "../FOC2015/index.html";
        }

    });

    $('.colourPick').on("click",function(){
        
        
        switch (this.id) {
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
        case "purple":
            x = "#B10DC9";
            break;
        case "lightBlue":
            x = "#7FDBFF";
            break;
        case "pink":
            x = "#FF75D1";
            break;
        case "magenta":
            x = "#990000";
            break;
        case "brown":
            x = "#331A00";
            break;
        case "grey":
            x = "#555";
            break;
        
                
    }
        
    });
    
    $('.brushBox img').on("click",function(){
        if ($(this).attr('id') == "small"){
            
            $(this).addClass('selectedBrush');
            
            $("#medium").removeClass('selectedBrush');
            $("#large").removeClass('selectedBrush');
            $("#mega").removeClass('selectedBrush');
            y = 5;
            
        }else if($(this).attr('id') == "medium"){
            
            $(this).addClass('selectedBrush');
            
            $("#small").removeClass('selectedBrush');
            $("#large").removeClass('selectedBrush');
            $("#mega").removeClass('selectedBrush');
            
            y=12;
        }else if($(this).attr('id') == "large"){
            
            $(this).addClass('selectedBrush');
            
            $("#small").removeClass('selectedBrush');
            $("#medium").removeClass('selectedBrush');
            $("#mega").removeClass('selectedBrush');
            y=22;
        }else if($(this).attr('id') == "mega"){
            
            $(this).addClass('selectedBrush');
            
            $("#small").removeClass('selectedBrush');
            $("#large").removeClass('selectedBrush');
            $("#medium").removeClass('selectedBrush');
            y=100;
        }
    });
    
    $("canvas").on("mouseover",function(){
        if (x == "white"){
            document.getElementById("can").style.cursor = "cell";
        }else{
            document.getElementById("can").style.cursor = "crosshair";
        }
    });
    
    $(".confirm img").on("click",function(){
        $(".confirm").addClass("confirmHidden")
    })
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

