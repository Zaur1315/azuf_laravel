//DataTable Installation
// $(document).ready(function() {
//     $('#payment-data-table').DataTable({
//         "aLengthMenu": [
//             [10, 25, 50, 100, -1], // Количество элементов на странице
//             [10, 25, 50, 100, "Все"] // Отображаемые значения
//         ],
//         "language": {
//         url: 'plugins/data-table/ru-lang.json',
//         // Другие настройки и опции DataTables...
//     }});
// });

$(document).ready(function () {
    // Обработка события клика по заголовку колонки

    let currentColumn = null;
    let currentDirection = null;

    $('#payment-data-table th').on('click', function () {
        const column = $(this).data('column');
        let direction = $(this).data('direction');

        currentColumn = column;
        currentDirection = currentDirection === 'asc' ? 'desc' : 'asc';

        $(this).data('direction', direction);

        // Отправка AJAX-запроса для сортировки и фильтрации
        $.ajax({
            url: 'http://localhost/azuf_lar/public/admin/data',
            type: 'GET',
            data: {
                sort: column,
                direction: currentDirection,
                filter: $('#filter').val()
            },
            success: function (data) {
                console.log(data.data)
                console.log(currentDirection)
                $('#table-body').empty();

                data.data.forEach(function (item) {

                    const first_name = item.first_name,
                          last_name = item.last_name,
                          order_amount = item.order_amount,
                          customer_email = item.customer_email,
                          phone = item.phone,
                          fin = item.fin,
                          subject = item.subject;

                    const tableRow = $('<tr>');
                    tableRow.append(`<td>${first_name}</td>`);
                    tableRow.append(`<td>${last_name}</td>`);
                    tableRow.append(`<td>${order_amount}</td>`);
                    tableRow.append(`<td>${customer_email}</td>`);
                    tableRow.append(`<td>${phone}</td>`);
                    tableRow.append(`<td>${fin}</td>`);
                    tableRow.append(`<td>${subject}</td>`);

                    $('#table-body').append(tableRow);
                });
                updateSortingLinks(currentColumn, currentDirection)
            },
            error: function (error){
                console.log('Error:', error);
            }
        });

        function updateSortingLinks(column, direction){
            $('#payment-data-table th').each(function () {
                const col = $(this).data('column');
                const dir = $(this).data('direction');

                // Установите активное состояние для выбранного столбца
                if (col === column) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }

                // Установите направление сортировки
                if (col === column) {
                    $(this).data('direction', direction);
                } else {
                    $(this).data('direction', 'asc'); // Сбросите направление для других столбцов
                }
            });
        }
    });

    // Обработка события изменения фильтра
    $('#filter').on('input', function () {
        // Отправка AJAX-запроса при изменении фильтра
        $.ajax({
            url: 'http://localhost/azuf_lar/public/admin/data',
            type: 'GET',
            data: {
                sort: $('#payment-data-table th.asc, #payment-data-table th.desc').data('column'),
                filter: $(this).val()
            },
            success: function (data) {
                // Обновление таблицы с новыми данными
              console.log(data);
                // data содержит новые отфильтрованные и отсортированные данные
            },
            error: function (error){
                console.log('Error:', error);
            }
        });
    });

});


//PDF Export
$(document).ready(function () {
    $('#btn-pdf').click(function () {
        let data = [];
        $('#payment-data-table tbody tr').each(function () {
            let rowData = [];
            $(this).find('td').each(function () {
                rowData.push($(this).text());
            });
            data.push(rowData);
        });

        let generatePdfRoute = "/azuf_lar/public/generate-pdf";

        $.ajax({
            url: generatePdfRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { data: data },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
                console.log(this.data)
                console.log(response)
                const blob = new Blob([response]);
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'generated_document.pdf';
                link.click();
            },
            error: function (error){
                console.log('Error:', error);
            }
        });
    });
});


//Excel Export
$(document).ready(function (){
    $('#btn-excel').click(function (){
        let filteredData = [];

        $('#payment-data-table tbody tr').each(function (){
            let rowData = [];
            $(this).find('td').each(function (){
                rowData.push($(this).text());
            });
            filteredData.push(rowData);
        });

        let generateExcelRoute = "/azuf_lar/public/generate-excel";


        $.ajax({
            url: generateExcelRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {data: filteredData},
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
                const blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'generated_document.xlsx';
                link.click();
                // a.click();
            },
            error: function (error){
                console.log('Error:', error);
            }
        })
    });
});


//CSV Export
$(document).ready(function (){
    $('#btn-csv').click(function (){
        let filteredData = [];

        $('#payment-data-table tbody tr').each(function (){
            let rowData = [];
            $(this).find('td').each(function (){
                rowData.push($(this).text());
            });
            filteredData.push(rowData);
        });
        // console.log(filteredData);

        let generateExcelRoute = "/azuf_lar/public/generate-csv";


        $.ajax({
            url: generateExcelRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {data: filteredData},
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
                const blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'generated_document.csv';
                link.click();
                // a.click();
            },
            error: function (error){
                console.log('Error:', error);
            }
        })
    });
});















