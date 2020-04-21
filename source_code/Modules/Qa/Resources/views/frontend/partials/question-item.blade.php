<div class="media">
    <div class="media-left">
        <img src="/images/avatar_default.png">
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            <a href="{{ $question->getUrl() }}">{{ $question->getUserName() }}</a>
        </h4>
        <p>{{ $question->getQuestion() }}</p>
        <div>
            <a href="{{ $question->getUrl() }}" class="btn btn-xs btn-primary pull-right">Xem trả lời</a>
            <div class="clearfix"></div>
        </div>
    </div>
</div>