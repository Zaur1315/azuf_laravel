<?php

//Вывод всех записей на домашнюю страницу Админки

namespace App\Http\Controllers;

use App\Models\DBdata;
use App\Models\PaymentPage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application as Application_Foundation;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use TCPDF;




class AdminController extends Controller
{

    public function adminHome(): View|Application|Factory|Application_Foundation
    {
        $data = DBdata::all();
        return view('admin/home', ['data' => $data]);
    }

    public function createPaymentPage(): View|Application|Factory|Application_Foundation
    {
        return view('admin/create_payment_page');
    }


    public function generatePDF(Request $request): void
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


    public function generateExcel(Request $request): BinaryFileResponse
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
            foreach ($rowData as $columnIndex => $cellData) {
                $sheet->setCellValueExplicitByColumnAndRow(intval($columnIndex) + 1, intval($rowIndex) + 2, $cellData, $dataType);
            }
        }

        $filename = ' excel.xlsx';

        $path = storage_path('app/excel/' . now() . $filename);

        $writer = new Xlsx($spreadsheet);

        $writer->save($path);

        $downloadLink = url('/download-excel/' . $filename);

        // Отправляем файл пользователю для скачивания
        return response()->download($path, $filename)->deleteFileAfterSend(true);
    }

    public function generateCsv(Request $request): BinaryFileResponse
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

    public function editPaymentPage($id): View
    {
        $paymentPage = PaymentPage::findOrFail($id);
        return view('admin.edit_payment_page', compact('paymentPage'));
    }


    public function updatePaymentPage(Request $request, $id): RedirectResponse
    {
        $paymentPage = PaymentPage::findOrFail($id);

        $paymentPage->subject = $request->input('subject');
        $paymentPage->description = $request->input('description');
        if ($request->input('show')) {
            $paymentPage->show = true;
        } else {
            $paymentPage->show = false;
        }

        $paymentPage->save();

        return redirect()->route('admin.home')->with('success', 'Страница успешно изменина');
    }

    public function editUser($id): View
    {
        $userInfo = User::findOrFail($id);
        return view('admin.edit_user', compact('userInfo'));
    }

    public function updateUser(Request $request, $id): RedirectResponse
    {
        $this->validate($request,[
           'name'=> 'required|string|max:255',
//           'email'=> 'required|string|email|max:255|unique:users,email,'.$id,
           'password' => 'nullable|string|min:8|confirmed',
           'role' => 'required|string',
        ]);

        $user = User::find($id);

        if(!$user){

            return redirect()->route('admin.home')->with('error', 'Пользователь не найден');
        }

        $user->name = $request->input('name');
        $user->role = $request->input('role');


        if (!empty($request->input('password'))){
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.home')->with('success', 'Пользователь успешно обновлен');
    }

}
