@extends('layouts.app')

@section('content')
<div class="form-group">
    {{Form::open(['method' => 'get'])}}
        {{Form::text('keyword')}}
        {{Form::submit('送信', ['class'=>'submit'])}}
    {{Form::close()}}
</div>
    @foreach($items as $item)
        <p>{{ $item['title'] }}</p>
        <img src="{{ $item['imageUrl'] }}">
        <p>{{ $item['publisher'] }}</p>
        <p>{{ $item['author'] }}</p>
    @endforeach

@endsection