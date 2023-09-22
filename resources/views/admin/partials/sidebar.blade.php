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

                            <li class="nav-item mt-2 mb-2">
                                <a href="{{route('user.list')}}" class="nav-link text-center">
                                    <p>Все пользователи</p>
                                </a>
                            </li>
                    </ul>
                </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Акции
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @auth
                            @if(auth()->user()->role === 'Admin')
                                <li class="nav-item">
                                    <div class="dt-buttons btn-group flex-wrap mt-2 w-100">
                                        <a class="btn btn-secondary btn-add-page" href="{{route('admin.create_payment_page')}}">
                                            <b class="mr-1">+</b> Добавить акцию
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @endauth
                            <li class="nav-item mt-2 mb-2">
                                <a href="{{route('action.list')}}" class="nav-link text-center">
                                    <p>Все акции</p>
                                </a>
                            </li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
