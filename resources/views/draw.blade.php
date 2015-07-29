<html>
<head>
	<title>Collabartation</title>
    
    <link rel="stylesheet" href="css/draw.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
    
</head>
    
<body onload="init()">
    
	<div class="header">
		<a href="/" class="block">COLLAB<span style="color: #66a1ff; display: inline;">ART</span>ATION</a>
    </div>
    
	</div>
	<div class="buttons">
        
		<input type="button" id="save" name="save" onclick="save()">
		<label for="save">
			<img class="button-save" src="img/tick.png">
		</label>
        
		<input type="button" id="clear" name="clear" onclick="erase()">
		<label for="clear">
			<img class="button-clear" src="img/cross.png">
		</label>
        
        <a href="/" onclick="back()">
			<img class="button-back" src="img/back.png">
		</a>
        
	</div>
    
	<div class="canvas">
        
		<canvas id="can" height=300px width=300px onmouseover="check()"></canvas>
        
		<div class="grid">
			<div class="top left"><img src="img/test/6.jpg" alt="picture test"/></div>
			<div class="top center"><img src="img/test/7.jpg" alt="picture test"/></div>
			<div class="top right"><img src="img/test/8.jpg" alt="picture test"/></div>
			<div class="middle left"><img src="img/test/1.jpg" alt="picture test"/></div>
			
			<div class="middle right"><img src="img/test/2.jpg" alt="picture test"/></div>
			<div class="bottom left"><img src="img/test/4.jpg" alt="picture test"/></div>
			<div class="bottom center"><img src="img/test/5.jpg" alt="picture test"/></div>
			<div class="bottom right"><img src="img/test/3.jpg" alt="picture test"/></div>
		
		</div>
	</div>
	
	<div class="colourPicker">
		<div id="green" onclick="color(this)"></div>
		<div id="blue" onclick="color(this)"></div>
		<div id="red" onclick="color(this)"></div>
		<div id="yellow" onclick="color(this)"></div>
		<div id="orange" onclick="color(this)"></div>
		<div id="black" onclick="color(this)"></div>
		<div id="white" onclick="color(this)">
			<span style="position: absolute; left: 50%; transform: translate(-50%, 0); top: 35%;">Eraser</span>
		</div>
        
        <div class="brushBox">
            <img src="img/brush2.png" alt="small brush" onclick="brushChange(5)"/>
            <img src="img/brush3.png" alt="medium brush" onclick="brushChange(12)"/>
            <img src="img/brush4.png" alt="large brush" onclick="brushChange(22)"/>
        </div>
	</div>
    <div class="Confirm ConfirmHidden"> 
		<p>Give us your details so we can let you know when this project is finished</p>
		<form action="demo_form.asp">
			<label>Email:</label> <input placeholder= "example@mail.com" type="text" name="fname"><br>
			<label>Phone number:</label> <input placeholder= "02312345678"  type="text" name="lname"><br>
			<input type="submit" value="Submit">
		</form>
	</div>
	
<script src="Script/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" />
	
</body>
</html>