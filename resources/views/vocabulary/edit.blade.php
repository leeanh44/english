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

    <h3>Edit word</h3>

    <div class="container">
        <form action="{{ route('vocabulary.update', $word->id) }}" method="POST" accept-charset="utf-8" id="form-edit-vocabulary">{!! csrf_field() !!}@method('PATCH')
            <label for="word">Word</label>
            <input type="text" disabled value="{{ $word->word }}">

            <label for="pronunciation">Pronunciation</label>
            <input type="text" disabled value="{{ $word->pronunciation }}">

            <label for="explanation">Explanation</label>
            <textarea id="explanation" name="explanation" placeholder="Explanation..." style="height:200px" required="true">{{ $word->explanation }}</textarea>

            <input type="submit" value="Submit">
        </form>
    </div>
@endsection
