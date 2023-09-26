<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Server Side Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
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
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('test.index') }}",
            columns: [
                { data: "first_name", name:"first_name" },
                { data: "last_name", name:"last_name" },
                { data: "order_amount", name:"order_amount" },
                { data: "customer_email", name:"customer_email"},
                { data: "phone", name:"phone" },
                { data: "fin", name:"fin" },
                { data: "subject", name:"subject" }
            ],
            "aLengthMenu": [
                [3, 10, 25, 50, 100, -1], // Количество элементов на странице
                [3, 10, 25, 50, 100, "Все"] // Отображаемые значения
            ],
        });
    });
</script>
</html>
