<p>Фильтры</p>

<div style="display: flex; flex-direction: row;">

    <a href="{{config('app.url') . '/?filter=price_down'}}" style="margin-right: 10px;">По цене - убывание</a>
    <a href="{{config('app.url') . '/?filter=price_up'}}" style="margin-right: 10px;">По цене - возрастание</a>
    <a href="{{config('app.url') . '/?filter=time_down'}}" style="margin-right: 10px;">По дате - возрастание</a>
    <a href="{{config('app.url') . '/?filter=time_up'}}" style="margin-right: 10px;">По дате - убывание</a>

</div>