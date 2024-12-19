<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class StudioPerformanceReport implements FromCollection
{

    public function __construct(public $data,public $filterDate)
    {
        $this->data = $data;
        $this->filterDate = $filterDate;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }
}
