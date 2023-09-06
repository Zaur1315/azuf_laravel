<?php
//namespace App\Exports;
//
//use Maatwebsite\Excel\Concerns\WithHeadings;
//use Maatwebsite\Excel\Concerns\ShouldAutoSize;
//use Maatwebsite\Excel\Concerns\FromCollection;
//use Illuminate\Support\Collection;
//use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromView;
//
//class ExcelExport implements FromCollection, WithHeadings
//{
//    protected $data;
//
//    public function __construct(array $data)
//    {
//        $this->data = $data;
//    }
//
//    public function collection()
//    {
//        return new Collection($this->data);
//    }
//
//    public function headings(): array
//    {
//        // Здесь укажите заголовки для столбцов Excel
//        return [
//            'Имя',
//            'Фамилия',
//            'Сумма',
//            'Эмейл',
//            'Телефон',
//            'Фин',
//            'Подробности',
//        ];
//    }
//}


namespace App\Exports;

use App\Models\DBdata;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DBdata::select("id", "first_name", "customer_email")->get();
    }


    public function headings(): array
    {
        return ["ID", "Name", "Email"];
    }

}
