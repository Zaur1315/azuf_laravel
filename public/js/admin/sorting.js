//DataTable Installation
$(document).ready(function() {
    $('#payment-data-table').DataTable({
        "aLengthMenu": [
            [10, 25, 50, 100, -1], // Количество элементов на странице
            [10, 25, 50, 100, "Все"] // Отображаемые значения
        ],
        "language": {
        url: 'plugins/data-table/ru-lang.json',
        // Другие настройки и опции DataTables...
    }});
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















