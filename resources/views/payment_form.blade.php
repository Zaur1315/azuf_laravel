@include('partials.header')
<main>
    <div class="main_wrap">
        <form enctype="multipart/form-data" action="{{route('payment.process')}}" method="post">
            @csrf
            <div class="form_row">
                <div class="form_col hidden on">
                    <label class="input_lab" for="first_name">{{trans('messages.form_name')}}</label>
                    <input type="text" placeholder="Мурад" id="first_name" name="first_name" disabled>
                </div>
                <div class="form_col hidden on">
                    <label class="input_lab" for="last_name">Фамилия</label>
                    <input type="text" placeholder="Мурадов" id="last_name" name="last_name" disabled>
                </div>
            </div>
            <div class="form_row">
                <div class="form_col hidden on">
                    <label class="input_lab" for="mail">E-Mail</label>
                    <input type="email" placeholder="murad_muradov@mail.com" id="mail" name="mail" disabled>
                </div>
                <div class="form_col hidden on">
                    <label class="input_lab" for="phone">Телефон</label>
                    <input type="tel" id="phone" name="phone" placeholder='+(994)-77-777-77-77' disabled>
                </div>
            </div>
            <div class="form_row">
                <div class="form_col hidden on">
                    <label class="input_lab" for="fin">FIN</label>
                    <input type="text" placeholder="SD545C" maxlength="7" minlength="6" id="fin" name="fin" disabled>
                </div>
                <div class="form_col">
                    <label class="input_lab" for="payment">Сумма <span class='star'>*</span></label>
                    <input step="1" required type="number" id="payment" name="payment">
                </div>
            </div>
            <div class='form_row'>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        Пожертвовать анонимно (Если хотите заполнить поля с данными, снимите флажок) </label>
                </div>
            </div>
            <div class="form_row">
                <div class="form_col">
                    <input class="submit" type="submit" value="Перейти к оплате">
                </div>
                <div class="form_col">
                    <p class="not_p">
                        Поля отмеченные <span class="star">*</span> обязательны к заполнению.
                    </p>
                </div>
            </div>
        </form>
    </div>
</main>

@include('partials.footer')
