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
                        <h1 class="m-0">Создание страницы пожертвования</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Создание страницы пожертвования</li>
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

                            <form action="{{route('payment-pages.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="subject">Заголовок</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Введите заголовок">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Введите дополнительную информацию"></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
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


