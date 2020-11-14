@component('mail::message')
# Phản hồi của khách hàng
{{ $datas['content'] }}

Người gửi,<br>
{{ $datas['email'] }}

@endcomponent
