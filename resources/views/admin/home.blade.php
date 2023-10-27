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
                            <div class="card-header d-flex justify-content-between">
                                <div class="title-col d-flex align-items-center col-10">
                                    <h5 class="m-0">Данные по платежам</h5>
                                </div>
                                <div class="dt-buttons btn-group float-right col-2">
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
                                        <table id="payment-data-table"
                                               class="table table-bordered table-striped dataTable dtr-inline"
                                               aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column="first_name" rowspan="1" colspan="1">Имя
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column='last_name' rowspan="1" colspan="1">Фамилия
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column='order_amount' rowspan="1" colspan="1">Сумма
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column='customer_email' rowspan="1" colspan="1">Эмейл
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column='phone' rowspan="1" colspan="1">Телефон
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none" data-column='fin'
                                                    rowspan="1" colspan="1">Фин
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column='subject' rowspan="1" colspan="1">Подробности
                                                </th>
                                                <th class="sorting" tabindex="0" data-direction="none"
                                                    data-column='date' rowspan="1" colspan="1">Дата
                                                </th>
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
    $(document).ready(function () {
        const home = "{{route('payment.form')}}";
        const table = $('#payment-data-table').DataTable({
            order: [[7, 'desc']],
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
                columnsToExport: ['first_name', 'last_name', 'order_amount', 'customer_email', 'phone', 'fin', 'subject', 'date'],
                columnHeaders: ['Имя', 'Фамилия', 'Сумма', 'Email', 'Телефон', 'Фин', 'Описание', 'Дата'],
                info: 'home',
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `${home}/dashboard/export-${data}`,
                method: 'POST',
                data: dataForExport,
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    const blob = new Blob([response], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "{{$filename}}"+`.${data}`;
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

