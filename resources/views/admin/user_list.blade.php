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


<script>
    $(document).ready(function() {
        $('#users-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('user.list') }}', // Укажите правильный маршрут для получения данных
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                    data: 'role',
                    name: 'role',
                    render: function(data, type, full, meta) {
                        return data === 'Admin' ? 'Администратор' : 'Пользователь';
                    }
                },
                { data: 'created_at', name: 'created_at' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false, // Запрет сортировки этой колонки
                    searchable: false, // Запрет поиска в этой колонке
                    render: function(data, type, full, meta) {
                        // Проверка на администратора и текущего пользователя
                        if (full.role === 'Admin' && {{ auth()->user()->id }} === full.id) {
                            return '<div class="edit_row d-flex"><div class="edit_col"><a href="http://localhost/azuf_lar/public/dashboard/edit-user/' + full.id + '" class="nav-link btn btn-edit btn-primary btn-sm"><i class="nav-icon fas fa-pen"></i></a> </div></div>'
                        } else {
                            return '<div class="edit_row d-flex"><div class="edit_col"><a href="http://localhost/azuf_lar/public/dashboard/edit-user/' + full.id + '" class="nav-link btn btn-edit btn-primary btn-sm"><i class="nav-icon fas fa-pen"></i></a> </div><div class="edit_col"><button href="#" form="destroy-user' + full.id + '" class="nav-link btn btn-sm btn-danger btn-edit"><i class="nav-icon fas fa-times link-danger"></i></button>' + '<form method="POST" action="{{ url('dashboard/delete-user/') }}/' + full.id + '" id="destroy-user' + full.id + '" onsubmit="return confirm(\'Вы уверены, что хотите удалить этого пользователя?\');">@csrf @method('DELETE')</form></div></div>'
                        }
                    }
                }
            ],
            "aLengthMenu": [
                [3, 10, 25, 50, 100, -1], // Количество элементов на странице
                [3, 10, 25, 50, 100, "Все"] // Отображаемые значения
            ],
            "language": {
                url: "{{asset('plugins/data-table/ru-lang.json')}}",
            }
        });
    });
</script>

</body>
</html>

