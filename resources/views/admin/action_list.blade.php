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
                            <li class="breadcrumb-item active">Список акций благотварительности</li>
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
                                <h3 class="card-title">Список акций благотварительности</h3>
                            </div>

                            <div class="card-body">
                                <div id="btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dt-buttons btn-group">
                                                <a href="{{route('admin.create_payment_page')}}" id="btn-add_user" class="btn btn-primary" tabindex="0" aria-controls="btn-control" type="button">
                                                    <span>Добавить акцию</span>
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
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Тема</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Описание</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Дата создания</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Ссылка</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Активно</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Управление</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($actions as $action)
                                                <tr>
                                                    <td >{{$action->id}}</td>
                                                    <td>{{$action->subject}}</td>
                                                    <td>{{$action->description}}</td>
                                                    <td>{{$action->created_at}}</td>
                                                    <td>{{$action->slug}}</td>
                                                    <td>
                                                        @if($action->show == 1)
                                                            Да
                                                        @else
                                                            Нет
                                                        @endif
                                                    </td>
                                                    <td class="d-flex justify-content-between">
                                                        <div class="edit_row d-flex">
                                                            <div class="edit_col"><a href="http://localhost/azuf_lar/public/dashboard/edit-payment-page/{{$action->id}}" class="nav-link btn btn-edit btn-primary btn-sm">
                                                                    <i class="nav-icon fas fa-pen"></i>
                                                                </a></div>
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
