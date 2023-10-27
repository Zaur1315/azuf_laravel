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
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Главная</a></li>
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
                            <div class="card-header d-flex justify-content-between">
                                <div class="title-col d-flex align-items-center col-6">
                                    <h5 class="m-0">Список пользователей</h5>
                                </div>

                                <div class="dt-buttons btn-group float-right col-6">
                                    <a href="{{route('user.create')}}" id="btn-add_user" class="btn btn-primary"
                                       tabindex="0" aria-controls="btn-control" type="button">
                                        <span>Добавить нового пользователя</span>
                                    </a>
                                    <button id="export-csv" class="btn btn-secondary buttons-csv buttons-html5 "
                                            tabindex="0" aria-controls="btn-control" type="button">
                                        <span>CSV</span>
                                    </button>
                                    <button id="export-excel" class="btn btn-secondary buttons-excel buttons-html5 "
                                            tabindex="0" aria-controls="btn-control" type="button">
                                        <span>Excel</span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="users-data-table"
                                               class="table table-bordered table-striped dataTable dtr-inline"
                                               aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">ID</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Ф.И.О.
                                                </th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">E-Mail
                                                </th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Роль</th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">Дата
                                                    регистрации
                                                </th>
                                                <th class="user-sorting" tabindex="0" rowspan="1" colspan="1">
                                                    Управление
                                                </th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function () {
        const home = "{{route('payment.form')}}";
        const doc_xlsx = 'generated_document'
        const table = $('#users-data-table').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: '{{ route('user.list') }}',
                type: 'GET'
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {
                    data: 'role',
                    name: 'role',
                    render: function (data, type, full, meta) {
                        return data === 'Admin' ? 'Администратор' : 'Пользователь';
                    }
                },
                {
                    data: 'created_at', // Поле с датой
                    name: 'created_at',
                    render: function (data, type, full, meta) {
                         // Используем Moment.js для форматирования
                        return moment(data).format('YYYY-MM-DD HH:mm');
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        if (full.role === 'Admin' && {{ auth()->user()->id }} === full.id) {
                            return '<div class="edit_row d-flex"><div class="edit_col"><a href="' + home + '/dashboard/user/edit-user/' + full.id + '" class="nav-link btn btn-edit btn-primary btn-sm"><i class="nav-icon fas fa-pen"></i></a> </div></div>'
                        } else {
                            return '<div class="edit_row d-flex"><div class="edit_col"><a href="' + home + '/dashboard/user/edit-user/' + full.id + '" class="nav-link btn btn-edit btn-primary btn-sm"><i class="nav-icon fas fa-pen"></i></a> </div><div class="edit_col"><button href="#" form="destroy-user' + full.id + '" class="nav-link btn btn-sm btn-danger btn-edit"><i class="nav-icon fas fa-times link-danger"></i></button>' + '<form method="POST" action="{{ url('dashboard/user/delete-user/') }}/' + full.id + '" id="destroy-user' + full.id + '" onsubmit="return confirm(\'Вы уверены, что хотите удалить этого пользователя?\');">@csrf @method('DELETE')</form></div></div>'
                        }
                    }
                }
            ],
            "aLengthMenu": [
                [3, 10, 25, 50, 100, -1],
                [3, 10, 25, 50, 100, "Все"]
            ],
            "language": {
                url: "{{asset('plugins/data-table/ru-lang.json')}}",
            }
        });

        // Обработчик для кнопки экспорта в Excel
        $('#export-excel').on('click', function () {
            exportData('xlsx');
        });

        // Обработчик для кнопки экспорта в CSV
        $('#export-csv').on('click', function () {
            exportData('csv');
        });


        let exportData = (data) => {
            let dataForExport = {
                type: data,
                col: table.order()[0][0],
                sort: table.order()[0][1],
                search: table.search(),
                columnsToExport: ['id', 'name', 'email', 'role', 'created_at'],
                columnHeaders: ['ID', 'Ф.И.О.', 'Email', 'Роль', 'Дата регистрации'],
                info: 'users',
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: home + `/dashboard/export-${data}`,
                method: 'POST',
                data: dataForExport,
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    const blob = new Blob([response], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "{{$filename}}" + `.${data}`;
                    link.click();
                },
                error: (error) => {
                    console.error('Error', error);
                }
            })
        }

    });
</script>

</body>
</html>

