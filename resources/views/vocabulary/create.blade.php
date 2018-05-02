@extends('layouts.app')
<style>

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
</style>
@section('content')

    <h3>New word</h3>

    <div class="container">
        <form action="{{ route('vocabulary.store') }}" method="POST" accept-charset="utf-8" id="form-create-vocabulary">{!! csrf_field() !!}
            <label for="word">Word</label>
            <input type="text" id="word" name="word" placeholder="Word..." required="true">

            <label for="pronunciation">Pronunciation</label>
            <input type="text" id="pronunciation" name="pronunciation" placeholder="Pronunciation..." required="true">

            <label for="explanation">Explanation</label>
            <textarea id="explanation" name="explanation" placeholder="Explanation..." style="height:200px" required="true"></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>
@endsection
