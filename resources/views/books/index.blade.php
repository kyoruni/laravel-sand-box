@extends('layouts.app')

@section('content')

    @foreach($items as $item)
        <p>{{ $item['title'] }}</p>
        <img src="{{ $item['imageUrl'] }}">
        <p>{{ $item['publisher'] }}</p>
        <p>{{ $item['author'] }}</p>
    @endforeach

@endsection