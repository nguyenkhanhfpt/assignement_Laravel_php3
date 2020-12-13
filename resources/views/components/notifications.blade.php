<div class="message-center ps ps--theme_default" data-ps-id="2083484a-2d54-5b3b-d4e1-ce1edd32ecd4">
    @foreach($notifications as $notify)
        @if ($notify->type === config('settings.buy_product'))
            <a data-id="{{ $notify->id }}" href="{{ route('adminBill') }}" 
                class="{{ $notify->read_at ? '' : 'unread' }}">
        @elseif ($notify->type === config('settings.change_order')) 
            <a data-id="{{ $notify->id }}" href="{{ route('account') }}" 
                class="{{ $notify->read_at ? '' : 'unread' }}">
        @elseif ($notify->type === config('settings.comment')) 
            <a data-id="{{ $notify->id }}" href="{{ route('viewProduct', ['id' => $notify->product->slug]) }}" 
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
                <span class="mail-desc">
                    @if ($notify->type === config('settings.buy_product'))
                        <span title="{{ trans('view.notification.notify_new_order') }}" class="mail-desc">
                            {{ trans('view.notification.notify_new_order') }}
                        </span> 
                    @elseif ($notify->type === config('settings.comment'))
                        <span title="{{ trans('view.notification.commented', ['name' => $notify->product->name_product]) }}" class="mail-desc">
                            {{ trans('view.notification.commented', ['name' => $notify->product->name_product]) }}
                        </span>
                    @elseif ($notify->type === config('settings.change_order'))
                        @switch($notify->data['type'])
                            @case(config('settings.accepted'))
                                <span title="{{ trans('view.notification.notify_accepted', ['id' => $notify->data['bill_id']]) }}" class="mail-desc">
                                    {{ trans('view.notification.notify_accepted', ['id' => $notify->data['bill_id']]) }}
                                </span>
                                @break
                            @case(config('settings.rejected'))
                                <span title="{{ trans('view.notification.notify_rejected', ['id' => $notify->data['bill_id']]) }}" class="mail-desc">
                                    {{ trans('view.notification.notify_rejected', ['id' => $notify->data['bill_id']]) }}
                                </span>
                                @break
                            @default
                                <span title="{{ trans('view.notification.notify_running', ['id' => $notify->data['bill_id']]) }}" class="mail-desc">
                                    {{ trans('view.notification.notify_running', ['id' => $notify->data['bill_id']]) }}
                                </span>
                        @endswitch
                    @endif
                </span>
                <span class="time" title="{{ $notify->created_at }}">{{ Carbon\Carbon::parse($notify->created_at)->diffForHumans() }}</span> 
            </div>
        </a>
    @endforeach
    @if (!count($notifications))
        <div class="p-3 text-center">
            <p style="font-size: 1.4rem">{{ trans('view.notification.nothing_notify') }}</p>
        </div>
    @endif
</div>