<h3 class=" mb-3 font-weight-normal">{{ $news->title }}</h3>

<p>{{ $news->created_at }}</p>

<div class="img-news">
    <img class="w-100" src="{{ asset('images') }}/{{ $news->image }}" alt="">
</div>

<div class="content-news">
    <?php echo htmlspecialchars_decode($news->content) ?>
</div>