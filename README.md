<p align="center"><img src="./public/img/logo.webp" width="200" alt="Laravel Logo"></p>


# Описание проекта

Данный проект создан для облегченного управления пожертвованиями. Он включает в себя __следующие возможности__:

- [Пользовательская часть](#client).
  - [Страница, для отображения всех активных акций пожетвования](#home).
  - [Динамическая страница с формой оплаты](#payment-page).
  - [Страницы сообщающие о статусе операции](#status-page).
  - [Страницы ошибок (403, 404, 500)](#errors).
  - [Страница входа в административную панель](#login).
- [Панель администраторов](#dashboard).
    - [Страницы доступные всем пользователям](#user-pages).
        - [Главная страница административной панели](#dashboard-home).
        - [Страница списка акций пожертвования](#action-list).
        - [Страница списка пожертвований по конкретной акции](#action-payment).
        - [Страница смены пароля пользователя](#change-pass).
    - [Страницы доступные только администраторам](#admin-pages).
        - [Страница создания новой акции пожертвования](#new-action).   
        - [Страница редактирования акции пожертвования](#edit-action).   
        - [Страница списка всех пользователей](#user-list).   
        - [Страница редактирования пользователя](#user-edit).   

Ниже описаны __структура__ и __функционал__ приложения:
    
- [Контроллеры](#controllers)
    - [AdminController](#AdminController)
    - [ExportController](#ExportController)
    - [LocalizationController](#LocalizationController)
    - [PageController](#PageController)
    - [PaymentPageController](#PaymentPageController)
    - [UserInfoController](#UserInfoController)
    - [UserLoginController](#UserLoginController)
- [Промежуточное ПО (Middleware)](#middleware)
    - [AdminMiddleware](#AdminMiddleware) 
- [Дополнительные правила валидации](#rules)
    - [UniqueEmail](#UniqueEmail)
- [Модели](#Models)
    - [DBdata](#DBdata)
    - [PaymentPage](#PaymentPage)
    - [User](#User)
- [Библиотеки PHP](#phplib)
    - [DataTables](#datatables) 
    - [PhpOffice](#PhpOffice)
- [Библиотеки Fron-End](#jslib)
    - [Bootstrap 5](#Bootstrap)
    - [JQuery](#jq)
    - [Font Awesome](#fontawesome)
    - [IMask JS](#imask)
    - [Moment JS](#moment)
    - [DataTables](#DataTables)
    - [Toastr](#toastr)
- [Запуск проекта](#deploy) 
    - [Запуск на хостинге](#hosting)
    - [Деплой на сервер](#server)

## Пользовательская часть <span id='client'></span>

Пользовательская часть состоит из нескольких страниц, необходимых для просмотра и проведения оплаты. Все страницы, доступные гостям приложения доступны на 3-х языках (Азербайджанский, Русский и Английский).

Для мультиязычности используются инструменты Laravel.

Используется контроллер [LocalizationController.php](#LocalizationController), а так же словари, расположенные в директории _resources/lang._

 - ### Страница, для отображения всех активных акций пожетвования <span id='home'></span>

Является главной страницей. На данной странице отображается динамический список всех доступных пожертвований. Можно выбрать любую и перейти на страницу оплаты. 

Использует шаблон __main.blade.php__, контроллер [PageController.php](#PageController).


 - ### Динамическая страница с формой оплаты <span id='payment-page'></span>

Динамическая страница платежной формы. С этой страницы данные отправляются к API Xezine ( подробнее про интеграцию [тут](https://docs.exezine.az/checkout_integration) ).

Обязательным является поле Сумма. Остальные поля можно оставить пустыми, при желании совершить пожертвование анонимно.

Использует шаблон __show.blade.php__, контроллер [PageController.php](#PageController).

 - ### Страницы сообщающие о статусе операции <span id='status-page'></span>

Статичные страницы, отображающие то, как завершилась операция (Успех или ошибка).

Используются шаблоны __success.blade.php__ и __cancel.blade.php__, контроллер [PageController.php](#PageController).

 - ### Страницы ошибок (403, 404, 500) <span id='errors'></span>

Статичные страницы ошибок, которые может увидеть пользователь при каких либо неполадках.

`403` - Ошибка, означающая, что у пользователя не достаточно прав доступа к данный станице.

`404` - Ошибка, означающая, что данная страница не существует.

`500` - Серверная ошибка, означающая неполадку в системе. Более подробно можно узнать о причине посмотрев в логи приложения.

Используются шаблоны из директории _resources/views/errors_: __403.blade.php__, __404.blade.php__, __500.blade.php__.

- ### Страница входа в административную панель <span id='login'></span>

Страница для входа в систему как пользователь или как администратор. 

Используется инструменты входа Laravel и шаблон из директории _resources/views/auth_: __login.blade.php__.

## Панель администраторов <span id='dashboard'></span>

Административная панель предлагает возможности просмотра, создания, редактирования, удаления(отключения) акций пожертвования и пользователей. Все данные доступны в виде фильтруемой таблицы с данными. Так же для каждой таблицы присутствует возможность экспорта отфильтрованных данных в Excel или CSV. 

Для фильтрации колонок как на сервере, так и на клиенте используется плагин [DataTables](#datatables). Так же используется контроллер [AdminController.php](#AdminController).

Для отображения используются шаблоны из директории _resources/views/admin_.

Для экспорта данных используется контроллер [ExportController.php](#ExportController).

### Страницы доступные всем пользователям <span id='user-pages'></span>
 - ### Главная страница административной панели <span id='dashboard-home'></span>
На данной странице отображаются все платежи, по всем категориям, за весь период времени работы приложения.

Для отображения используется шаблон __home.blade.php__ и контроллер [AdminController.php](#AdminController). 

 - ### Страница списка акций пожертвования <span id='action-list'></span>
На данной странице отображается список всех акций пожертвования. В правой колонке каждой акции есть 2 кнопки. Одна дает возможность отредактировать саму акцию, вторая позволяет перейти к данной акции, чтобы просмотреть пожертвования, относящиеся к ней.

Для отображения используется шаблон __action_list.blade.php__ и контроллер [AdminController.php](#AdminController).

- ### Страница списка пожертвований по конкретной акции <span id='action-payment'></span>
На данной странице отображается список пожертвований по конкретной акции пожертвования, а так же ссылка на страницу оплаты.

Для отображения используется шаблон __action_payments.blade.php__ и контроллер [PaymentPageController.php](#PaymentPageController).

- ### Страница смены пароля пользователя <span id='change-pass'></span>
На данной странице отображаются данные самого пользователя. Так же присутствует возможность смены пароля учетной записи.

Для отображения используется шаблон __profile.blade.php__ и контроллер [AdminController.php](#AdminController).

### Страницы доступные только администраторам <span id='admin-pages'></span>
- ### Страница создания новой акции пожертвования <span id='new-action'></span>
На данной странице отображается форма для создания новой акции пожертвования. После заполнения, акция попадает в базу данных, и далее отображается в списке всех акций и на главной странице приложения.

Для отображения используется шаблон __create_payment_page.blade.php__ и контроллер [AdminController.php](#AdminController).

- ### Страница редактирования акции пожертвования <span id='edit-action'></span>
На данной странице отображается форма с данными выбранной акции пожертвования, которые можно изменить. Так же отображается дата создания и изменения данной акции. Присутствует возможность деактивировать акцию. В таком случае она так же будет отображаться в списке акций на странице "Все акции", но исчезнет с главной страницы. Деактивированную акцию можно активировать в любой момент.

Для отображения используется шаблон __edit_payment_page.blade.php__ и контроллер [AdminController.php](#AdminController).

- ### Страница списка всех пользователей <span id='user-list'></span>
На данной странице отображается таблице со всеми зарегистрированными пользователями. В правой колонке отображаются кнопки редактирования и удаления пользователя.

Для отображения используется шаблон __user_list.blade.php__ и контроллер [UserInfoController.php](#UserInfoController).

- ### Страница редактирования пользователя <span id='user-edit'></span>
На данной странице отображается форма с данными пользователя. Можно изменить Ф.И.О., пароль, а так же поменять роль пользователя в системе. Так же можно удалить пользователя. 

Для отображения используется шаблон __edit_user.blade.php__ и контроллер [UserInfoController.php](#UserInfoController).

<br><br>

## Контроллеры <span id='controllers'></span>

- ### AdminController <span id='AdminController'></span>
Включает в себя следующие методы:

__adminHome__ - Отвечает за отображение главной страницы административной панели. Использует библиотеку DataTables. Получает данные по Ajax запросу с клиента из модели [DBdata](#DBdata) и передает их в вид __action_list__.

__createPaymentPage__ - Отвечает за отображение страницы создания акции пожертвования. Возвращает вид __create_payment_page__.

__store__ - Отвечает за сохранение страницы пожертвования. 

__editPaymentPage__ - Отвечает за отображение страницы акции пожертвования. Возвращает вид __edit_payment_page__.

__updatePaymentPage__ - Отвечает за сохранение измененных данных акции пожертвования. После совершает перенаправление назад к списку акций.

- ### ExportController <span id='ExportController'></span>
Включает в себя следующие методы:

__exportCSV__ - Принимает с клиента параметры сортировки таблицы. Далее извлекает необходимые данные из базы, применяя полученную сортировку. После чего экспортирует эти данные в CSV файл и посылает обратно на клиент для скачивания.  

__exportXLSX__ - Принимает с клиента параметры сортировки таблицы. Далее извлекает необходимые данные из базы, применяя полученную сортировку. После чего экспортирует эти данные в XSLX файл, используя библиотеку PhpSpreadsheet и посылает обратно на клиент для скачивания.
- ### LocalizationController <span id='LocalizationController'></span>
Включает в себя следующие методы:

__setLocale__ - Отвечает за изменение языка приложения при переключении локали. Записывает в сессию переменную со значением необходимой локали.

- ### PageController <span id='PageController'></span>
Включает в себя следующие методы:

__showFirstPage__ - Отвечает за отображение главной страницы. Получает из модели PaymentPage необходимое для отображения количество элементов. Возвращает вид __main__.

__showPage__ - Отвечает за отображение страницы с формой пожертвования. На данной странице собираются данные, которые позже будут отправлены к API Xezine. Возвращает вид __show__.

__processPayment__ - Отвечает за обработку собранных с формы данных и дальнейшей отправке к API. Имеет внутри себя функцию __name_to_string__, которая служит для транслитерации кириллицы и обрезки спецсимволов перед передачей данных в платежный шлюз. Далее данные подставляются к необходимым ключам. Если пользователь решает совершить пожертвование анонимно, то вместо имени, фамилии, Фин кода, эмейла и номера будет подставляться значение "Anonim". Так же некоторые параметры будут передаваться не под своими ключами. Это вынужденная мера, для того чтоб получать данные значения Call-back-ом для дальнейшей обработки. Ниже приведены данные поля:

1. `state`: Имя,
2. `city`: Фамилия,
3. `address`: Номер телефона,
4. `zip`: Фин код,

Ключ `order_number` формируется путем конкатенации значений `azuf_` + хешированное значение произвольной цифры из 10ти знаков + `_ID акции пожертвования`.

Если данные собраны корректно, то после отправки данных шлюз возвращает ссылку на страницу оплаты, на которое происходит перенаправление.

__successOperation__ - Отвечает за отображение страницы, которая сообщает об удачной операции. Возвращает вид __success__.

__cancelOperation__ - Отвечает за отображение страницы, которая сообщает об неудачной операции. Возвращает вид __cancel__.

__handleNotification__ - Данный метод получает Call-back от API Xezine. Если статус транзакции `success`, то из полученных данных извлекаются необходимые. Далее данные записываются в необходимую таблицу базы данных. 

- ### PaymentPageController <span id='PaymentPageController'></span>
Включает в себя следующие методы:

__showPayments__ - Отвечает за отображение платежей по категории. Получает эти данные из модели [DBdata](#DBdata) и отображает с необходимой сортировкой. Использует библиотеку [DataTables](https://datatables.net/).

- ### UserInfoController <span id='UserInfoController'></span>
Включает в себя следующие методы:

__index__ - Отвечает за получаение из модели [User](#User) необходимые значения и придерживаясь необходимой сортировки, используя [DataTables](#datatables). Возвращает вид __user_list__.

__editUser__ - Возвращает вид __edit_user__, передавая в него данные выбранного пользователя.

__updateUser__ - Сохраняет в базу внесенные изменения. 

__profileEdit__ - Возвращает вид __profile__, где пользователь может поменять пароль. 

__profileUpdate__ - Сохраняет новый пароль пользователя.

__create__ - Возвращает вид __create_user__, показывая страницу для создания нового пользователя.

__store__ - Сохраняет нового пользователя в базу данных.

__destroy__ - Реализет Soft delete пользователей инструментами Laravel. Пользователь не удаляется из базы, но деактивируется. Удаленный пользователь не может зайти в систему и его не видно в таблице пользователей.

__deletedUser__ - Возвращает вид __restore_user__, если будет сделана попытка зарегистрировать пользователя, который был удален ранее. 

__restore__ - Вновь активирует пользователя, который был удален ранее. 

- ### UserLoginController <span id='UserLoginController'></span>
Включает в себя следующие методы:

__loginPage__ - Возвращает вид __login__ для входа пользователей и администраторов.


<br><br>
## Промежуточное ПО (Middleware) <span id='middleware'></span>
 
- ### AdminMiddleware <span id='AdminMiddleware'></span>

Служит для проверки роли пользователя в Административной панели. При попытке зайти на страницу, доступную только Администраторам, рядовой пользователь будет получать ошибку `403`.


<br><br>
## Дополнительные правила валидации <span id='rules'></span>
- ### UniqueEmail <span id='UniqueEmail'></span>
Дополнительное правило валидации. Проверяет уникальность email, игнорируя удаленных пользователей.

<br><br>
## Модели <span id='Models'></span>
- ### DBdata <span id='DBdata'></span>
Модель совершенных транзакций. Служит для показа и записи транзакций базу.
- ### PaymentPage <span id='PaymentPage'></span>
Модель категорий. Отвечает за созданные категории акций пожертвования. Имеет связь `HasMany` с моделью DBdata.
- ### User <span id='User'></span>
Модель учетных записей. В нее осуществляется запись новых пользователей. Так же по ней происходит проверка во время авторизации.


<br><br>
## Библиотеки PHP <span id='phplib'></span>
- ### DataTables <span id='datatables'></span>
Библиотека используется для обработки серверной работы плагина [JQuery DataTables](http://datatables.net/). Подробнее про библиотеку [тут](https://yajrabox.com/docs/laravel-datatables/10.0).
- ### PhpOffice <span id='PhpOffice'></span>
Библиотека используется для экспорта данных из таблиц в файл XLSX. Подробнее про библиотеку [тут](https://phpspreadsheet.readthedocs.io/en/latest/).

<br><br>
## Библиотеки Front-End <span id='jslib'></span>
- ### Bootstrap 5 <span id='Bootstrap'></span>
Популярная Front-end библиотека готовых стилей. Подробнее [тут](https://getbootstrap.com/).
- ### JQuery <span id='jq'></span>
Многофункциональная библиотека JS. Используется для облегчения писания кода. Так же используется для правильной работы многих плагинов. Подробнее [тут](https://jquery.com/).
- ### Font Awesome <span id='fontawesome'></span>
Популярная библиотека готовых иконок.
- ### IMask JS <span id='imask'></span>
Библиотека, используемая для создания масок для полей ввода текста. Подробнее [тут](https://imask.js.org/). 
- ### Moment JS <span id='moment'></span>
Библиотека, используемая для приведения дат к необходимому формату. Подробнее [тут](https://momentjs.com/).
- ### DataTables <span id='DataTables'></span>
Плагин для создания гибких, фильтруемых таблиц. Настройка данного плагина происходит в скрипте, вызываемом внизу каждого шаблона с таблицей. Плагин мультиязычный. Перевод на необходимый язык происходит путем подключения `.json` файла с переводом, скачанного с [сайта библиотеки](https://datatables.net/).
- ### Toastr <span id='toastr'></span>
Библиотека для создания красивых всплывающих уведомлений. В данном приложении используется для показа сообщений, переданных в сессии. Подробнее [тут](https://codeseven.github.io/toastr/).


<br><br>
## Запуск проекта <span id='deploy'></span>
- ### Запуск на хостинге <span id='hosting'></span>
    - Подготовить хостинг и домен.
    - Создать базу данных.
    - Импортировать в нее дамп из директории database/dump.
    - Загрузить все файлы приложения на хостинг.
    - В файле .env поменять конфигурацию в следующих пунктах:
        - `APP_NAME` = Название проекта.
        - `APP_ENV` = Среда окружения приложения. Изначальное значение __local__. При запуске готового приложения поменять на __production__.
        - `APP_DEBUG` = Режим отладки. По умолчанию стоит значение __true__. При запуске готового приложения установить __false__.
        - `PAYMENT_URL` = URL платежного шлюза API Xezine.
        - `MERCHANT_KEY` = Ключ мерчанта. По умолчанию стоит тестовый. Нужно заменить на реальный.
        - `MERCHANT_PASS` = Пароль мерчанта. По умолчанию стоит тестовый. Нужно заменить на реальный.
        - `DB_CONNECTION` = По умолчанию стоит mysql. Не менять, если нет необходимости.
        - `DB_HOST` = Хост базы данных. Не менять, если нет необходимости.
        - `DB_PORT` = Порт базы данных. Не менять, если нет необходимости.
        - `DB_DATABASE` = Имя базы данных.
        - `DB_USERNAME` = Имя пользователя базы данных. У пользователя должны быть привилегии, позволяющие создавать, редактировать, удалять записи.
        - `DB_PASSWORD` = Пароль пользователя базы данных.
        - Проверить работу всего приложения.
        - Если приложение будет доступно не по __`httрs://дoмен.com/`__, а по __`httрs://дoмен.com/public`__, необходимо создать в корне приложения файл .htaccess и записать в него следующее:

              <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteRule ^(.*)$ public/$1 [L]
              </IfModule>
- ### Деплой на сервер <span id='server'></span>
  * #### Клонирование приложения:
    __1.__ Установить __Git__ на сервер.
  
    __2.__  Клонировать репозиторий с помощью `git clone` на сервер.

  * #### Установка зависимостей:
    __1.__ Перейдите в корневую папку проекта и выполните `composer install`, чтобы установить PHP- зависимости.
    
    __2.__ После выполните команду `npm install`, чтобы установить JS-зависимости.
  * #### Конфигурация .env:

    __1.__ Создайте файл `.env` на сервере и сконфигурируйте его с настройками базы данных, ключами и другими конфигурациями, необходимыми для проекта.
  * #### Настройка веб-сервера:
    __1.__ Настройте веб-сервер (чаще всего используется Nginx или Apache) для обслуживания вашего проекта. Создайте виртуальный хост (Nginx) или хост-файл (Apache), чтобы связать ваш домен с папкой проекта.
  * #### Настройка базы данных:
    __1.__ Создайте базу данных на сервере, если она еще не создана.
    
    __2.__ Выполните миграции с помощью команды `php artisan migrate`, чтобы создать необходимые таблицы в базе данных. 
  *  #### Оптимизация производительности:
    __1.__ Выполните команды `php artisan config:cache` и `php artisan route:cache` для оптимизации конфигурации и маршрутов.
  *  #### Тестирование приложения:
    __1.__ Протестируйте весь функционал приложения, чтобы убедиться, что все работает так, как должно.

  


