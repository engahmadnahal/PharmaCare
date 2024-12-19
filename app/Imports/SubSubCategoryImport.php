<?php

namespace App\Imports;

use App\Models\Language;
use App\Models\SubCatergory;
use App\Models\SubSubCategoryTranslataion;
use App\Models\SubSubCatergory;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubSubCategoryImport implements ToModel,WithHeadingRow
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
            $subCat = SubCatergory::where('code',$row['subcatcode'])->first();
            $isExists = SubSubCatergory::where('code',$row['code'])->first();
            $transIsExists = SubSubCategoryTranslataion::where('language_id',$lang->id)->exists();

            if($isExists == null){
                $subSubCat = new SubSubCatergory;
                $subSubCat->code = $row['code'];
                $subSubCat->image = 'subsubcategories/image/'.$row['code'].'.png';
                $subSubCat->icon = 'subsubcategories/icon/'.$row['code'].'.png';
                $subSubCat->active = true;
                $subSubCat->sub_category_id = $subCat->id;
                $subSubCat->save();
                try{
                    $subSubCat->translations()->create([
                        'name' => $row['name'],
                        'language_id' => $lang->id
                    ]);
                }catch(Exception $e){
                    $subSubCat->delete();
                }
                return $subSubCat;
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
        return 6;
    }
}
