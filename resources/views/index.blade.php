<html>

<head>
    <title>gridraw</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
    
    
    

<body>
    
    
    <div id="buttons">
        <a href="#"><img src="img/bTT2.png" alt="back to top button"/></a><br>
        <a href="#"><img src="img/search2.png" alt="search button"/></a><br>
        <a href="#"><img src="img/gallery2.png" alt="gallery button"/></a><br>
    </div>


    <header>

        <h1>
           COLLAB<span class="blue" style="color: #66a1ff; display: inline}">ART</span>ATION
        </h1>
        

    </header>

    <h2>What is Collab<span style="color: #66a1ff; display: inline;">art</span>ation?</h2>

    <p>
        Collab<span style="color: #66a1ff; display: inline;">art</span>ation is an app that allows random people from all over the world to work on a piece of art together. When you pick one of the themes you will be brought to a single frame in a grid and you will only be able to see the edges of the frames around that point. You should then connect your drawing to the ones around to help create a bigger piece of art.

    </p>

    <h2>Themes:</h2>


@foreach ($paintings as $painting)

    <div class="themeBox">

        <a href="/{{ $painting->id }}" class="link">    

            <div class="imgBox">
                <img src="{{ $painting->url }}" alt="{{ $painting->url }}"/>
                <progress max="{{ $painting->tileNumber }}" value="{{ $painting->tilesDone }}"></progress>
            </div>

            <div class="themeDetails">

                <h3 class="theme">{{ $painting->theme }}</h3>

                <h3 class="inProgress dis">
                @if ($painting->tilesDone === $painting->tileNumber)
                    <h3>Complete</h3>
                @elseif($painting->tilesDone === ($painting->tileNumber) - $painting->tileNumber)
                  <h3>Not Started</h3>
                @else 
                    <h3>In Progress</h3>
                @endif


                </h3>

                <h3 class="dis"><?php echo ($painting->tilesDone /  $painting->tileNumber) * 100 . '%'; ?></h3>
                <h3 class="dis">Total Tiles: {{ $painting->tileNumber }}</h3>

            </div>

            <div class="arrowBox">
                <img src="img/arrow.png" alt="Arrow button" class="arrow"/>
            </div>

        </a>
    </div>
@endforeach


    
</body>


</html>