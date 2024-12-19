<?php

namespace App\Exports;

use App\Models\Language;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromCollection,WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lang = Language::where('code','en')->first();
        $data =  Product::whereHas('translations',function($q) use($lang){
            $q->where('language_id',$lang->id);
        })->with(['translations' => function($q) use($lang) {
            $q->where('language_id',$lang->id);
        }])->get();

        $export = collect();
        foreach($data as $row){
            $cat = $row->subSubCategory->translations->where('language_id',$lang->id)->first();
            $arr = [
                'Code' => $row->code,
                'Name' => $row->translations->where('language_id',$lang->id)->first()->name,
                'Lang' => $lang->code,
                'SubSbuCatName' => $cat->name,
                'SubSbuCatCode' => $row->subSubCategory->code,
                'SubSbuCatLang' => $lang->code,
                'barcode' => $row->barcode,
                'CodeUnit' => $row->unit->code,
                'unit' => $row->unit->translations->where('language_id',$lang->id)->first()->name,
                'unit_value' =>$row->unit_value,
                'CodeTradeMark' => $row->trade->code,
                'about' => $row->translations->where('language_id',$lang->id)->first()->about
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
                'SubSbuCatName',
                'SubSubCatCode',
                'SubSubCatLang',
                'barcode',
                'CodeUnit',
                'unit',
                'unit_value',
                'CodeTradeMark',
                'about'
            ];
    } 

    public function styles(Worksheet $sheet){
        $sheet->getStyle('A')->getFont()->setBold(true);
        $sheet->getStyle('B')->getFont()->setBold(true);
        $sheet->getStyle('C')->getFont()->setBold(true);
        $sheet->getStyle('D')->getFont()->setBold(true);
        $sheet->getStyle('E')->getFont()->setBold(true);
        $sheet->getStyle('F')->getFont()->setBold(true);
        $sheet->getStyle('G')->getFont()->setBold(true);
        $sheet->getStyle('H')->getFont()->setBold(true);
        $sheet->getStyle('I')->getFont()->setBold(true);
        $sheet->getStyle('J')->getFont()->setBold(true);
        $sheet->getStyle('K')->getFont()->setBold(true);
        $sheet->getStyle('L')->getFont()->setBold(true);
    }
}
