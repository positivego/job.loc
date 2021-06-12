@extends ('dashboard.master')

@section('title', 'Панель управления')

@section('index')

    <a href="{{config('app.url')}}">На главную</a>
    <a href="{{route('products.create')}}">Создать товар</a>

    <div style="display: flex; flex-direction: column;">
        @foreach ($products as $product)
            <a href="{{route('products.edit', $product)}}">{{$product->name}}</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST">
                            
                @csrf
                @method('DELETE')

                <input type="submit" value="Удалить">

            </form>
        @endforeach
    </div>

    {{$products->links()}}

@endsection