<h1><i> Hiya hows it going! </i></h1>

@foreach ($painting->tiles as $tile)
    <img src="{{ $tile->url }}">
@endforeach
