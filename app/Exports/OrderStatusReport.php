<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class OrderStatusReport implements FromCollection
{

    public function __construct(
        protected $data
    )
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        return $this->data;
    }
}
