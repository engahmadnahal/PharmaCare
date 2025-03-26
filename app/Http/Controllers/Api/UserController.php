<?php

namespace App\Http\Controllers\Api;

use App\Enum\DiseaseType;
use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\UserDrug;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\OrderResource;
use App\Models\UserMedicalRecord;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\MedicalRecordResource;
use App\Http\Resources\DrugResource;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        try {
            $user = User::with(['info', 'drugs', 'medicalRecords'])->find($request->user()->id);

            return ControllersService::successResponse(__('cms.profile_retrieved_successfully'), new ProfileResource($user));
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:11|unique:users,mobile,' . $user->id,

        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $user->full_name = $request->full_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $save = $user->save();

            if (!$save) {
                throw new \Exception(__('cms.failed_update_user'));
            }

            return ControllersService::successResponse(
                __('cms.profile_updated_successfully'),
                new ProfileResource($user->fresh(['info', 'drugs', 'medicalRecords']))
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function addChild(Request $request)
    {
        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',

            // User Info validation
            'width' => 'required|string',
            'length' => 'required|string',
            'blood_type' => 'nullable|string|in:A,B,AB,O',
            'is_allergies' => 'required|boolean',
            'is_genetic_diseases' => 'required|boolean',
            'genetic_diseases' => 'nullable|string|in:genetic,chronic,both',
            'allergies' => 'nullable|string|in:medication,food,both',

            // User Drugs validation
            'drugs' => 'required|array',
            'drugs.*.name' => 'required|string|max:255',
            'drugs.*.dosage' => 'required|string|max:255',
            'drugs.*.diseases' => 'required|string|max:255',
            'drugs.*.type' => 'required|string|in:permanent,temporary',
            'drugs.*.duration' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        DB::beginTransaction();
        try {
            // Create user
            $user = new User();
            $user->full_name = $request->full_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->parent_id = $request->user()->id;
            $save = $user->save();

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user'));
            }

            // Create user info
            $userInfo = new UserInfo();
            $userInfo->user_id = $user->id;
            $userInfo->width = $request->width;
            $userInfo->length = $request->length;
            $userInfo->blood_type = $request->blood_type;
            $userInfo->is_allergies = $request->is_allergies;
            $userInfo->is_genetic_diseases = $request->is_genetic_diseases;
            $userInfo->genetic_diseases = $request->genetic_diseases;
            $userInfo->allergies = $request->allergies;
            $save = $userInfo->save();

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user_info'));
            }

            // Create user drugs if provided
            $userDrugs = [];
            foreach ($request->drugs as $drug) {
                $userDrugs[] = [
                    'user_id' => $user->id,
                    'name' => $drug['name'],
                    'dosage' => $drug['dosage'],
                    'diseases' => $drug['diseases'],
                    'duration' => $drug['duration'] ?? null,
                    'type' => $drug['type'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            $save = UserDrug::insert($userDrugs);

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user_drug'));
            }

            DB::commit();
            return ControllersService::successResponse(__('cms.register_success'), new ProfileResource($user));
        } catch (\Exception $e) {
            DB::rollBack();
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function getChildren()
    {
        $children = auth('user-api')->user()->childrens;
        return ControllersService::successResponse(__('cms.children_retrieved_successfully'), ProfileResource::collection($children));
    }

    public function updateChild(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',

            // User Info validation
            'width' => 'required|string',
            'length' => 'required|string',
            'blood_type' => 'nullable|string|in:A,B,AB,O',
            'is_allergies' => 'required|boolean',
            'is_genetic_diseases' => 'required|boolean',
            'genetic_diseases' => 'nullable|string|in:genetic,chronic,both',
            'allergies' => 'nullable|string|in:medication,food,both',

            // User Drugs validation
            'drugs' => 'required|array',
            'drugs.*.name' => 'required|string|max:255',
            'drugs.*.dosage' => 'required|string|max:255',
            'drugs.*.diseases' => 'required|string|max:255',
            'drugs.*.type' => 'required|string|in:permanent,temporary',
            'drugs.*.duration' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $user = User::where('parent_id', auth('user-api')->user()->id)->where('id', $id)->first();
        if (!$user) {
            return ControllersService::generateValidationErrorMessage(__('cms.child_not_found'));
        }

        DB::beginTransaction();
        try {
            // Create user
            $user->full_name = $request->full_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->parent_id = $request->user()->id;
            $save = $user->save();

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user'));
            }

            // Create user info
            $userInfo = UserInfo::where('user_id', $user->id)->first();
            $userInfo->width = $request->width;
            $userInfo->length = $request->length;
            $userInfo->blood_type = $request->blood_type;
            $userInfo->is_allergies = $request->is_allergies;
            $userInfo->is_genetic_diseases = $request->is_genetic_diseases;
            $userInfo->genetic_diseases = $request->genetic_diseases;
            $userInfo->allergies = $request->allergies;
            $save = $userInfo->save();

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user_info'));
            }

            // Create user drugs if provided
            $userDrugs = [];
            foreach ($request->drugs as $drug) {
                $userDrugs[] = [
                    'user_id' => $user->id,
                    'name' => $drug['name'],
                    'dosage' => $drug['dosage'],
                    'diseases' => $drug['diseases'],
                    'duration' => $drug['duration'] ?? null,
                    'type' => $drug['type'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            $delete = UserDrug::where('user_id', $user->id)->delete();
            if (!$delete) {
                throw new \Exception(__('cms.faild_update_user_drug'));
            }
            $save = UserDrug::insert($userDrugs);

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user_drug'));
            }

            DB::commit();
            return ControllersService::successResponse(__('cms.register_success'), new ProfileResource($user));
        } catch (\Exception $e) {
            DB::rollBack();
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function orders(Request $request)
    {
        try {
            $user = $request->user();

            $orders = $user->orders()
                ->select('id', 'order_num', 'created_at', 'status', 'total', 'discount', 'coupon_discount', 'payment_method', 'payment_status')
                ->latest()
                ->get();

            $summary = [
                'total_orders' => $user->orders()->count(),
                'pending_orders' => $user->orders()->where('status', 'pending')->count(),
                'completed_orders' => $user->orders()->where('status', 'completed')->count(),
                'last_order_code' => $user->orders()->latest()->first()?->order_num ?? null,
            ];

            return ControllersService::successResponse(
                __('cms.orders_retrieved_successfully'),
                [
                    'summary' => $summary,
                    'orders' => OrderResource::collection($orders)
                ]
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function createMedicalRecord(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|in:' . DiseaseType::getTypesForValidation(),
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $medicalRecord = new UserMedicalRecord();
            $medicalRecord->user_id = auth('user-api')->id();
            $medicalRecord->name = $request->name;
            $medicalRecord->description = $request->description;
            $medicalRecord->type = $request->type;

            if ($request->hasFile('file')) {
                $medicalRecord->file = $this->uploadFile($request->file('file'), 'medical_records');
            }

            $save = $medicalRecord->save();

            if (!$save) {
                throw new \Exception(__('cms.failed_create_medical_record'));
            }

            return ControllersService::successResponse(
                __('cms.medical_record_created_successfully'),
                new MedicalRecordResource($medicalRecord)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function updateMedicalRecord(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|in:' . DiseaseType::getTypesForValidation(),
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $medicalRecord = UserMedicalRecord::where('user_id', auth('user-api')->id())
            ->whereId($id)
            ->first();

        if (!$medicalRecord) {
            return ControllersService::generateValidationErrorMessage(__('cms.medical_record_not_found'));
        }

        try {
            $medicalRecord->name = $request->name;
            $medicalRecord->description = $request->description;
            $medicalRecord->type = $request->type;

            if ($request->hasFile('file')) {
                if ($medicalRecord->file) {
                    Storage::disk('public')->delete($medicalRecord->file);
                }
                $medicalRecord->file = $this->uploadFile($request->file('file'), 'medical_records');
            }

            $save = $medicalRecord->save();

            if (!$save) {
                throw new \Exception(__('cms.failed_update_medical_record'));
            }

            return ControllersService::successResponse(
                __('cms.medical_record_updated_successfully'),
                new MedicalRecordResource($medicalRecord)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function getMedicalRecords()
    {
        try {
            $records = auth('user-api')->user()
                ->medicalRecords()
                ->latest()
                ->get();

            return ControllersService::successResponse(
                __('cms.medical_records_retrieved_successfully'),
                MedicalRecordResource::collection($records)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function deleteMedicalRecord($id)
    {
        try {
            $medicalRecord = UserMedicalRecord::where('user_id', auth('user-api')->id())
                ->where('id', $id)
                ->first();

            if (!$medicalRecord) {
                return ControllersService::generateValidationErrorMessage(__('cms.medical_record_not_found'));
            }

            // Delete file if exists
            if ($medicalRecord->file) {
                Storage::disk('public')->delete($medicalRecord->file);
            }

            $delete = $medicalRecord->delete();

            if (!$delete) {
                throw new \Exception(__('cms.failed_delete_medical_record'));
            }

            return ControllersService::successResponse(
                __('cms.medical_record_deleted_successfully')
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function getDiseaseType()
    {
        return ControllersService::successResponse(__('cms.disease_type_retrieved_successfully'), DiseaseType::getTypes());
    }

    public function createDrug(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'diseases' => 'required|string|max:255',
            'type' => 'required|string|in:permanent,temporary',
            'duration' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $drug = new UserDrug();
            $drug->user_id = auth('user-api')->id();
            $drug->name = $request->name;
            $drug->dosage = $request->dosage;
            $drug->diseases = $request->diseases;
            $drug->type = $request->type;
            $drug->duration = $request->duration;
            
            $save = $drug->save();

            if (!$save) {
                throw new \Exception(__('cms.failed_create_drug'));
            }

            return ControllersService::successResponse(
                __('cms.drug_created_successfully'),
                new DrugResource($drug)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function updateDrug(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'diseases' => 'required|string|max:255',
            'type' => 'required|string|in:permanent,temporary',
            'duration' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $drug = UserDrug::where('user_id', auth('user-api')->id())
            ->whereId($id)
            ->first();

        if (!$drug) {
            return ControllersService::generateValidationErrorMessage(__('cms.drug_not_found'));
        }

        try {
            $drug->name = $request->name;
            $drug->dosage = $request->dosage;
            $drug->diseases = $request->diseases;
            $drug->type = $request->type;
            $drug->duration = $request->duration;
            
            $save = $drug->save();

            if (!$save) {
                throw new \Exception(__('cms.failed_update_drug'));
            }

            return ControllersService::successResponse(
                __('cms.drug_updated_successfully'),
                new DrugResource($drug)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function getDrugs()
    {
        try {
            $drugs = auth('user-api')->user()
                ->drugs()
                ->latest()
                ->get();

            return ControllersService::successResponse(
                __('cms.drugs_retrieved_successfully'),
                DrugResource::collection($drugs)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function deleteDrug($id)
    {
        try {
            $drug = UserDrug::where('user_id', auth('user-api')->id())
                ->whereId($id)
                ->first();

            if (!$drug) {
                return ControllersService::generateValidationErrorMessage(__('cms.drug_not_found'));
            }

            $delete = $drug->delete();

            if (!$delete) {
                throw new \Exception(__('cms.failed_delete_drug'));
            }

            return ControllersService::successResponse(
                __('cms.drug_deleted_successfully')
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }
}
