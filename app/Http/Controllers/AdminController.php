<?php

//Вывод всех записей на домашнюю страницу Админки

namespace App\Http\Controllers;

use App\Models\DBdata;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use TCPDF;





class AdminController extends Controller
{
    public function adminHome()
    {
        $data = DBdata::all();
        return view('admin/home', ['data'=>$data]);
    }

    public function createPaymentPage()
    {
        return view('admin/create_payment_page');
    }



    public function generatePDF(Request $request)
    {
        $data = $request->input('data');

        // Создаем экземпляр TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Устанавливаем данные документа и отступы
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Generated PDF');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Устанавливаем шрифты
        $pdf->SetFont('dejavusans', '', 12);

        // Добавляем новую страницу
        $pdf->AddPage();

        // Вставляем заголовок
        $pdf->SetFont('dejavusans', 'R', 10);
        $pdf->Cell(0, 10, 'Общие платежи', 0, 1, 'C');
        $pdf->Ln(10); // Переход на новую строку

        // Вставляем таблицу HTML с наименованиями колонок
        $html = '
            <style>

             table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th {
                background-color: #0c84ff;
                color: #fff;
                font-weight: bold;
                font-size: 8px;
                padding: 10px;
                text-align: left;
            }

            td {
                font-size: 8px;
                padding: 8px;
                border: 1px solid #ddd;
            }
            </style>
            <table border="1">
                <tr>
                    <th><b>Имя</b></th>
                    <th><b>Фамилия</b></th>
                    <th><b>Сумма</b></th>
                    <th><b>Эмейл</b></th>
                    <th><b>Телефон</b></th>
                    <th><b>Фин</b></th>
                    <th><b>Подробности</b></th>
                </tr>';

        // Добавляем записи из данных
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . $cell . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Вставляем HTML в PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Генерируем PDF и отправляем пользователю
        $pdf->Output('generated_document.pdf', 'I');
    }



    public function generateExcel(Request $request)
    {
        $data = $request->input('data');

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $dataType = \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING;

        $columnHeaders = [
            'Имя',
            'Фамилия',
            'Сумма',
            'Эмейл',
            'Телефон',
            'Фин',
            'Подробности'
        ];

        $sheet->fromArray([$columnHeaders], null, 'A1');


        foreach ($data as $rowIndex => $rowData) {
            foreach ($rowData as $columnIndex => $cellData){
                $sheet->setCellValueExplicitByColumnAndRow(intval($columnIndex)+1, intval($rowIndex)+2, $cellData, $dataType);
            }
        }

        $filename = ' excel.xlsx';

        $path = storage_path('app/excel/'.now().$filename);

        $writer = new Xlsx($spreadsheet);

        $writer->save($path);

        $downloadLink = url('/download-excel/'. $filename);

        // Отправляем файл пользователю для скачивания
        return response()->download($path, $filename)->deleteFileAfterSend(true);
    }

    public function generateCsv(Request $request)
    {
        $data = $request->input('data');

        $headers = [
            'Имя',
            'Фамилия',
            'Сумма',
            'Эмейл',
            'Телефон',
            'Фин',
            'Подробности'
        ];

        $csv = "\xEF\xBB\xBF"; // Это BOM для UTF-8 (byte order mark)

        $csv .= implode(',', array_map(function ($value) {
                return '"' . str_replace('"', '""', $value) . '"';
            }, $headers)) . "\n";

        foreach ($data as $row) {
            $csv .= implode(',', array_map(function ($value) {
                    return '"' . str_replace('"', '""', $value) . '"';
                }, $row)) . "\n";
        }

        $filename = 'data.csv';
        $path = storage_path('app/csv/' . $filename);

        file_put_contents($path, $csv);

        return response()
            ->download($path, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
//            ->deleteFileAfterSend(true);
    }

}
