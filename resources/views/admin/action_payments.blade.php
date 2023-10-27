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
                        <h1 class="m-0">Панель управления</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('action.list')}}">Список акций</a></li>
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
                            <div class="card-header d-flex align-items-center">
                                <div class="card-header__left w-75">
                                    Ссылка страницы оплаты: <a href="{{route('payment.form')}}/{{$page->slug}}">{{route('payment.form')}}/{{$page->slug}}</a>
                                </div>
                                <div class="dt-buttons btn-group float-right col-4">
                                    <button id="export-csv" class="btn btn-secondary buttons-csv buttons-html5 "
                                            tabindex="0" aria-controls="btn-control" type="button">
                                        <span>CSV</span>
                                    </button>
                                    <button id="export-excel" class="btn btn-secondary buttons-excel buttons-html5 "
                                            tabindex="0" aria-controls="btn-control" type="button">
                                        <span>Excel</span>
                                    </button>
                                    <a href="{{route('action.list')}}"
                                       class="btn btn-primary float-right"><span>Назад</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="btn_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="single-payment-table"
                                               class="table table-bordered table-striped dataTable dtr-inline"
                                               aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Имя</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Фамилия</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Сумма</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Эмейл</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Телефон</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Фин</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Дата</th>
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
    // DataTable Installation
    $(document).ready(function () {
        const table = $('#single-payment-table').DataTable({
            order: [[6, 'desc']],
            processing: true,
            searchDelay: 500,
            serverSide: true, // Включите серверную пагинацию
            ajax: {
                url: "{{route('payment-pages.payment', ['page' => $page])}}",
                type: 'GET', // HTTP-метод
            },
            columns: [
                {data: "first_name", name: "first_name"},
                {data: "last_name", name: "last_name"},
                {data: "order_amount", name: "order_amount"},
                {data: "customer_email", name: "customer_email"},
                {data: "phone", name: "phone"},
                {data: "fin", name: "fin"},
                {data: "date", name: "date"}
            ],
            "aLengthMenu": [
                [2, 10, 25, 50, 100, -1], // Количество элементов на странице
                [2, 10, 25, 50, 100, "Все"] // Отображаемые значения
            ],
            "language": {
                url: "{{asset('plugins/data-table/ru-lang.json')}}",
            }
        })

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
                columnsToExport: ['first_name', 'last_name', 'order_amount', 'customer_email', 'phone', 'fin', 'date'],
                columnHeaders: ['Имя', 'Фамилия', 'Сумма', 'Email', 'Номер телефона', 'Фин', 'Дата'],
                info: 'single_action',
                page: {{$page -> id}}
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `http://localhost/azuf_lar/public/dashboard/export-${data}`,
                method: 'POST',
                data: dataForExport,
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    console.log(dataForExport)
                    console.log('Success', response);
                    const blob = new Blob([response], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "{{$filename}}"+`.${data}`;
                    link.click();
                },
                error: (error) => {
                    console.log(dataForExport)
                    console.error('Error', error);
                }
            })
        }

    });
</script>

</body>
</html>

