<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\ServiceOnCartResource;
use App\Models\FrameAlbumBooking;
use App\Models\MyCart;
use App\Models\PassportBooking;
use App\Models\PassportOption;
use App\Models\PostcardBooking;
use App\Models\PosterBooking;
use App\Models\Product;
use App\Models\ProductBooking;
use App\Models\ServicesBookingStudio;
use App\Models\SoftcopyBooking;
use App\Models\StudioBooking;
use Illuminate\Http\Request;
use Mockery\Expectation;
use Symfony\Component\HttpFoundation\Response;

class MyCartController extends Controller
{
    public function getCartData()
    {
        $arrData = collect();
        $data = MyCart::where('user_id', auth()->user()->id)->get();
        foreach ($data as $d) {
            $object = $this->getObjectMorph($d->object_type, $d->object_id);
            if ($d->object_type == PostcardBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);

                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalPostcardBooking($object));
                $arrData->add($object);
            } else if ($d->object_type == PosterBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);

                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalPosterBooking($object));
                $arrData->add($object);
            } else if ($d->object_type == PassportBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);

                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalPassportBooking($object));
                $arrData->add($object);
            } else if ($d->object_type == FrameAlbumBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);

                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalFrameBooking($object));
                $arrData->add($object);
            } else if ($d->object_type == SoftcopyBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);

                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalSoftBooking($object));
                $arrData->add($object);
            } else if ($d->object_type == StudioBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);
                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalStudioBooking($object));
                $arrData->add($object);
            } else if ($d->object_type == ProductBooking::class) {
                if (is_null($object)) return response()->json(new ErrorResponse('ERROR_LOAD_CART'), Response::HTTP_BAD_REQUEST);

                $object->setAttribute('type_object', $d->object_type);
                $object->setAttribute('totalService', $this->getTotalProductBooking($object));
                $arrData->add($object);
            } else {
                continue;
            }
        }
        return response()->json(new SuccessResponse('SUCCESS_GET', [
            'cart_detials' => $this->totalDetails(),
            'services' => ServiceOnCartResource::collection($arrData)
        ]));
    }


    // للاستخدام خارج الكلاس
    public function getServices()
    {
        $arrData = collect();
        $data = MyCart::where('user_id', auth()->user()->id)->get();
        foreach ($data as $d) {
            $object = $this->getObjectMorph($d->object_type, $d->object_id);
            if ($object == null || $d->object_type == SoftcopyBooking::class || $d->object_type == StudioBooking::class) continue;
            $object->setAttribute('type', $d->object_type);
            $arrData->add($object);
        }
        return ServiceOnCartResource::collection($arrData);
    }
    public function deleteService(Request $request)
    {
        $validator = Validator($request->all(), [
            'service_type' => 'required|string|in:postcard,poster,passport,frameOrAlbum,softcopy,studio',
            'service_id' => 'required|numeric|exists:my_carts,object_id'
        ]);

        if (!$validator->fails()) {
            try {
                if ($this->deleteMyCart($request)) {
                    if (($this->getObjectMorph($request->service_type, $request->service_id))->delete()) {
                        return response()->json(new SuccessResponse('SUCCESS_DELETE', null, false), Response::HTTP_OK);
                    }
                }
                return response()->json(new ErrorResponse('ERROR_DELETE'), Response::HTTP_BAD_REQUEST);
            } catch (Expectation $e) {
                return response()->json(new ErrorResponse('ERROR_DELETE'), Response::HTTP_BAD_REQUEST);
            }
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function getSubTotal($isSoft = false, $promoValue = null)
    {
        $total = 0;
        $data = MyCart::where('user_id', auth()->user()->id)->get();
        foreach ($data as $d) {
            if ($isSoft && $d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
                continue;
            }
            if ($d->object_type == PostcardBooking::class) {
                $total += $this->getTotalPostcardBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
            } else if ($d->object_type == PosterBooking::class) {
                $total += $this->getTotalPosterBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
            } else if ($d->object_type == FrameAlbumBooking::class) {
                $total += $this->getTotalFrameBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
            } else if ($d->object_type == PassportBooking::class) {
                $total += $this->getTotalPassportBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
            } else if ($d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
            } else if ($d->object_type == StudioBooking::class) {
                $total += $this->getTotalStudioBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
            } else {
                continue;
            }
        }

        if (!is_null($promoValue)) {
            return $total - $promoValue;
        }
        return $total;
    }

    public function getTotal($isSoft = false)
    {
        $total = 0;
        $data = MyCart::where('user_id', auth()->user()->id)->get();
        foreach ($data as $d) {
            if ($isSoft && $d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
                continue;
            }

            if ($d->object_type == PostcardBooking::class) {
                $total += $this->getTotalPostcardBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else if ($d->object_type == PosterBooking::class) {
                $total += $this->getTotalPosterBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else if ($d->object_type == FrameAlbumBooking::class) {
                $total += $this->getTotalFrameBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else if ($d->object_type == PassportBooking::class) {
                $total += $this->getTotalPassportBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else if ($d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else if ($d->object_type == StudioBooking::class) {
                $total += $this->getTotalStudioBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else if ($d->object_type == ProductBooking::class) {
                $total += $this->getTotalProductBooking($this->getObjectMorph($d->object_type, $d->object_id));
            } else {
                continue;
            }
        }
        return $total;
    }

    public function getTax()
    {
        $total = 0;
        $data = MyCart::where('user_id', auth()->user()->id)->get();
        foreach ($data as $d) {
            if ($d->object_type == PostcardBooking::class) {
                $total += $this->getTotalPostcardBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else if ($d->object_type == PosterBooking::class) {
                $total += $this->getTotalPosterBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else if ($d->object_type == FrameAlbumBooking::class) {
                $total += $this->getTotalFrameBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else if ($d->object_type == PassportBooking::class) {
                $total += $this->getTotalPassportBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else if ($d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else if ($d->object_type == StudioBooking::class) {
                $total += $this->getTotalStudioBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else if ($d->object_type == ProductBooking::class) {
                $total += $this->getTotalProductBooking($this->getObjectMorph($d->object_type, $d->object_id), true);
            } else {
                continue;
            }
        }
        return $total;
    }

    public function getDiscount($isSoft = false)
    {
        $total = 0;
        $data = MyCart::where('user_id', auth()->user()->id)->get();
        foreach ($data as $d) {
            if ($isSoft && $d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id), false, false, true);
                continue;
            }

            if ($d->object_type == PostcardBooking::class) {
                $total += $this->getTotalPostcardBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else if ($d->object_type == PosterBooking::class) {
                $total += $this->getTotalPosterBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else if ($d->object_type == FrameAlbumBooking::class) {
                $total += $this->getTotalFrameBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else if ($d->object_type == PassportBooking::class) {
                $total += $this->getTotalPassportBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else if ($d->object_type == SoftcopyBooking::class) {
                $total += $this->getTotalSoftBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else if ($d->object_type == StudioBooking::class) {
                $total += $this->getTotalStudioBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else if ($d->object_type == ProductBooking::class) {
                $total += $this->getTotalProductBooking($this->getObjectMorph($d->object_type, $d->object_id), false, true);
            } else {
                continue;
            }
        }
        return $total;
    }

    public function quantity(Request $request)
    {
        $validator = Validator($request->all(), [
            'type_service' => 'required|string|in:passport,poster,postcard,frameOrAlbum',
            'master_service_id' => 'required|numeric|exists:' . $this->masterValidate($request->type_service),
            'booking_id' => 'required|numeric|exists:' . $this->bookingValidate($request->type_service),
            'copies' => 'nullable|numeric',
            'photo_num' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
        ]);
        if (!$validator->fails()) {
            $update = $this->setBooking($request);
            if (!is_bool($update)) {
                return $update;
            }
            return response()->json(new SuccessResponse('UPDATE_SUCCESS', null, false), Response::HTTP_OK);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    private function setBooking(Request $request)
    {
        switch ($request->type_service) {
            case 'passport':
                return $this->editPassportBooing($request);
                break;
            case 'postcard':
                return $this->editPostcardBooing($request);
                break;
            case 'poster':
                return $this->editPosterBooing($request);
                break;
            case 'frameOrAlbum':
                return $this->editFrameBooing($request);
                break;
        }
    }


    private function editPassportBooing(Request $request)
    {
        $booking = PassportBooking::find($request->booking_id);
        if ($booking->passport_service_id != $request->master_service_id || $booking->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NO_ACCESS_PERMISSION'), Response::HTTP_BAD_REQUEST);
        }

        $booking->quantity = $request->quantity;
        $isSave = $booking->save();

        if (!$isSave) {
            return response()->json(new ErrorResponse('ERROR_SEND'), Response::HTTP_BAD_REQUEST);
        }

        return true;
    }

    private function editFrameBooing(Request $request)
    {
        $booking = FrameAlbumBooking::find($request->booking_id);
        if ($booking->frame_album_service_id != $request->master_service_id) {
            return response()->json(new ErrorResponse('NO_ACCESS_PERMISSION'), Response::HTTP_BAD_REQUEST);
        }
        $booking->quantity = $request->quantity;
        $isSave = $booking->save();
        if (!$isSave) {
            return response()->json(new ErrorResponse('ERROR_SEND'), Response::HTTP_BAD_REQUEST);
        }
        return true;
    }

    private function editPosterBooing(Request $request)
    {
        $booking = PosterBooking::find($request->booking_id);
        if ($booking->posterprint_service_id != $request->master_service_id || $booking->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NO_ACCESS_PERMISSION'), Response::HTTP_BAD_REQUEST);
        }

        if (is_null($request->copies) || is_null($request->photo_num)) {
            return response()->json(new ErrorResponse('ERROR_COPIS_PHOTO'), Response::HTTP_BAD_REQUEST);
        }

        if ($booking->package->num_item_over < $request->photo_num) {
            return response()->json(new ErrorResponse('ERROR_MAX_PHOTO_NUM'), Response::HTTP_BAD_REQUEST);
        }

        $booking->photo_num = $request->photo_num;
        $booking->copies = $request->copies;
        $isSave = $booking->save();

        if (!$isSave) {
            return response()->json(new ErrorResponse('ERROR_SEND'), Response::HTTP_BAD_REQUEST);
        }

        return true;
    }

    private function editPostcardBooing(Request $request)
    {

        $booking = PostcardBooking::find($request->booking_id);
        if ($booking->postcard_service_id != $request->master_service_id || $booking->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NO_ACCESS_PERMISSION'), Response::HTTP_BAD_REQUEST);
        }

        if (is_null($request->copies) || is_null($request->photo_num)) {
            return response()->json(new ErrorResponse('ERROR_COPIS_PHOTO'), Response::HTTP_BAD_REQUEST);
        }

        if ($booking->subOptions->num_item_over < $request->photo_num) {
            return response()->json(new ErrorResponse('ERROR_MAX_PHOTO_NUM'), Response::HTTP_BAD_REQUEST);
        }

        $booking->photo_num = $request->photo_num;
        $booking->copies = $request->copies;
        $isSave = $booking->save();

        if (!$isSave) {
            return response()->json(new ErrorResponse('ERROR_SEND'), Response::HTTP_BAD_REQUEST);
        }

        return true;
    }

    private function masterValidate($type)
    {
        switch ($type) {
            case 'passport':
                return "passport_services,id";
                break;
            case 'postcard':
                return "postcard_services,id";
                break;
            case 'poster':
                return "posterprint_services,id";
                break;
            case 'frameOrAlbum':
                return "frame_album_services,id";
                break;
        }
    }

    private function bookingValidate($type)
    {
        switch ($type) {
            case 'passport':
                return "passport_bookings,id";
                break;
            case 'postcard':
                return "postcard_bookings,id";
                break;
            case 'poster':
                return "poster_bookings,id";
                break;
            case 'frameOrAlbum':
                return "frame_album_bookings,id";
                break;
        }
    }

    private function totalDetails()
    {
        return  [
            'cuerrncy' => auth()->user()->currencyCode,
            'tax' => (float) number_format($this->getTax(), 2),
            'subtotal' => (float) number_format($this->getSubTotal(), 2),
            'discounts' => (float)  number_format($this->getDiscount(), 2),
            'delivery' => (float) auth()->user()->deliveryPrice,
            'total' => (float) number_format($this->getTotal(), 2)
        ];
    }



    public function getTotalPostcardBooking(PostcardBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {
            $imageCount = $data->images->count();
            $priceImage = $data->subOptions->priceKey;
            $servicPrice = ($priceImage * $imageCount) * $data->copies; // سعر الخدمة تساوي الصور في سعر الصورة
            $discount = $servicPrice * ($data->subOptions->discount_value / 100);

            if ($subTotal) {
                $subtotal = $servicPrice;
            } else {
                $subtotal = $servicPrice - $discount;
            }


            if ($getTax) {
                if ($data->masterService->is_tax) {
                    return ($subtotal * ($data->masterService->tax / 100));
                }
                return 0;
            }

            if ($getDiscount) {
                return $discount;
            }


            if ($data->masterService->is_tax && !$subTotal) {
                return $subtotal + ($subtotal * ($data->masterService->tax / 100));
            }

            $booking = PostcardBooking::find($data->id);
            $booking->update([
                'total' => $subtotal,
                'currency_id' => auth('user-api')->user()->currency
            ]);
            return $subtotal;
        }
        return 0;
    }


    public function getTotalPosterBooking(PosterBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {
            $imageCount = $data->images->count();
            $priceImage = $data->package->priceService; // سعر الخدمة تساوي الصور في سعر الصورة
            $printChoice = $data->printType->priceService;
            $frameChoice = $data->frameType->priceService;
            $printColorChoice = $data->printColor->priceService;

            $choices = ($printChoice + $frameChoice + $printColorChoice);
            $servicPrice = (($priceImage * $imageCount) + ($choices * $imageCount)) * $data->copies;

            $discount = $servicPrice * ($data->package->discount_value / 100);

            if ($subTotal) {

                $subtotal = $servicPrice;
            } else {
                $subtotal = $servicPrice - $discount;
            }


            // ارجاع قيمة الضريبة
            if ($getTax) {
                if ($data->masterService->is_tax) {
                    return ($subtotal * ($data->masterService->tax / 100));
                }
                return 0;
            }

            if ($getDiscount) {
                return $discount;
            }


            if ($data->masterService->is_tax && !$subTotal) {
                return $subtotal  + ($subtotal * ($data->masterService->tax / 100));
            }

            $booking = PosterBooking::find($data->id);
            $booking->update([
                'total' => $subtotal,
                'currency_id' => auth('user-api')->user()->currency
            ]);
            return $subtotal;
        }
        return 0;
    }

    public function getTotalFrameBooking(FrameAlbumBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {

            // Price for one image
            $imageCount = $data->images->count();
            $priceImage = $data->size?->qsSize?->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0; // سعر الخدمة تساوي الصور في سعر الصورة
            $totalImage = $priceImage * $imageCount;

            // Price for one item
            // $sizePrice =  $data->frameOrAlbum?->priceData?->priceKey ?? 0;
            $sizePrice =  $data->size->product->priceKey ?? 0;
            $servicPrice = ($sizePrice * $data->quantity) + $totalImage;
            $discount = ($servicPrice * ($data->frameOrAlbum?->discount_value / 100));

            if ($subTotal) {
                $subtotal = $servicPrice;
            } else {
                $subtotal = $servicPrice - $discount;
            }

            if ($getTax) {
                if ($data->masterService->is_tax) {
                    return ($subtotal * ($data->masterService->tax / 100));
                }
                return 0;
            }

            if ($getDiscount) {
                return $discount;
            }


            if ($data->masterService->is_tax && !$subTotal) {
                return $subtotal  + ($subtotal * ($data->masterService->tax / 100));
            }

            $booking = FrameAlbumBooking::find($data->id);
            $booking->update([
                'total' => $subtotal,
                'currency_id' => auth('user-api')->user()->currency
            ]);
            return $subtotal;
        }
        return 0;
    }

    public function getTotalPassportBooking(PassportBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {
            $option = PassportOption::where('passport_country_id', $data->passport_country_id)->where('passport_type_id', $data->passport_type_id)->first();
            if (is_null($option)) {
                return 0;
            }
            $basePrice = $option->price->where('currency_id', auth()->user()->currency)->first()?->price  ?? 0;
            $pricePhotoAfterIncrse = $option->priceAfterIncres->where('currency_id', auth()->user()->currency)->first()?->price  ?? 0; // مقدار الخصم بعد الزيادة
            $price = ($basePrice * 0.5); // مقدار الزيادة على السعر الاساسي
            $baseCountImage = $option->num_photo; // العدد الاساسي
            $num_add = $option->num_add; // معدل الزيادة
            $quantity = $data->quantity; // الكمية المطلوبة
            $incrseCount = (($quantity - $baseCountImage) / $num_add);
            $priceIncrse = $incrseCount * $price;
            $discount = $incrseCount * $pricePhotoAfterIncrse; // الخصم هو قيمه الخصم بعد الزيادة 
            $subtotal = $basePrice + $priceIncrse;

            if ($data->masterService->is_tax && !$subTotal) {
                $tax = ($subtotal - $discount) * ($data->masterService?->tax / 100); // قيمة الضريبة
            } else {
                $tax = 0; // قيمة الضريبة
            }
            $total = ($subtotal - $discount) + $tax;

            if ($getTax) {
                if ($data->masterService->is_tax) {
                    return $tax;
                }
                return 0;
            }

            if ($getDiscount) {
                return $discount;
            }

            $booking = PassportBooking::find($data->id);
            $booking->update([
                'total' => $total,
                'currency_id' => auth('user-api')->user()->currency
            ]);
            return $subTotal ? $total + $discount : $total;
        }
        return 0;
    }


    public function getTotalStudioBooking(StudioBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {
            $service = ServicesBookingStudio::find($data->services_booking_studio_id);
            if (is_null($service)) {
                return 0;
            }
            $basePrice = $service->priceKey  ?? 0;
            $pricePhotoAfterIncrse = $service->priceAfterIncresKey  ?? 0; // مقدار الخصم بعد الزيادة
            $price = ($basePrice * 0.5); // مقدار الزيادة على السعر الاساسي
            $baseCountImage = $service->num_photo; // العدد الاساسي
            $num_add = $service->num_add; // معدل الزيادة
            $quantity = $data->qty; // الكمية المطلوبة
            $incrseCount = (($quantity - $baseCountImage) / $num_add);
            $priceIncrse = $incrseCount * $price;
            $discount = $incrseCount * $pricePhotoAfterIncrse; // الخصم هو قيمه الخصم بعد الزيادة 
            $subtotal = ($basePrice + $priceIncrse) * $data->people_num;

            if ($data->masterService->is_tax && !$subTotal) {
                $tax = ($subtotal - $discount) * ($data->masterService?->tax / 100); // قيمة الضريبة
            } else {
                $tax = 0; // قيمة الضريبة
            }
            $total = ($subtotal - $discount) + $tax;

            if ($getTax) {
                if ($data->masterService->is_tax) {
                    return $tax;
                }
                return 0;
            }

            if ($getDiscount) {
                return $discount;
            }

            $booking = StudioBooking::find($data->id);
            $booking->update([
                'total' => $total,
                'currency_id' => auth('user-api')->user()->currency
            ]);
            return $subTotal ? $total + $discount : $total;
        }
        return 0;
    }

    public function getTotalProductBooking(ProductBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {

            $product = Product::find($data->product_id);
            $price = $product->priceKey;
            $subtotal = $data->amount * $price;
            $discount = 0;

            //$data->masterService->is_tax && 
            // if (!$subTotal) {
            //     $tax = 0; // قيمة الضريبة
            // } else {
            //     $tax = 0; // قيمة الضريبة
            // }
            // $total = ($subtotal - $discount) + $tax;
            $total = ($subtotal - $discount);

            // if ($getTax) {
            //     if (false) {
            //         return $tax;
            //     }
            //     return 0;
            // }

            if ($getDiscount) {
                return $discount;
            }

            return $subTotal ? $total + $discount : $total;
        }
        return 0;
    }



    public function getTotalSoftBooking($data)
    {
        $subTotal = $data->price;
        return $subTotal;
    }




    private function getObjectMorph($obj, $id)
    {
        switch ($obj) {
            case PosterBooking::class:
            case "poster":
                return PosterBooking::find($id);
                break;

            case PostcardBooking::class:
            case "postcard":
                return PostcardBooking::find($id);
                break;

            case FrameAlbumBooking::class:
            case "frameOrAlbum":
                return FrameAlbumBooking::find($id);
                break;

            case PassportBooking::class:
            case "passport":
                return PassportBooking::whereId($id)->with('images')->first();
                break;

            case SoftcopyBooking::class:
            case "softcopy":
                return SoftcopyBooking::find($id);
                break;

            case StudioBooking::class:
            case "studio":
                return StudioBooking::find($id);
                break;
            case ProductBooking::class:

            case "product":
                return ProductBooking::find($id);
                break;
        }
    }

    private function getObjectName($obj)
    {
        switch ($obj) {
            case 'poster':
                return PosterBooking::class;
                break;

            case 'postcard':
                return PostcardBooking::class;
                break;

            case 'frameOrAlbum':
                return FrameAlbumBooking::class;
                break;

            case 'passport':
                return PassportBooking::class;
                break;

            case 'softcopy':
                return SoftcopyBooking::class;
                break;

            case 'studio':
                return StudioBooking::class;
                break;
        }
    }

    private function deleteMyCart($request)
    {
        $deleteOnCart = MyCart::where('object_type', $this->getObjectName($request->service_type))
            ->where('user_id', auth()->user()->id)->where('object_id', $request->service_id)->delete();
        return $deleteOnCart;
    }
}
