<footer>
    <div class="footer__box">
        <div class="footer__info">
            <h2 class="nav__logo"><a href="">{{ env('APP_NAME') }}</a></h2>

            <div class="footer__info-item">
                <i class="fal fa-map-marker-alt"></i>
                <span>137 Nguyễn Thị Thập, Hòa Minh, Liên Chiểu, Đà Nẵng</span>
            </div>
            <div class="footer__info-item">
                <i class="fal fa-phone-alt"></i>
                <span>0868 003 429</span>
            </div>
            <div class="footer__info-item">
                <i class="fal fa-mailbox"></i>
                <span>khanh26122000@gmail.com</span>
            </div>
        </div>
        <div class="footer__contact">
            <h3>Liên hệ</h3>

            @if(session('successEmail'))
                <p class="mt-3" style="font-size: 1.5rem">{{ session('successEmail') }}</p>
            @endif

            <form action="{{route('sendMailContact')}}" method="POST" id="form-contact">
                @csrf
                <input type="email" placeholder="{{ trans('view.your_email') }}" name="your_email">
                <textarea name="review" placeholder="{{ trans('view.write_review') }}" cols="30" rows="4"></textarea>
                <input type="submit" value="{{ trans('view.send') }}" class="footer__contact-submit" id="contact-submit">
            </form>
        </div>
    </div>
</footer>