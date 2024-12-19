<?php

namespace App\Imports;

use App\Models\Language;
use App\Models\Product;
use App\Models\ProductTranslataion;
use App\Models\SubSubCatergory;
use App\Models\TradeMark;
use App\Models\Unit;
use App\Models\UnitTranslataion;
use Exception;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if($row['code'] != null){
            $lang = Language::where('code',$row['lang'])->first();
            $isExists = Product::where('code',$row['code'])->first();
            $transIsExists = ProductTranslataion::where('language_id',$lang->id)->exists();

            if($isExists == null){

                $unit = Unit::where('code',$row['codeunit'])->first();
                $trade = TradeMark::where('code',$row['codetrademark'])->first();
                $subSubCat = SubSubCatergory::where('code',$row['subsubcatcode'])->first();
                
                $product = new Product;
                $product->code = $row['code'];
                $product->image = 'products/'.$row['code'].'.png';
                $product->sub_sub_category_id = $subSubCat->id;
                $product->barcode = $row['barcode'];
                $product->unit_value = $row['unit_value'];
                $product->trade_mark_id = $trade->id;
                $product->unit_id = $unit->id;
                $product->active = true;
                $product->save();
                try{
                    $product->translations()->create([
                        'name' => $row['name'],
                        'about' => $row['about'],
                        'language_id' => $lang->id
                    ]);
                }catch(Exception $e){
                    $product->delete();
                }
                return $product;
            }else{
                if(!$transIsExists){
                    $isExists->translations()->create([
                        'name' => $row['name'],
                        'about' => $row['about'],
                        'language_id' => $lang->id
                    ]);
                    return $isExists;
                }
            }
        }
    }

    public function heading() : int{
        return 10;
    }
}

