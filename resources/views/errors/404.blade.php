@include('partials.header')
<main>
    <div class="main_wrap">
        <div class="main_wrap__text">
            <h1 class="heading">{{__('messages.e404-header',[], session('locale'))}}</h1>
            <p class="mb-5 text-center">{{__('messages.e404-text', [], session('locale'))}}</p>
            <a href="{{route('payment.form')}}" class="go_back" >{{__('messages.btn_back',[], session('locale'))}}</a>
        </div>
    </div>
</main>
@include('partials.footer')
