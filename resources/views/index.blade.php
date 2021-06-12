@extends ('master')

@section('title', 'Главная')

@section('index')

<p>Товары</p>

<div style="display: flex; flex-direction: row; flex-wrap: wrap;">

    @foreach ($products as $product)

            <a href="{{route('product', $product)}}" style="position: relative; width: 150px; border: 1px solid gray; margin: 5px">
                <p>id: {{$product->id}}</p>
                <p>{{$product->name}}</p>
                <p>Цена: {{$product->price}}</p>
                <p>{{$product->updated_at}}</p>
                <p>В наличии: {{$product->quantity}}</p>
            </a>
        
    @endforeach

</div>

    {{$products->appends(['filter' => request()->filter])->links()}}

@endsection