@extends ('dashboard.master')

@isset($category)
    @section('title', 'Редактировать категорию -' .' '. $category->name)
@else
    @section('title', 'Добавить категорию')
@endisset

@section('index')
    <div>

        <form 
            @isset($category)
                action="{{ route('categories.update', $category) }}" 
            @else 
                action="{{ route('categories.store') }}" 
            @endisset 
            method="POST" 
            enctype="multipart/form-data"
            style="position: relative; width: 400px; display: flex; flex-direction: column;"
        >

            @isset($category) @method('PUT') @endisset
            @csrf

            <input 
                type="text"
                value="@if(isset($category)){{$category->name}}@else{{old('name')}}@endif" 
                name="name" 
                placeholder="Название категории" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('name'){{$message}}@enderror

            <input 
                type="text"
                value="@if(isset($category)){{$category->parent_id}}@else{{old('parent_id')}}@endif" 
                name="parent_id" 
                placeholder="parent_id" 
                autocomplete="off"
                style="margin-bottom: 5px"
            >

            @error('parent_id'){{$message}}@enderror

            <input 
                type="text"
                value="@if(isset($category)){{$category->external_id}}@else{{old('external_id')}}@endif" 
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