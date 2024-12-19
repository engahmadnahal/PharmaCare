<?php

namespace App\Exports;

use App\Models\Language;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnitExport implements FromCollection,WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $lang = Language::where('code','en')->first();
        $data =  Unit::whereHas('translations',function($q) use($lang){
            $q->where('language_id',$lang->id);
        })->with(['translations' => function($q) use($lang) {
            $q->where('language_id',$lang->id);
        }])->get();

        $export = collect();
        foreach($data as $row){
            $arr = [
                'Code' => $row->code,
                'Name' => $row->translations->first()->name,
                'Lang' => $lang->code,
            ];
            $export->add($arr);
        }
        return $export;
    }

    public function headings() : array
    {
            return [
                'Code',
                'Name',
                'Lang',
            ];
    } 

    public function styles(Worksheet $sheet){
        $sheet->getStyle('A')->getFont()->setBold(true);
        $sheet->getStyle('B')->getFont()->setBold(true);
        $sheet->getStyle('C')->getFont()->setBold(true);
    }
}
