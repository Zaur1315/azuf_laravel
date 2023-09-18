@include('admin.partials.top')

<div class="wrapper">
    <!-- Preloader -->
    @include('admin.partials.preloader')
    <!-- Navbar -->
    @include('admin.partials.header')
    <!-- Main Sidebar Container -->
    @include('admin.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Изменение пользователя {{$userInfo->email}}</h1>
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

                            <form method="POST" action="{{ route('update-user', $userInfo->id ) }}" onsubmit="return confirm('Вы уверены, что хотите сохранить изменения?');">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Ф.И.О</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$userInfo->name}}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group w-75">
                                            <label for="email" >Email</label>
                                            <input id="email" disabled type="email" class="form-control" name="email" value="{{$userInfo->email}}" required autocomplete="email">
                                        </div>
                                        <div class="form-group w-25 ml-3">
                                            <label for="id">ID</label>
                                            <input id="id" disabled type="text" class="form-control" name="id" value="{{$userInfo->id}}" required autocomplete="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Новый пароль</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">Подтверждения пароля</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Тип пользователя</label>
                                        <select id="role" class="form-select custom-select mb-3 role" name="role" required >
                                            <option @if( $userInfo->role = 'User') selected @endif value="User">Пользователь</option>
                                            <option @if( $userInfo->role = 'Admin') selected @endif value="Admin">Администратор</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Изменить пользователя
                                    </button>
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
