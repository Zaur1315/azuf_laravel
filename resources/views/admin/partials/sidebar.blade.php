<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/img/logo.webp')}}" alt="Admin" class="brand-image-2">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                    @if(auth()->user()->role === 'Admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Пользователи
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                                <li class="nav-item">
                            <div class="dt-buttons btn-group flex-wrap mt-2 w-100">
                                <a class="btn btn-secondary btn-add-page" href="{{route('user.create')}}">
                                    <b class="mr-1">+</b> Добавить пользователя
                                </a>
                            </div>
                        </li>

                        <li class="nav-header mt-2"><h6>Все пользователи:</h6></li>

                        @foreach($users as $user)
                            <li class="nav-item mb-2">
                                <a href="http://localhost/azuf_lar/public/dashboard/edit-user/{{$user->id}}" class="nav-link">
                                    <p>{{$user->name}}</p>
                                </a>
                            </li>
                        @endforeach


                    </ul>
                </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Страницы
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @auth
                            @if(auth()->user()->role === 'Admin')
                                <li class="nav-item">
                                    <div class="dt-buttons btn-group flex-wrap mt-2 w-100">
                                        <a class="btn btn-secondary btn-add-page" href="{{route('admin.create_payment_page')}}">
                                            <b class="mr-1">+</b> Добавить страницу
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @endauth
                        <li class="nav-header mt-2"><h6>Все страницы:</h6></li>
                        @foreach($pages as $page)
                            <li class="nav-item mb-2">
                                <a href="http://localhost/azuf_lar/public/dashboard/edit-payment-page/{{$page->id}}" class="nav-link">
                                    <p>{{$page->subject}}</p>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </li>

            </ul>
        </nav>

        <!-- Sidebar Menu -->
{{--        <nav class="mt-2">--}}
{{--            <div class="dt-buttons btn-group flex-wrap w-100">--}}
{{--                <a class="btn btn-secondary btn-add-page" href="{{route('admin.create_payment_page')}}">--}}
{{--                    <b class="mr-1">+</b> Добавить страницу--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="dt-buttons btn-group flex-wrap mt-2 w-100">--}}
{{--                <a class="btn btn-secondary btn-add-page" href="{{route('user.create')}}">--}}
{{--                    <b class="mr-1">+</b> Добавить пользователя--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </nav>--}}
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
