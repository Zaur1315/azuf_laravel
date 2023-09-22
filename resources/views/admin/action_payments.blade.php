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
                                                <th class="" tabindex="0" rowspan="1" colspan="1">Имя</th>
                                                <th class="" tabindex="0" rowspan="1" colspan="1">Фамилия</th>
                                                <th class="" tabindex="0" rowspan="1" colspan="1">Сумма</th>
                                                <th class="" tabindex="0" rowspan="1" colspan="1">Эмейл</th>
                                                <th class="" tabindex="0" rowspan="1" colspan="1">Телефон</th>
                                                <th class="" tabindex="0" rowspan="1" colspan="1">Фин</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($payments as $payment)
                                                <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">{{$payment->first_name}}</td>
                                                    <td>{{$payment->last_name}}</td>
                                                    <td class="">{{$payment->order_amount}}</td>
                                                    <td class="">{{$payment->customer_email}}</td>
                                                    <td>{{$payment->phone}}</td>
                                                    <td>{{$payment->fin}}</td>
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
