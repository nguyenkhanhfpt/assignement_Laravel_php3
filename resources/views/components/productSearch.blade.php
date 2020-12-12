@foreach ($products as $product)
    <div class="product product-list">
        <div class="product-list-img">
            <img src="{{ Helper::exec()->getFirstImage($product->images) }}" alt="">
        </div>
        <div class="product__decs">
            <div class="manufacturer">
                <a href="{{route('products')}}?category={{$product->id}}">
                    {{ $product->category->name}}
                </a>
            </div>
            <h2 class="product__name">
                <a href="{{route('products')}}/{{$product->slug}}" title="{{ $product->name_product }}" class="one-line">{{ $product->name_product}}</a>
            </h2>
            <div class="product__price">
                <span>{{number_format($product->price_product - ($product->price_product / 100 * $product->sale))}} đ</span>
            </div>
        </div>
    </div>
@endforeach

@if(count($products) == 0)
    <p class="my-1" style="font-size: 1.4rem">@lang('view.nothing_pro_search')</p>
@endif