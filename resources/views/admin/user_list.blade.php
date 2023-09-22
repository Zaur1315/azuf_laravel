@include('admin.partials.top')

<div class="wrapper">
    <!-- Preloader -->
    @include('admin.partials.preloader')
    <!-- Navbar -->
    @include('admin.partials.header')
    <!-- Main Sidebar Container -->
    @include('admin.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    {{ session('success') }}
    {{ session('error') }}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Список пользователей</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Список пользователей</h3>
                            </div>

                            <div class="card-body">
                                <div id="btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dt-buttons btn-group">
                                                <a href="{{route('user.create')}}" id="btn-add_user" class="btn btn-primary" tabindex="0" aria-controls="btn-control" type="button">
                                                    <span>Добавить нового пользователя</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="users-data-table" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">ID</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Ф.И.О.</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">E-Mail</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Роль</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Дата регистрации</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Управление</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td >{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @if($user->role == 'Admin')
                                                            Администратор
                                                        @else
                                                            Пользователь
                                                        @endif
                                                    </td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td class="d-flex justify-content-between">
                                                        <div class="edit_row d-flex">
                                                            <div class="edit_col"><a href="http://localhost/azuf_lar/public/dashboard/edit-user/{{$user->id}}" class="nav-link btn btn-edit btn-primary btn-sm">
                                                                    <i class="nav-icon fas fa-pen"></i>
                                                                </a></div>
                                                            @if(auth()->user()->id != $user->id)
                                                            <div class="edit_col"><button href="#" form="destroy-user{{$user->id}}" class="nav-link btn btn-sm btn-danger btn-edit">
                                                                    <i class="nav-icon fas fa-times link-danger"></i>
                                                                </button></div>
                                                                <form method="POST" action="{{ route('user.destroy', $user->id) }}" id="destroy-user{{$user->id}}" onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section>

    </div>
    <!-- /.content-wrapper -->
    @include('admin.partials.footer')
</div>
<!-- ./wrapper -->

@include('admin.partials.bottom')
