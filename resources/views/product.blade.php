@extends ('master')

@section('title', 'Товар')

@section('index')

<p>Товар - {{$product->name}}</p>
<p>Описание : {{$product->description}}</p>
<p>Цена : {{$product->price}} р.</p>
<p>В наличии : {{$product->quantity}} шт.</p>
<p>Категории : @foreach ($product->categories as $item) {{$item->name}} @endforeach</p>
<p>external_id : {{$product->external_id}}</p>
<p>Обновлен : {{$product->updated_at}}</p>

<a href="{{config('app.url')}}">На главную</a>

@endsection