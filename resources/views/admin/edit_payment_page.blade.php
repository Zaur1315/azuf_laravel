@include('admin.partials.top')

<div class="wrapper">
    <!-- Preloader -->
    @include('admin.partials.preloader')
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
                        <h1 class="m-0">Редактирование страницы пожертвования</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Редактирование страницы пожертвования</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container mt-5 w-50">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Форма для заполнения</h3>
                            </div>

                            <form action="{{route('update-payment-page', $paymentPage->id)}}" method="post" onsubmit="return confirm('Вы уверены, что хотите сохранить изменения?');">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="subject">Заголовок</label>
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{$paymentPage->subject}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Введите дополнительную информацию">{{$paymentPage->description}}</textarea>
                                    </div>
                                    <div class="date-row d-flex justify-content-between" >
                                        <div class="form-group w-50">
                                            <label for="show">Активно</label>
                                            <input type="checkbox" class="custom-control custom-checkbox" name="show" id="show" @if($paymentPage->show) checked @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="created_at">Дата создания</label>
                                            <input type="text" class="form-control" name="created_at" id="created_at" value="{{$paymentPage->created_at}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="updated_at">Дата изменения</label>
                                            <input type="text" class="form-control" name="updated_at" id="updated_at" value="{{$paymentPage->updated_at}}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                    <a href="{{route('admin.home')}}" class="btn btn-secondary">Назад</a>

                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!-- Main content -->

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.partials.footer')

    <!-- ./wrapper -->
</div>
@include('admin.partials.bottom')



</body>
</html>

