@extends('layouts.master')

@section('title', env('APP_NAME') .' - '. trans('view.introduce'))

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>@lang('view.introduce')</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>@lang('view.home')</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('about')}}>@lang('view.introduce')</a>
            </div>
        </div>
    </div>

    <div class="contai">
        <div class="row my-5">
            <div class="col-12 col-md-6">
                <div class="about-content">
                    <h2>CÂU CHUYỆN CỦA CHÚNG TÔI</h2>
                    <p>Câu chuyện được sinh ra từ tủ đồ của các cánh mày râu, 
                        nơi được cho là ‘1 màu’, ‘đơn điệu’ và ‘ít được chăm chút’. 
                        Bởi lẽ thực tế, việc mua sắm đối với các anh là không thường xuyên, 
                        ngại phải đi nhiều nơi để mua đủ những đồ mình muốn, 
                        đặc biệt là những món đồ cơ bản nhất. {{ env('APP_NAME') }} hiểu được rằng những chiếc áo phông, 
                        đôi tất hay quần lót sẽ không bao giờ thiếu vắng trong tủ đồ và bằng chính sứ mệnh của mình, chúng 
                        tôi mang đến những sản phẩm tốt nhất.
                    </p>
                    <a href="{{ route('products') }}" class="btn-viewProduct" type="button">XEM SẢN PHẨM</a>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('images') }}/about.jpg" alt="">
            </div>
        </div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.794995625447!2d108.16716595095397!3d16.07612454346745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e265461f%3A0x2e7fc947cd7946b5!2zMTQ3IE5ndXnhu4VuIFRo4buLIFRo4bqtcCwgVGhhbmggS2jDqiBUw6J5LCBMacOqbiBDaGnhu4N1LCDEkMOgIE7hurVuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1607865468410!5m2!1svi!2s" 
            class="map" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
        </iframe>
    </div>  

    @include('components.footer')

@endsection