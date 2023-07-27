<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/main.css">
    <title>Form</title>
</head>
<body>
    <header>
        <div class="header_wrap">
            <div class="logo">
                <a href="https://www.azuf.az/" class="logo__link">
                    <img class="logo_img" src="./img/logo.webp" alt="logo">
                </a>
            </div>
            <div class="language">
                <div class="language__links">
                    <a href="#!" class="deactive" >AZ</a>
                    <a href="./index-ru.php">RU</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="main_wrap">
            <form enctype="multipart/form-data" action="./api.php" method="post">
                <div class="form_row">
                    <div class="form_col hidden on">
                        <label class="input_lab" for="first_name">Ad</label>
                        <input type="text" placeholder="Murad" id="first_name" name="first_name" disabled>
                    </div>                
                    <div class="form_col hidden on">
                        <label class="input_lab" for="last_name">Soyad</label>
                        <input type="text" placeholder="Muradov" id="last_name" name="last_name" disabled>
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_col hidden on">
                        <label class="input_lab" for="mail">E-Mail</label>
                        <input type="email" placeholder="murad_muradov@mail.com" id="mail" name="mail" disabled>
                    </div>                
                    <div class="form_col hidden on">
                        <label class="input_lab" for="phone">Telefon</label>
                        <input type="tel" id="phone" placeholder='+(994)-77-777-77-77' name="phone" disabled>
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_col hidden on">
                        <label class="input_lab" for="fin">FIN</label>
                        <input type="text" placeholder="SD545C" maxlength="7" minlength="6" id="fin" name="fin" disabled>
                    </div> 
                    <div class="form_col">
                        <label class="input_lab" for="payment">Məbləğ <span class='star'>*</span></label>
                        <input step="1" required type="number" id="payment" name="payment" >
                    </div>                
                </div>
                <div class='form_row'>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                        Anonim olaraq ianə etmək (Əgər məlumat sahələrini doldurmaq istəyirsinizsə, qutunun işarəsini çıxarın)
                        </label>
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_col">
                        <input class="submit" type="submit" value="Ödənişə keçmək">
                    </div>
                    <div class="form_col">
                        <p class="not_p">
                            <span class="star">*</span> ilə işarələnmiş sahələr tələb olunur.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>

    </footer>

    <script src="https://unpkg.com/imask"></script>
    <script src="./js/script.js"></script>

</body>
</html>