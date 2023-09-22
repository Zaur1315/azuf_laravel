@include('admin.partials.top')

<div class="wrapper">
    <!-- Preloader -->
    @include('admin.partials.preloader')
    <!-- Navbar -->
    @include('admin.partials.header')
    <!-- Main Sidebar Container -->
    @include('admin.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->

    {{session('success')}}
    {{session('error')}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Профиль {{$user->email}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Изменение пользователя</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container mt-5 form-wrap-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Форма для заполнения</h3>
                            </div>

                            <form method="POST" action="{{ route('profile.update') }}" onsubmit="return confirm('Вы уверены, что хотите сохранить изменения?');">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Ф.И.О</label>
                                        <input id="name" disabled type="text" class="form-control" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" >Email</label>
                                        <input id="email" disabled type="email" class="form-control" name="email" value="{{$user->email}}" required autocomplete="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Новый пароль</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Подтверждения пароля</label>
                                        <input id="password_confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить изменения
                                    </button>
                                    <a href="{{route('admin.home')}}" class="btn btn-secondary">Назад</a>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!-- Main content -->

        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->
    @include('admin.partials.footer')

    <!-- ./wrapper -->

@include('admin.partials.bottom')
