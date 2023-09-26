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
    $(document).ready(function() {
        var table = $('#users-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('action.list') }}', // Обновите маршрут, если это необходимо
                type: 'GET'
            },
            columns: [
                { "data": "id" },
                {
                    // Столбец с ссылкой
                    "data": null,
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            return '<a href="' + data.payment_link + '">' + data.subject + '</a>';
                        }
                        return data.subject;
                    }
                },
                { "data": "description" },
                {
                    data: 'created_at', // Поле с датой
                    name: 'created_at',
                    render: function(data, type, full, meta) {
                        // Форматируем дату с помощью JavaScript (можно использовать любую библиотеку для форматирования даты)
                        let formattedDate = moment(data).format('YYYY-MM-DD HH:mm:ss'); // Используем Moment.js для форматирования
                        return formattedDate;
                    }
                },
                { "data": "slug" },
                {
                    "data": "show",
                    "render": function(data, type, row) {
                        return data == 1 ? 'Да' : 'Нет';
                    }
                },
                {
                    // Столбец с кнопкой "Редактировать"
                    "data": null,
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            return '<a href="http://localhost/azuf_lar/public/dashboard/edit-payment-page/' + data.id + '" class="nav-link btn btn-edit btn-primary btn-sm"><i class="nav-icon fas fa-pen"></i></a>';
                        }
                        return data.id;
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
            // Остальные настройки DataTables
        });
    });
</script>

</body>
</html>

