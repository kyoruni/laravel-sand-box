@extends('layouts.app')

@section('content')
<div class="form-group">
    {{Form::open(['method' => 'get'])}}
        {{Form::text('keyword')}}
        {{Form::submit('送信', ['class'=>'submit'])}}
    {{Form::close()}}
</div>
    @foreach($books as $book)
        <p>{{ $book->title }}</p>
        <img src="{{ $book->imageUrl }}">
        <p>{{ $book->publisher }}</p>
        <p>{{ $book->author }}</p>
    @endforeach

@endsection