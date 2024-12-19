<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paymentOrder(){
        return $this->hasOne(PaymentOrder::class,'order_id','id')->latest();
    }
    
    public function userAddress(){
        return $this->belongsTo(UserAddress::class,'user_address_id','id');
    }
    public function orderStatus(){
        return $this->belongsTo(OrderStatus::class,'order_status_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function services(){
        return $this->hasMany(OrderService::class,'order_id','id');
    }
    public function date(){
        return $this->belongsTo(QsDateOrder::class,'qs_date_order_id','id');
    }
    public function answerGeneralQs(){
        return $this->belongsToMany(QsGeneralOrder::class,'answer_general_orders','order_id','qs_general_order_id')->withPivot('answer');
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }

    public function studios(){
        return $this->hasMany(OrderStudio::class,'order_id','id');
    }

    public function orderDate(){
        return $this->belongsTo(QsDateOrder::class,'qs_date_order_id','id');
    }

    public function studioSendOrder(){
        return $this->belongsTo(StudioBranch::class,'studio_branch_id','id');
    }


    public function statusPaid() : Attribute {
        return new Attribute(get: function(){

            if($this->isSoftCopy){
                $confirmed = SoftcopyConfirm::where('softcopy_booking_id',$this->softcopy_booking_id)->exists();
                return $confirmed;
            }

            $paymentOrder = $this->paymentOrder;
            return !is_null($paymentOrder) && $paymentOrder->status == 'success';

        });
    }

}
