@include('partials.header')
<main>
    <div class="main_wrap">
        <div class="main_wrap__text">
            <h1 class="heading">{{__('messages.cancel_message',[], session('locale'))}}</h1>
            <a href="{{route('payment.form')}}" class="go_back" >{{__('messages.btn_back',[], session('locale'))}}</a>
        </div>
    </div>
</main>
@include('partials.footer')
