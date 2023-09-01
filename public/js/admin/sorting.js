//DataTable Installation

const table = new DataTable('#payment-data-table', {
    language: {
        url: 'plugins/data-table/ru-lang.json',
    },
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
                const blob = new Blob([response]);
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'generated_document.pdf';
                link.click();
            }
        });
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

        let generateExcelRoute = "/azuf_lar/public/generate-csv";

        $.ajax({
           url: generateExcelRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {data: filteredData},
            success: function (response) {
                const blob = new Blob([response]);
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'generated_document.csv';
                link.click();
            }
       })
    });
});

