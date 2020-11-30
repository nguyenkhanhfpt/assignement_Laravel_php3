<div class="message-center ps ps--theme_default" data-ps-id="2083484a-2d54-5b3b-d4e1-ce1edd32ecd4">
    @foreach($notifications as $notify)
        @if ($notify->type === config('settings.buy_product'))
            <a data-id="{{ $notify->id }}" href="{{ route('adminBill') }}" 
                class="{{ $notify->read_at ? '' : 'unread' }}">
        @else 
            <a data-id="{{ $notify->id }}" href="javascript:void(0)" 
                class="{{ $notify->read_at ? '' : 'unread' }}">
        @endif
            <div class="btn-circle">
                <img src="{{ asset('images') }}/{{ $notify->member->img_member }}" alt="">
            </div>
            <div class="mail-content">
                <h5>{{ $notify->member->name_member }}</h5>
                <span title="" class="mail-desc">
                    {{ trans('view.notification.notify_new_order') }}
                </span>
                <span class="time">{{ $notify->created_at }}</span> 
            </div>
        </a>
    @endforeach
    @if (!count($notifications))
        <div class="p-3 text-center">
            <p style="font-size: 1.4rem">{{ trans('view.notification.nothing_notify') }}</p>
        </div>
    @endif
</div>