<?php

namespace App\Http\Controllers\Employee;

use App\Enum\ConcentrationUnit;
use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MedicineType;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('pharmaceutical_id', auth('employee')->user()->pharmaceutical_id)->paginate(10);
        return view('cms.products.index', ['data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $medicineTypes = MedicineType::where('status', 1)->get();
        $concentrationUnits = ConcentrationUnit::getUnits();
        return view('cms.products.create', ['categories' => $categories, 'medicineTypes' => $medicineTypes, 'concentrationUnits' => $concentrationUnits]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'category_id' => 'required|exists:categories,id,status,1',
            'medicine_type_id' => 'required|exists:medicine_types,id,status,1',
            'barcode' => 'required|integer|unique:products,barcode',
            'trade_name_ar' => 'required|string|max:255',
            'trade_name_en' => 'required|string|max:255',
            'scientific_name_ar' => 'required|string|max:255',
            'scientific_name_en' => 'required|string|max:255',
            'drug_description_ar' => 'required|string|max:1000',
            'drug_description_en' => 'required|string|max:1000',
            'indications_for_use_ar' => 'required|string|max:1000',
            'indications_for_use_en' => 'required|string|max:1000',
            'recommended_dosage_ar' => 'required|string|max:1000',
            'recommended_dosage_en' => 'required|string|max:1000',
            'how_to_use_ar' => 'required|string|max:1000',
            'how_to_use_en' => 'required|string|max:1000',
            'drug_interactions_ar' => 'required|string|max:1000',
            'drug_interactions_en' => 'required|string|max:1000',
            'side_effects_ar' => 'required|string|max:1000',
            'side_effects_en' => 'required|string|max:1000',
            'alternative_medicines_ar' => 'required|string|max:1000',
            'alternative_medicines_en' => 'required|string|max:1000',
            'complementary_medicines_ar' => 'required|string|max:1000',
            'complementary_medicines_en' => 'required|string|max:1000',
            'concentration_value' => 'required|integer|min:1',
            'concentration_unit' => 'required|string|in:' . ConcentrationUnit::getUnitsForValidation(),
            'num_units_in_package' => 'required|integer|min:1',
            'available_without_prescription' => 'required|boolean',
            'quantity' => 'required|integer|min:1',
            'basic_price' => 'required|integer|min:1',
            'retail_price' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'medication_leaflet_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'weight' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $data = $validator->validated();
        $data['image'] = $this->uploadFile($request->file('image'), 'products');
        if ($request->hasFile('medication_leaflet_image')) {
            $data['medication_leaflet_image'] = $this->uploadFile($request->file('medication_leaflet_image'), 'products');
        }
        $data['pharmaceutical_id'] = auth('employee')->user()->pharmaceutical_id;

        $product = Product::create($data);

        return ControllersService::generateProcessResponse((bool) $product, 'CREATE');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if ($product->pharmaceutical_id != auth('employee')->user()->pharmaceutical_id) {
            throw new UnauthorizedException('This action is unauthorized.');
        }

        return view('cms.products.show', ['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ($product->pharmaceutical_id != auth('employee')->user()->pharmaceutical_id) {
            throw new UnauthorizedException('This action is unauthorized.');
        }

        $categories = Category::where('status', 1)->get();
        $medicineTypes = MedicineType::where('status', 1)->get();
        $concentrationUnits = ConcentrationUnit::getUnits();
        return view('cms.products.edit', ['data' => $product, 'categories' => $categories, 'medicineTypes' => $medicineTypes, 'concentrationUnits' => $concentrationUnits]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($product->pharmaceutical_id != auth('employee')->user()->pharmaceutical_id) {
            throw new UnauthorizedException('This action is unauthorized.');
        }

        $validator = Validator($request->all(), [
            'category_id' => 'required|exists:categories,id,status,1',
            'medicine_type_id' => 'required|exists:medicine_types,id,status,1',
            'barcode' => 'required|integer|unique:products,barcode,' . $product->id,
            'trade_name_ar' => 'required|string|max:255',
            'trade_name_en' => 'required|string|max:255',
            'scientific_name_ar' => 'required|string|max:255',
            'scientific_name_en' => 'required|string|max:255',
            'drug_description_ar' => 'required|string|max:1000',
            'drug_description_en' => 'required|string|max:1000',
            'indications_for_use_ar' => 'required|string|max:1000',
            'indications_for_use_en' => 'required|string|max:1000',
            'recommended_dosage_ar' => 'required|string|max:1000',
            'recommended_dosage_en' => 'required|string|max:1000',
            'how_to_use_ar' => 'required|string|max:1000',
            'how_to_use_en' => 'required|string|max:1000',
            'drug_interactions_ar' => 'required|string|max:1000',
            'drug_interactions_en' => 'required|string|max:1000',
            'side_effects_ar' => 'required|string|max:1000',
            'side_effects_en' => 'required|string|max:1000',
            'alternative_medicines_ar' => 'required|string|max:1000',
            'alternative_medicines_en' => 'required|string|max:1000',
            'complementary_medicines_ar' => 'required|string|max:1000',
            'complementary_medicines_en' => 'required|string|max:1000',
            'concentration_value' => 'required|integer|min:1',
            'concentration_unit' => 'required|string|in:' . ConcentrationUnit::getUnitsForValidation(),
            'num_units_in_package' => 'required|integer|min:1',
            'available_without_prescription' => 'required|boolean',
            'quantity' => 'required|integer|min:1',
            'basic_price' => 'required|integer|min:1',
            'retail_price' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'medication_leaflet_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'weight' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $data = $validator->validated();
        $data['image'] = $product->image;
        $data['medication_leaflet_image'] = $product->medication_leaflet_image;

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'products');
        }

        if ($request->hasFile('medication_leaflet_image')) {
            $data['medication_leaflet_image'] = $this->uploadFile($request->file('medication_leaflet_image'), 'products');
        }

        $updated = $product->update($data);

        return ControllersService::generateProcessResponse((bool) $updated, 'UPDATE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->pharmaceutical_id != auth('employee')->user()->pharmaceutical_id) {
                throw new UnauthorizedException('This action is unauthorized.');
            }

            $deleted = $product->delete();
            return ControllersService::generateProcessResponse((bool) $deleted, 'DELETE');
        } catch (\Exception $e) {
            return ControllersService::generateProcessResponse(false, 'DELETE');
        }
    }
}
