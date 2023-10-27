<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.home')}}" class="nav-link">Главная</a>
        </li>
        @auth()
            @if(auth()->user()->role === 'Admin')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('user.list')}}" class="nav-link">Пользователи</a>
            </li>
            @endif
        @endauth
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('action.list')}}" class="nav-link">Акции</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="row-user d-flex align-items-center justify-content-center">
                <div class="col user-info">
                    <a href="{{route('profile.edit')}}">{{$user}}</a>
                </div>
                <div class="col user-logout">
                    <form id="logout-form" action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Выйти</button>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>


