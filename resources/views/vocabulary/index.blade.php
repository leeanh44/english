@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vocabularies</div>
                <button><a href="{{ route('vocabulary.create') }}">Create</a></button>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($vocabularies as $item)
                        <div class="popup">
                            <a href="{{ route('vocabulary.show', $item->id) }}">
                                <span style="text-transform: capitalize; font-weight: bold ;">{{ $item->word }}</span>
                            </a>
                            <span> : {{ $item->pronunciation }} : </span>
                            <a href="javascript:void(0)" onclick="play(this.id)" id="{{ $item->id }}">
                                <span class="glyphicon glyphicon-volume-up"></span>
                            </a>
                            <audio id="audio-{{ $item->id }}" src="{{ $item->audio }}"></audio>
                            <p>{{ $item->explanation }}</p>
                            <a href="{{ route('vocabulary.edit', $item->id) }}" style="background-color: #4c81af; color: white; padding: 5px; border-radius: 4px; cursor: pointer;">Explantion</a>
                        </div><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style type="text/css">
    /* Popup container */
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* The actual popup (appears on top) */
    .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {opacity: 0;} 
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }
</style>
<script>
    // When the user clicks on <div>, open the popup
    function myFunction(obj) {
        var popup = document.getElementById($(obj).text());
        popup.classList.toggle("show");
    }
    function play(obj){
        var audio = document.getElementById("audio-" + obj);
        audio.play();
    }
</script>