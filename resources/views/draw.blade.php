<html>
<head>
	<title>Collabart</title>
    
    <link rel="stylesheet" href="/css/draw.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
    
</head>
    
<body >
    
	<div class="header">
		<a href="/" class="block"><img src="/img/Logo.png" alt="logo"/></a>
    </div>
    
	</div>
	<div class="buttons">
        
		 
		<button class="button-save" id="save">
			<img class="button-save" src="/img/tick.png">
		</button>
        
		
		<button for="clear" id="clear" class="button-clear">
			<img class="button-clear" src="/img/cross.png">
		</button>
        
        <button href="/">
			<img class="button-back" src="/img/back.png">
		</button>
        
	</div>
    
	<div class="canvas">
        
		<canvas id="can" height=300px width=300px></canvas>
        
		<div class="grid">
			<div class="top left"><img src="{{$tile_tl}}" alt="picture test"/></div>
			<div class="top center"><img src="{{$tile_above}}" alt="picture test"/></div>
			<div class="top right"><img src="{{$tile_tr}}" alt="picture test"/></div>
			<div class="middle left"><img src="{{$tile_left}}" alt="picture test"/></div>
			
			<div class="middle right"><img src="{{$tile_right}}" alt="picture test"/></div>
			<div class="bottom left"><img src="{{$tile_bl}}" alt="picture test"/></div>
			<div class="bottom center"><img src="{{$tile_below}}" alt="picture test"/></div>
			<div class="bottom right"><img src="{{$tile_br}}" alt="picture test"/></div>
		
		</div>
	</div>
	
	<div class="colourPicker">
        <div class="column1">
            <div class="colourPick" id="green"></div>
            <div class="colourPick" id="blue"></div>
            <div class="colourPick" id="red"></div>
            <div class="colourPick" id="yellow"></div>
            <div class="colourPick" id="orange"></div>
            <div class="colourPick" id="black"></div>
            <div class="colourPick" id="white">

                <span style="position: absolute; left: 50%; transform: translate(-50%, 0); top: 35%;">Eraser</span>
            </div>
        </div>
        
        
        <div class="column2">
            <div class="colourPick" id="purple"></div>
            <div class="colourPick" id="lightBlue"></div>
            <div class="colourPick" id="pink"></div>
            <div class="colourPick" id="magenta"></div>
            <div class="colourPick" id="brown"></div>
            <div class="colourPick" id="grey"></div>
            
        </div>
        <div class="brushBox">
            <img src="/img/brush2.png" alt="small brush" id="small"/>
            <img src="/img/brush3.png" alt="medium brush" id="medium"/>
            <img src="/img/brush4.png" alt="large brush" id="large"/>
            <img class="background" src="/img/brush4.png" alt="mega brush" id="mega"/>
        </div>
	</div>
    <div class="confirm confirmHidden"> 
        
        <img src="/img/cross.png" alt="exit button"/>
        
        <a class="confirmTitle" href="index.html" class="block">COLLAB<span style="color: #66a1ff; display: inline;">ART</span></a>
        
		<p>Let us know your email or phonenumber so we can let you know when this project is finished</p>
		<form>
            
			<label>Email:</label> <input placeholder= "example@mail.com" type="text" name="fname"><br>
			<label>Phone number:</label> <input placeholder= "02312345678"  type="text" name="lname"><br>
			<input type="submit" value="SUBMIT" id="submit">
            
		</form>
	</div>
	
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
    <script src="/script/main.js"></script>

	
</body>
</html>