<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReservationRequest;

// REPOSITORIES
use App\Repositories\ReservationRepo;
use App\Repositories\ReservationServiceRepo;

use App\Models\Salon;
use App\Models\SalonService;
use App\Models\SalonServiceOffer;
use App\Models\Promocode;
use App\Models\PaymentType;

class ReservationController extends Controller
{
    protected $reservationRepo;
    protected $reservationServiceRepo;

    public function __construct(ReservationRepo $reservationRepo, ReservationServiceRepo $reservationServiceRepo) {
        $this->reservationRepo        = $reservationRepo;
        $this->reservationServiceRepo = $reservationServiceRepo;
    }

    public function reservation(Request $request) {      
        
        // GET SALON
        $salon       = Salon::find($request->salon_id);
        $promocode   = Promocode::where('code', @$request->promocode)->first();
        $paymentType = PaymentType::find(@$request->payment_type_id);
        
        // PRICES CALCULATIONS
        $totalFixedPrice                  = 0;
        $totalDiscountAmount              = 0;
        $totalDiscountedPrice             = 0;
        $totalHomeServiceFees             = 0;
        $totalTaxAmount                   = 0;
        $totalFinalPrice                  = 0;
        // HERMOSA CALCULATIONS
        $totalSalonProfitAmount           = 0;
        $totalHermosaProfitAmount         = 0;
        $totalHermosaTaxAmount            = 0;
        $totalHermosaProfitAmountAfterTax = 0;
        $totalCharityAmount               = 0;
        $totalZakatAmount                 = 0;
        $totalHermosaFinalProfitAmount    = 0; 
        // FIXED PERCENTAGES
        $countryTaxPercentage    = $salon->country->tax_percentage;
        $hermosaPercentage       = $salon->percentage;
        $charityAmountPercentage = 2;
        $zakatAmountPercentage   = 2;

        foreach($request->services as $serviceData) 
        {
            // GET SERVICE DETAILS
            $salonService      = SalonService::find($serviceData['service_id']);
            $salonServiceOffer = SalonServiceOffer::find(@$serviceData['offer_id']);

            // SERVICE PRICES CALCULATION
            $homeServiceFees = $salonService->home_service_fees;
            $discountOwner   = null;
            $fixedPrice      = $salonService->price;
            $discountAmount  = 0;
            $discountedPrice = $salonService->price;
            $taxAmount       = round(($discountedPrice + $homeServiceFees) * ($countryTaxPercentage / 100), 2);
            $finalPrice      = $discountedPrice + $homeServiceFees + $taxAmount;
            
            // HERMOSA CALCULATION
            $salonProfitAmount   = round($finalPrice * ((100 - $hermosaPercentage) / 100), 2);
            $hermosaProfitAmount = round($finalPrice * ($hermosaPercentage / 100), 2);
            
            // IF HAS PROMOCODE
            if($promocode) {
                $discountAmount  = round($fixedPrice * ($promocode->percentage / 100), 2);
                $discountedPrice = round($fixedPrice - $discountAmount, 2);
                $taxAmount       = round(($discountedPrice + $homeServiceFees) * ($countryTaxPercentage / 100), 2);
                $discountOwner   = $promocode->owner_type;
                $finalPrice      = round($discountedPrice + $homeServiceFees + $taxAmount, 2);

                // HERMOSA CALCULATION
                $salonProfitAmount   = round($finalPrice * ((100 - $hermosaPercentage) / 100), 2);
                $hermosaProfitAmount = round($finalPrice * ($hermosaPercentage / 100), 2);
                
                // HERMOSA CALCULATION
                if($discountOwner === "SALON") {
                    $salonProfitAmount -= $discountAmount;
                } elseif($discountOwner === "HERMOSA") {
                    $hermosaProfitAmount -= $discountAmount;
                }else {
                    $salonProfitAmount   -= round($discountAmount * ((100 - $hermosaPercentage) / 100), 2);
                    $hermosaProfitAmount -= round($discountAmount * ($hermosaPercentage / 100), 2);
                    // return $salonProfitAmount;
                }

            } 
            else if($salonServiceOffer) // ELSE IF SERVICE HAS OFFER
            {
                $discountOwner   = "SALON";
                $discountAmount  = $salonService->price - $salonServiceOffer->new_price;
                $discountedPrice = $salonServiceOffer->new_price;
                $taxAmount       = round($discountedPrice * ($countryTaxPercentage / 100), 2);
                $finalPrice      = $discountedPrice + $homeServiceFees + $taxAmount;

                // HERMOSA CALCULATION
                $salonProfitAmount   = round(($finalPrice * ((100 - $hermosaPercentage) / 100)) - $discountAmount, 2);
                $hermosaProfitAmount = round($finalPrice * ($hermosaPercentage / 100), 2);
            } 

            //HERMOSA CALCULATION 
            $hermosaTaxAmount            = round($hermosaProfitAmount * ($countryTaxPercentage / 100), 2);
            $hermosaProfitAmountAfterTax = round($hermosaProfitAmount - $hermosaTaxAmount, 2);
            $charityAmount               = round($hermosaProfitAmountAfterTax * ( $charityAmountPercentage / 100), 2);
            $zakatAmount                 = round($hermosaProfitAmountAfterTax * ( $zakatAmountPercentage / 100), 2);
            $hermosaFinalProfitAmount    = round($hermosaProfitAmountAfterTax - ($charityAmount + $zakatAmount), 2);

            // RESERVATIONS SERVICES DATA
            $reservationServicesData[] = [
                'salon_service_id'                => $salonService->id,
                'employee_id'                     => $serviceData['employee_id'],
                'date'                            => $request->date,
                'time'                            => $serviceData['time'],
                
                'promocode_id'                    => $request->promocode_id,
                'discount_owner'                  => $discountOwner,
                'fixed_price'                     => $fixedPrice,
                'discount_amount'                 => $discountAmount,
                'discounted_price'                => $discountedPrice,
                'home_service_fees'               => $homeServiceFees,
                'tax_amount'                      => $taxAmount,
                'final_price'                     => $finalPrice,

                'salon_profit_amount'             => $salonProfitAmount,
                'hermosa_profit_amount'           => $hermosaProfitAmount,
                'hermosa_tax_amount'              => $hermosaTaxAmount,
                'hermosa_profit_amount_after_tax' => $hermosaProfitAmountAfterTax,
                'charity_amount'                  => $charityAmount,
                'zakat_amount'                    => $zakatAmount,
                'hermosa_final_profit_amount'     => $hermosaFinalProfitAmount,
            ];

            // TOTAL PRICES CALCULATION
            $totalFixedPrice      += $fixedPrice;
            $totalDiscountAmount  += $discountAmount;
            $totalDiscountedPrice += $discountedPrice;
            $totalHomeServiceFees += $homeServiceFees;
            $totalTaxAmount       += $taxAmount;
            $totalFinalPrice      += $finalPrice;

            // TOTAL HERMOSA CALCULATION
            $totalSalonProfitAmount           += $salonProfitAmount;
            $totalHermosaProfitAmount         += $hermosaProfitAmount;
            $totalHermosaTaxAmount            += $hermosaTaxAmount;
            $totalHermosaProfitAmountAfterTax += $hermosaProfitAmountAfterTax;
            $totalCharityAmount               += $charityAmount;
            $totalZakatAmount                 += $zakatAmount;
            $totalHermosaFinalProfitAmount    += $hermosaFinalProfitAmount;
        }

        if($request->is_deposit && $paymentType != 'CASH') {
            $paidAmount   = round(($salon->deposit_percentage / 100) * $totalFinalPrice);
            $unpaidAmount = round($totalFinalPrice - $paidAmount, 1);
        } else {
            $paidAmount   = $totalFinalPrice;
            $unpaidAmount = 0;
        }

        $status = $paymentType->type === 'CASH' ? 'PENDING' : 'WAITING_PAYMENT';

        // RESERVATION DATA
        $reservationData = [
            'salon_id'                        => $request->salon_id,
            'user_id'                         => @auth()->user()->id || 1,
            'service_type'                    => $request->home_service ? 'HOME_SERVICE' : 'SALON_SERVICE',
            'status'                          => $status, // PENDING - WAITING_PAYMENT - ACCEPTED - FINISHED - CANCELLED
            'payment_status'                  => 'UNPAID', // UNPAID - PAID - PARTIALLY_PAID - REFUNDED - PARTIALLY_REFUNDED
            'payment_type_id'                 => $request->payment_type_id,
            'promocode_id'                    => $request->promocode_id,
            'lat'                             => $request->lat,
            'lng'                             => $request->lng,
            
            'discount_owner'                  => $discountOwner,
            'fixed_price'                     => $totalFixedPrice,
            'discount_amount'                 => $totalDiscountAmount,
            'discounted_price'                => $totalDiscountedPrice,
            'home_service_fees'               => $totalHomeServiceFees,
            'tax_amount'                      => $totalTaxAmount,
            'final_price'                     => $totalFinalPrice,
            'paid_amount'                     => $paidAmount,
            'unpaid_amount'                   => $unpaidAmount,
            'salon_profit_amount'             => $totalSalonProfitAmount,
            'hermosa_profit_amount'           => $totalHermosaProfitAmount,
            'hermosa_tax_amount'              => $totalHermosaTaxAmount,
            'hermosa_profit_amount_after_tax' => $totalHermosaProfitAmountAfterTax,
            'charity_amount'                  => $totalCharityAmount,
            'zakat_amount'                    => $totalZakatAmount,
            'hermosa_final_profit_amount'     => $totalHermosaFinalProfitAmount,
        ];
        
        // CREATE RESERVATION 
        $reservation = $this->reservationRepo->create($reservationData);

        // UPDATE RESERVATION SERVICES WITH RESERVATION_ID
        foreach ($reservationServicesData as $reservationServiceData) {
            $reservationServiceData['reservation_id'] = $reservation->id;
            $updatedReservationServicesData[] = $reservationServiceData;
        }

        // CREATE RESERVATION 
        $reservationServices = $this->reservationServiceRepo->insert($updatedReservationServicesData);

        // RETURN RESPONSE WITH SUCCESS MESSAGE
        return response()->json(['success' => __('messages.has_been_created')], 201);
    }

    public function checkout(Request $request) {

        // GET SALON
        $salon       = Salon::find($request->salon_id);
        $promocode   = Promocode::where('code', @$request->promocode)->first();
        $paymentType = PaymentType::find(@$request->payment_type_id);
        
        // PRICES CALCULATIONS
        $totalFixedPrice        = 0;
        $totalDiscountAmount    = 0;
        $totalDiscountedPrice   = 0;
        $totalHomeServiceFees   = 0;
        $totalTaxAmount         = 0;
        $totalFinalPrice        = 0;

        // FIXED PERCENTAGES
        $countryTaxPercentage   = $salon->country->tax_percentage;

        foreach($request->services as $serviceData) 
        {
            // GET SERVICE DETAILS
            $salonService      = SalonService::find($serviceData['service_id']);
            $salonServiceOffer = SalonServiceOffer::find(@$serviceData['offer_id']);

            // SERVICE PRICES CALCULATION
            $homeServiceFees = $salonService->home_service_fees;
            $discountOwner   = null;
            $fixedPrice      = $salonService->price;
            $discountAmount  = 0;
            $discountedPrice = $salonService->price;
            $taxAmount       = round(($discountedPrice + $homeServiceFees) * ($countryTaxPercentage / 100), 2);
            $finalPrice      = $discountedPrice + $homeServiceFees + $taxAmount;
            
            // IF HAS PROMOCODE
            if($promocode) {
                $discountAmount  = round($fixedPrice * ($promocode->percentage / 100), 2);
                $discountedPrice = round($fixedPrice - $discountAmount, 2);
                $taxAmount       = round(($discountedPrice + $homeServiceFees) * ($countryTaxPercentage / 100), 2);
                $discountOwner   = $promocode->owner_type;
                $finalPrice      = round($discountedPrice + $homeServiceFees + $taxAmount, 2);
            } 
            else if($salonServiceOffer) // ELSE IF SERVICE HAS OFFER 
            {
                $discountOwner   = "SALON";
                $discountAmount  = $salonService->price - $salonServiceOffer->new_price;
                $discountedPrice = $salonServiceOffer->new_price;
                $taxAmount       = round($discountedPrice * ($countryTaxPercentage / 100), 2);
                $finalPrice      = $discountedPrice + $homeServiceFees + $taxAmount;
            } 

            // TOTAL PRICES CALCULATION
            $totalFixedPrice      += $fixedPrice;
            $totalDiscountAmount  += $discountAmount;
            $totalDiscountedPrice += $discountedPrice;
            $totalHomeServiceFees += $homeServiceFees;
            $totalTaxAmount       += $taxAmount;
            $totalFinalPrice      += $finalPrice;
        }

        if($request->is_deposit && $paymentType != 'CASH') {
            $paidAmount   = round(($salon->deposit_percentage / 100) * $totalFinalPrice);
            $unpaidAmount = round($totalFinalPrice - $paidAmount, 1);
        } else {
            $paidAmount   = $totalFinalPrice;
            $unpaidAmount = 0;
        }

        $response = [
            'promocode_id'                    => @$promocode->id,            
            'discount_owner'                  => $discountOwner,
            'fixed_price'                     => $totalFixedPrice,
            'discount_amount'                 => $totalDiscountAmount,
            'discounted_price'                => $totalDiscountedPrice,
            'home_service_fees'               => $totalHomeServiceFees,
            'tax_amount'                      => $totalTaxAmount,
            'final_price'                     => $totalFinalPrice,
            'paid_amount'                     => $paidAmount,
            'unpaid_amount'                   => $unpaidAmount,
        ];
        
        return response()->json($response, 200);
    }

}