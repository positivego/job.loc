@extends ('dashboard.master')

@isset($product)
    @section('title', 'Редактировать товар -' .' '. $product->name)
@else
    @section('title', 'Добавить товар')
@endisset

@section('index')
    <div>

        <form 
            @isset($product)
                action="{{ route('products.update', $product) }}" 
            @else 
                action="{{ route('products.store') }}" 
            @endisset 
            method="POST" 
            enctype="multipart/form-data"
            style="position: relative; width: 400px; display: flex; flex-direction: column;"
        >

            @isset($product) @method('PUT') @endisset
            @csrf

            <input 
                type="text"
                value="@if(isset($product)){{$product->name}}@else{{old('name')}}@endif" 
                name="name" 
                placeholder="Название товара" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('name'){{$message}}@enderror

            <input 
                type="text"
                value="@if(isset($product)){{$product->description}}@else{{old('description')}}@endif" 
                name="description" 
                placeholder="Описание" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('description'){{$message}}@enderror

            <input 
                type="text"
                value="@if(isset($product)){{$product->price}}@else{{old('price')}}@endif" 
                name="price" 
                placeholder="Цена" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('price'){{$message}}@enderror

            <input 
                type="text"
                value="@if(isset($product)){{$product->quantity}}@else{{old('quantity')}}@endif" 
                name="quantity" 
                placeholder="Кол-во товара" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('quantity'){{$message}}@enderror

            <select multiple="multiple" name="categories[]" style="margin-bottom: 5px">

                @foreach ($categories as $category)

                    <option value="{{$category->id}}"
                        @isset($product)
                            @foreach ($product->categories as $item)
                                @if ($item->id === $category->id)
                                    selected
                                @endif
                            @endforeach
                        @endisset
                    >{{$category->name}}</option>

                @endforeach

            </select>

            @error('categories'){{$message}}@enderror

            <input 
                type="text"
                value="@if(isset($product)){{$product->external_id}}@else{{old('external_id')}}@endif" 
                name="external_id" 
                placeholder="external_id" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('external_id'){{$message}}@enderror

            <button type="submit"><p>Сохранить</p></button>

        </form>

    </div>

@endsection