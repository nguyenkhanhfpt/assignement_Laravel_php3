@for($num = 0; $num <= 8; $num += 2)
    <div class="item">
        <p>{{$newProducts[$num]->name_product}}</p>
        <p>{{$newProducts[$num + 1]->name_product}}</p>
    </div>
@endfor