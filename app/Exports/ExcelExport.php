<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        // Здесь укажите заголовки для столбцов Excel
        return [
            'Имя',
            'Фамилия',
            'Сумма',
            'Эмейл',
            'Телефон',
            'Фин',
            'Подробности',
        ];
    }
}
