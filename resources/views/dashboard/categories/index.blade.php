@extends ('dashboard.master')

@section('title', 'Панель управления')

@section('index')

    <a href="{{config('app.url')}}">На главную</a>
    <a href="{{route('categories.create')}}">Создать категорию</a>

    <div style="display: flex; flex-direction: column;">
        @foreach ($categories as $category)
            <a href="{{route('categories.edit', $category)}}">{{$category->name}}</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            
                @csrf
                @method('DELETE')

                <input type="submit" value="Удалить">

            </form>
        @endforeach
    </div>

    {{$categories->links()}}

@endsection