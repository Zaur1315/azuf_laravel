@include('partials.header')
<main>


    <div class="container list-container">
        <div class="row mb-3">
            @foreach($pages as $page)
                <div class="col-md-4 fade-effect">
                    <div class="card">
                        <div class="card-header">
                            {{$page->subject}}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$page->description}}</p>
                            <a href="{{$page->slug}}" class="btn btn-green">{{__('messages.card_btn', [], session('locale'))}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$pages->links()}}
    </div>
</main>
@include('partials.footer')
