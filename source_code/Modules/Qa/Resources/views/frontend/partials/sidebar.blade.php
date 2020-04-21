<div class="qa-sidebar">
    <div class="form-qa">
        <h2 class="heading-bar-style-2">Gửi câu hỏi</h2>
        @include('notifications')
        <form class="form" method="POST" action="">
            <div class="form-group {{ hasValidator('name') }}">
                <input type="text" name="name" placeholder="Họ và tên" value="{{ old('name') }}" class="form-control">
                {!! alertError('name') !!}
            </div>
            <div class="form-group {{ hasValidator('email') }}">
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control">
                {!! alertError('email') !!}
            </div>
            <div class="form-group {{ hasValidator('phone') }}">
                <input type="text" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}" class="form-control">
                {!! alertError('phone') !!}
            </div>
            <div class="form-group {{ hasValidator('question') }}">
                <textarea class="form-control" name="question" placeholder="Nội dung câu hỏi" rows="10" style="resize: none">{{ old('question') }}</textarea>
                {!! alertError('question') !!}
            </div>
            <div class="form-group {{ hasValidator('g-recaptcha-response') }}">
                <div class="g-recaptcha" data-sitekey="6Lc9dBsUAAAAAG3jMxuA9SmX2XrgBwukv4m7XytN"></div>
                {!! alertError('g-recaptcha-response') !!}
            </div>
            <div class="form-group text-center">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-sm cbtn-danger">Gửi</button>
            </div>
        </form>
    </div>

    @if($mostQuestions->count())
        <div class="most-qa">
            <h2 class="heading-bar-style-2">Câu hỏi thường gặp</h2>
            <ul class="listing">
                @foreach($mostQuestions as $item)
                    <li class="item">
                        <a class="link" href="{{ route('qa.answer', $item->getId()) }}">{{ $item->getQuestion() }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin: 10px 0 0 0">
        <iframe width="100%" height="250" src="https://www.youtube-nocookie.com/embed/6tVW8sWXlQo" frameborder="0" allowfullscreen></iframe>
    </div>

    <div style="margin: 10px 0 0 0;">
        <div class="fb-page" data-href="https://www.facebook.com/tamnguyenphongthuy" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/tamnguyenphongthuy" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/tamnguyenphongthuy">Phong thủy Tam Nguyên</a></blockquote></div>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=442754092739471";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>