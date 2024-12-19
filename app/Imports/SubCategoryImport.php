<?php

namespace App\Imports;

use App\Models\Catergory;
use App\Models\Language;
use App\Models\SubCategoryTranslataion;
use App\Models\SubCatergory;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class SubCategoryImport implements ToModel,WithHeadingRow
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
            $cat = Catergory::where('code',$row['catcode'])->first();
            $isExists = SubCatergory::where('code',$row['code'])->first();
            $transIsExists = SubCategoryTranslataion::where('language_id',$lang->id)->exists();

            if($isExists == null){

                $subCat = new SubCatergory;
                $subCat->code = $row['code'];
                $subCat->image = 'subcategories/image/'.$row['code'].'.png';
                $subCat->icon = 'subcategories/icon/'.$row['code'].'.png';
                $subCat->active = true;
                $subCat->category_id = $cat->id;
                $subCat->save();
                try{
                    $subCat->translations()->create([
                        'name' => $row['name'],
                        'language_id' => $lang->id
                    ]);
                }catch(Exception $e){
                    $subCat->delete();
                }
                return $subCat;
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
