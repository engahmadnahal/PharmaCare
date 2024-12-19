<?php

namespace App\Exports;

use App\Models\Language;
use App\Models\SubSubCatergory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubSubCatergoryExport implements FromCollection,WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lang = Language::where('code','en')->first();
        $data =  SubSubCatergory::whereHas('translations',function($q) use($lang){
            $q->where('language_id',$lang->id);
        })->with(['translations' => function($q) use($lang) {
            $q->where('language_id',$lang->id);
    }])->get();

        $export = collect();
        foreach($data as $row){
            $cat = $row->subCategory->translations->where('language_id',$lang->id)->first();
            $arr = [
                'Code' => $row->code,
                'Name' => $row->translations->first()->name,
                'Lang' => $lang->code,
                'SubCatName' => $cat->name,
                'SubCatCode' => $row->subCategory->code,
                'SubCatLang' => $lang->code,
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
                'SubCatName',
                'SubCatCode',
                'SubCatLang'
            ];
    } 

    public function styles(Worksheet $sheet){
        $sheet->getStyle('A')->getFont()->setBold(true);
        $sheet->getStyle('B')->getFont()->setBold(true);
        $sheet->getStyle('C')->getFont()->setBold(true);
        $sheet->getStyle('D')->getFont()->setBold(true);
        $sheet->getStyle('E')->getFont()->setBold(true);
        $sheet->getStyle('F')->getFont()->setBold(true);
    }
}
