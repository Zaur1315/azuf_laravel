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
