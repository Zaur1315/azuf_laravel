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
                            <div class="card-header d-flex align-items-center">
                                <div class="card-header__left w-75">
                                    Ссылка страницы оплаты: <a href="http://localhost/azuf_lar/public/{{$page->slug}}">http://localhost/azuf_lar/public/{{$page->slug}}</a>
                                </div>
                                <div class="card-header__rigth w-25">
                                    <a href="{{route('action.list')}}" class="btn btn-primary float-right btn-sm">Назад</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="btn_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="single-payment-table" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
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
    $(document).ready(function() {
        $('#single-payment-table').DataTable({
            processing: true,
            serverSide: true, // Включите серверную пагинацию
            ajax: {
                url: "{{route('payment-pages.payment', ['page' => $page])}}",
                type: 'GET', // HTTP-метод
            },
            columns: [
                { data: "first_name", name:"first_name" },
                { data: "last_name", name:"last_name" },
                { data: "order_amount", name:"order_amount" },
                { data: "customer_email", name:"customer_email"},
                { data: "phone", name:"phone" },
                { data: "fin", name:"fin" },
                { data: "date", name:"date" }
            ],
            "aLengthMenu": [
                [3, 10, 25, 50, 100, -1], // Количество элементов на странице
                [3, 10, 25, 50, 100, "Все"] // Отображаемые значения
            ],
            "language": {
                url: "{{asset('plugins/data-table/ru-lang.json')}}",
            }
        })
    });
</script>

</body>
</html>

