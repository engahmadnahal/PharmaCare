<?php

namespace App\Http\Controllers\Payment;

use App\Models\Order;
use App\Models\SoftcopyBooking;
use App\Models\User;

interface IPayment
{
   public static function setUser(User $user) : IPayment; // Put User For Guard [User , User API]
   public static function isSoftCopy($isSoftCopy) : IPayment; // Is SoftCopy Or Order Id , This Same For unique transactions
   public function setMobile($mobile) : IPayment; // Your Mobile Number For Softcopy Or Order Id , This Same For unique transactions
   public function setUserName($userName) : IPayment; // Your User Name For Softcopy Or Order Id , This Same For unique transactions
   public function setSoftcopyBooking(?SoftcopyBooking $softcopyBooking) : IPayment; // Your Transaction Id Or Order Id , This Same For unique transactions
   public function setOrderId($orderId) : IPayment; // Your Transaction Id Or Order Id , This Same For unique transactions
   public function setOrder(?Order $order) : IPayment; // Select Currency Code
   public function setAmount($amount) : IPayment; // Amount Before Transaction
   public function getAmount(); // Get Amount On Payment Get Way
   public function setCurrencyCode($currency) : IPayment; // Select Currency Code
   public function getCurrencyCode(); // Select Currency Code
   public function getOrderId() ; // Transaction Id In Payment Get Way 
   public function getRedirectUrl() ; // [Url] Return Payment Get Way 
   public function getTransaction(); // Get Transaction Data
   public function pay() ; // For Perform Transaction
   // public function setStudio(?StudioBranch $std) : IPayment; 
   
   
   
}
