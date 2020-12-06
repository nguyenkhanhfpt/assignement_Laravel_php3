<div class="comment__box">
    <img src="{{ asset('images')}}/{{$comment->member->img_member}}" alt="">
    <div class="comment__content">
        <h3 class="comment__info">{{$comment->member->name_member }} 
            <span>({{ $comment->date_comment }})</span>
        </h3>
        <p>{{ $comment->content }}</p>
    </div>
    @if(\Helper::exec()->displayDeleteComment($comment->member_id))
        <a href="" data-id="{{ $comment->id }}" class="remove-comment remove-comment-{{$comment->id}}">
            <i class="fal fa-backspace"></i>
        </a>
    @endif
</div>