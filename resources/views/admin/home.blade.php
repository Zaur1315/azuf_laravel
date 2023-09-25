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
                                    <div class="filter">
                                        <input type="text" id="filter" class="filter">
                                    </div>
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
                                                </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                @foreach($data as $item)
                                                <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">{{$item->first_name}}</td>
                                                    <td>{{$item->last_name}}</td>
                                                    <td class="">{{$item->order_amount}}</td>
                                                    <td class="">{{$item->customer_email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->fin}}</td>
                                                    <td>{{$item->subject}}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    <div class="col-12 mt-3">
                                        {{$data->links()}}
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
