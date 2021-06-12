
<p>Категории</p>

<div style="display: flex; flex-direction: row;">

    @foreach ($categories as $category)
        <a href="{{config('app.url') . '/category/' . $category->id}}" style="margin-right: 10px;">{{$category->name}}</a>
    @endforeach

</div>