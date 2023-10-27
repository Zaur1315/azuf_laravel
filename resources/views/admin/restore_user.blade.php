{{ session('error') }}
@include('admin.partials.top')

<div class="wrapper">
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
                        <h1 class="m-0">Востановление пользователя</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user.list')}}">Список пользователей</a></li>
                            <li class="breadcrumb-item active">Востановление пользователя</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Сообщение о восстановлении пользователя</div>

                            <div class="card-body">
                                <p>Пользователь {{$user->email}} был удален ранее. Хотите ли вы восстановить его?</p>
                                <div class="btns d-flex">
                                    <form method="POST" action="{{ route('user.restore', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Восстановить</button>
                                    </form>
                                    <a href="{{ route('user.list') }}" class="btn btn-secondary ml-2">Назад</a>
                                </div>

                            </div>
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
</div>
@include('admin.partials.bottom')


</body>
</html>


