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
                        <h1 class="m-0">Панель управления</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Панель управления</li>
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
                                <h3 class="card-title">Данные по платежам</h3>
                            </div>

                            <div class="card-body">
                                <div id="btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dt-buttons btn-group">
                                                <button id="btn-csv" class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="btn-control" type="button">
                                                    <span>CSV</span>
                                                </button>
                                                <button id="btn-excel" class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="btn-control" type="button">
                                                    <span>Excel</span>
                                                </button>
                                                <button id="btn-pdf" class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="btn-control" type="button">
                                                    <span>PDF</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                <div class="row">
                                        <div class="col-sm-12">
                                            <table id="payment-data-table" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                                <thead>
                                                <tr>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column="first_name" rowspan="1" colspan="1">Имя</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='last_name' rowspan="1" colspan="1">Фамилия</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='order_amount' rowspan="1" colspan="1">Сумма</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='customer_email' rowspan="1" colspan="1">Эмейл</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='phone' rowspan="1" colspan="1">Телефон</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='fin' rowspan="1" colspan="1">Фин</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='subject' rowspan="1" colspan="1">Подробности</th>
                                                    <th class="sorting" tabindex="0" data-direction="none" data-column='date' rowspan="1" colspan="1">Дата</th>
                                                </tr>
                                                </thead>
                                                <tbody id="table-body">
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
        $('#payment-data-table').DataTable({
            processing: true,
            serverSide: true, // Включите серверную пагинацию
            ajax: {
                url: "{{route('admin.home')}}", // URL-адрес серверного эндпоинта
                type: 'GET', // HTTP-метод
            },
            columns: [
                {data: "first_name", name: "first_name"},
                {data: "last_name", name: "last_name"},
                {data: "order_amount", name: "order_amount"},
                {data: "customer_email", name: "customer_email"},
                {data: "phone", name: "phone"},
                {data: "fin", name: "fin"},
                {data: "subject", name: "subject"},
                {data: "date", name: "date"}
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

