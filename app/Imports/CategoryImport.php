<?php

namespace App\Imports;

use App\Models\CategoryTranslataion;
use App\Models\Catergory;
use App\Models\Language;
use App\Models\Product;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if($row['code'] != null){
            $cat = new Catergory;
            $lang = Language::where('code',$row['lang'])->first();
            $isExists = Catergory::where('code',$row['code'])->first();
            $transIsExists = CategoryTranslataion::where('language_id',$lang->id)->exists();

            if($isExists == null){

                $cat->code = $row['code'];
                $cat->image = 'categories/image/'.$row['code'].'.png';
                $cat->icon = 'categories/icon/'.$row['code'].'.png';
                $cat->active = true;
                $cat->save();
                try{
                    $cat->translations()->create([
                        'name' => $row['name'],
                        'language_id' => $lang->id
                    ]);
                }catch(Exception $e){
                    $cat->delete();
                }
                return $cat;
            }else{
                if(!$transIsExists){
                    $isExists->translations()->create([
                        'name' => $row['name'],
                        'language_id' => $lang->id
                    ]);
                    return $isExists;
                }
            }
        }
    }

    public function heading() : int{
        return 3;
    }
}
