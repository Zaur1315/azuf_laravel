@include('partials.header')
<main>

    <div class="main_wrap">
        <form class="donate-form" enctype="multipart/form-data" action="{{route('payment.process')}}" method="post">
            @csrf
            <div class="form_row">
                <input type="hidden" name="subject_id" id="subject_id" value="{{$page->id}}">
                <div class="form_col hidden on">
                    <label class="input_lab" for="first_name">{{__('messages.form_name', [], session('locale'))}}</label>
                    <input type="text" placeholder="{{__('messages.form_name_ph', [], session('locale'))}}" id="first_name" name="first_name" disabled>
                </div>
                <div class="form_col hidden on">
                    <label class="input_lab" for="last_name">{{__('messages.form_surname', [], session('locale'))}}</label>
                    <input type="text" placeholder="{{__('messages.form_surname_ph', [], session('locale'))}}" id="last_name" name="last_name" disabled>
                </div>
            </div>
            <div class="form_row">
                <div class="form_col hidden on">
                    <label class="input_lab" for="mail">E-Mail</label>
                    <input type="email" placeholder="murad_muradov@mail.com" id="mail" name="mail" disabled>
                </div>
                <div class="form_col hidden on">
                    <label class="input_lab" for="phone">{{__('messages.form_phone', [], session('locale'))}}</label>
                    <input type="tel" id="phone" name="phone" placeholder='+(994)-77-777-77-77' disabled>
                </div>
            </div>
            <div class="form_row">
                <div class="form_col hidden on">
                    <label class="input_lab" for="fin">FIN</label>
                    <input type="text" placeholder="SD545C" maxlength="7" minlength="6" id="fin" name="fin" disabled>
                </div>
                <div class="form_col">
                    <label class="input_lab" for="payment">{{__('messages.form_sum',[], session('locale'))}} <span class='star'>*</span></label>
                    <input step="1" required type="number" id="payment" name="payment">
                </div>
            </div>
            <div class='form_row justify-content-center'>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        {{__('messages.form_checkbox',[], session('locale'))}}
                    </label>
                </div>
            </div>
            <div class="form_row">
                <div class="form_col">
                    <input class="submit" type="submit" value="{{trans('messages.form_submit', [], session('locale'))}}">
                </div>
                <div class="form_col">
                    <p class="not_p">
                        <span class="star">*</span> {{trans('messages.form_comment', [], session('locale'))}}
                    </p>
                </div>
            </div>
        </form>
    </div>
</main>
@include('partials.footer')
