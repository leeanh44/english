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
                            <span style="text-transform: capitalize; font-weight: bold ;" onclick="myFunction(this)">{{ $item->word }}</span>
                            <span> : {{ $item->pronunciation }}</span>
                            <p>{{ $item->explanation }}</p>
                            <span class="popuptext" id="{{ $item->word }}">{{ $item->explanation }}</span>
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
        var value = $(obj).text();
        var popup = document.getElementById(value);
        popup.classList.toggle("show");
    }
</script>