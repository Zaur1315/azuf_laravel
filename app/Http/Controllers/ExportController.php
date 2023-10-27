<?php

namespace App\Http\Controllers;

use App\Models\DBdata;
use App\Models\PaymentPage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ExportController extends Controller
{
    public const SEPARATOR = ',';
    public const TABLE_HOME = 'home';
    public const TABLE_ALL_ACTION = 'all_action';
    public const TABLE_SINGLE_ACTION = 'single_action';
    public const TABLE_USERS = 'users';
    public const CSV = "\xEF\xBB\xBF";
    public const FILENAME = 'exported_data';



    public function exportCSV(Request $request): StreamedResponse
    {
        $columnsToExport = $request->input('columnsToExport');
        $columnHeaders = $request->input('columnHeaders');

        $columnIndex = $request->input('col');
        $sortDirection = $request->input('sort');
        $searchQuery = $request->input('search');
        $tableInfo = $request->input('info');
        $doc_type = $request->input('type');

        if ($tableInfo == self::TABLE_HOME) {
            $query = DBdata::query();
        } else {
            if ($tableInfo == self::TABLE_ALL_ACTION) {
                $query = PaymentPage::query();
            } else {
                if ($tableInfo == self::TABLE_SINGLE_ACTION) {
                    $pageId = $request->input('page');
                    $query = DBdata::where('payment_page_id', $pageId);
                } else {
                    if ($tableInfo == self::TABLE_USERS) {
                        $query = User::query();
                    }
                }
            }
        }

        if ($columnIndex !== null && isset($columnsToExport[$columnIndex])) {
            $column = $columnsToExport[$columnIndex];
            $query->orderBy($column, $sortDirection);
        }

        if (!empty($searchQuery)) {
            $query->where(function ($query) use ($searchQuery, $columnsToExport) {
                foreach ($columnsToExport as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $searchQuery . '%');
                }
            });
        }

        $filteredData = $query->get($columnsToExport);


        $csv = self::CSV . implode(
                self::SEPARATOR,
                array_map(function ($value) {
                    return '"' . str_replace('"', '""', $value) . '"';
                }, $columnHeaders)
            ) . PHP_EOL;

        foreach ($filteredData as $data) {
            $rowData = [];
            foreach ($columnsToExport as $column) {
                $rowData[] = '"' . str_replace('"', '""', $data->$column) . '"';
            }
            $csv .= implode(',', $rowData) . PHP_EOL;
        }


        $path = storage_path('app/' . self::FILENAME . '.' . $doc_type);
        file_put_contents($path, $csv);

        // Возвращаем файл для скачивания
        return Response::stream(function () use ($path) {
            readfile($path);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . self::FILENAME . '.' . $doc_type . '"',
        ]);
    }

    public function exportXLSX(Request $request): BinaryFileResponse|JsonResponse

    {
        $columnIndex = $request->input('col');
        $sortDirection = $request->input('sort');
        $searchQuery = $request->input('search');
        $columnsToExport = $request->input('columnsToExport');
        $tableInfo = $request->input('info');
        $doc_type = $request->input('type');

        if ($tableInfo == self::TABLE_HOME) {
            $query = DBdata::query();
        } else {
            if ($tableInfo == self::TABLE_ALL_ACTION) {
                $query = PaymentPage::query();
            } else {
                if ($tableInfo == self::TABLE_SINGLE_ACTION) {
                    $pageId = $request->input('page');
                    $query = DBdata::where('payment_page_id', $pageId);
                } else {
                    if ($tableInfo == self::TABLE_USERS) {
                        $query = User::query();
                    }
                }
            }
        }


        if ($columnIndex !== null && isset($columnsToExport[$columnIndex])) {
            $column = $columnsToExport[$columnIndex];
            $query->orderBy($column, $sortDirection);
        }

        if (!empty($searchQuery)) {
            $query->where(function ($query) use ($searchQuery, $columnsToExport) {
                foreach ($columnsToExport as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $searchQuery . '%');
                }
            });
        }

        $filteredData = $query->get($columnsToExport);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columnHeaders = $request->input('columnHeaders');

        $columnIndex = 1;
        foreach ($columnHeaders as $header) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
            $columnIndex++;
        }

        $rowIndex = 2;
        foreach ($filteredData as $data) {
            $columnIndex = 1;
            foreach ($columnsToExport as $column) {
                $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $data->$column);
                $columnIndex++;
            }
            $rowIndex++;
        }

        $writer = new Xlsx($spreadsheet);


        $writer->save(self::FILENAME . '.' . $doc_type);
        return response()->download(self::FILENAME . '.' . $doc_type)->deleteFileAfterSend();
    }

}
