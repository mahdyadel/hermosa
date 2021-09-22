<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Models\Salon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// REPOSITORIES
use App\Repositories\CountryRepo;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name_ar'                   => 'required|string|max:191',
            'name_en'                   => 'required|string|max:191',
            'photo'                     => 'nullable|string|max:191',
            'phone'                     => 'required|string|max:191',
            'phone_2'                   => 'nullable|string|max:191',
            'bank_name'                 => 'required|string|max:191',
            'bank_account_number'       => 'required|string|max:191',
            'bank_account_number_pdf'   => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
            'bank_name_2'               => 'nullable|string|max:191',
            'bank_account_number_2'     => 'nullable|string|max:191',
            'bank_account_number_2_pdf' => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
            'tax_number'                => 'nullable|string|max:191',
            'tax_number_pdf'            => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
            'commercial_register'       => 'nullable|string|max:191',
            'commercial_register_pdf'   => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
            'country_id'                => 'required|integer|exists:countries,id',
            'city_id'                   => 'required|integer|exists:cities,id',
            'owner_name'                => 'required|string|max:255',
            'owner_email'               => 'required|string|email|max:255|unique:users,email',
            'owner_phone'               => 'required|string|max:191',
            'owner_password'            => 'required|string|min:6',
        ]);
    }

    public function showRegistrationForm(CountryRepo $countryRepo) {
        $countries = $countryRepo->get();
        return view('auth.register', compact('countries'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $updatedData = [
            'name_ar'               => $data['name_ar'],
            'name_en'               => $data['name_en'],
            // 'lat'                   => $data['salon_lat'],
            // 'lng'                   => $data['salon_lng'],
            'phone'                 => $data['phone'],
            'phone_2'               => $data['phone_2'],
            'bank_name'             => $data['bank_name'],
            'bank_account_number'   => $data['bank_account_number'],
            'bank_name_2'           => $data['bank_name_2'],
            'bank_account_number_2' => $data['bank_account_number_2'],
            'tax_number'            => $data['tax_number'],
            'commercial_register'   => $data['commercial_register'],
            'country_id'            => $data['country_id'],
            'city_id'               => $data['city_id'],
            'percentage'            => 30
        ];

        if (isset($data['photo'])) {
            $image = str_replace(" ", "-", $updatedData['name_en'])."-image.".$request->photo->extension();
            $updatedData['main_photo'] = $image;
            $request->photo->storeAs('/public/salons', $image);
        }
      
        if (isset($data['logo'])) {
            $logo = str_replace(" ", "-", $updatedData['name_en']."".time())."-logo.".$request->logo->extension();
            $updatedData['logo'] = $logo;
            $request->logo->storeAs('/public/salons', $logo);
        }
      
        if (isset($data['bank_account_number_pdf'])) {
            $bank_account_number_pdf = str_replace(" ", "-", $updatedData['name_en']."".time())."-bank-account-number.".$data['bank_account_number_pdf']->extension();
            $updatedData['bank_account_number_pdf'] = $bank_account_number_pdf;
            $data['bank_account_number_pdf']->storeAs('/public/salons', $bank_account_number_pdf);
        }
      
        if (isset($data['bank_account_number_2_pdf'])) {
            $bank_account_number_2_pdf = str_replace(" ", "-", $updatedData['name_en']."".time())."-bank-account-number-2.".$request->bank_account_number_2_pdf->extension();
            $updatedData['bank_account_number_2_pdf'] = $bank_account_number_2_pdf;
            $request->bank_account_number_2_pdf->storeAs('/public/salons', $bank_account_number_2_pdf);
        }
      
        if (isset($data['tax_number_pdf'])) {
            $tax_number_pdf = str_replace(" ", "-", $updatedData['name_en']."".time())."-tax-number.".$request->tax_number_pdf->extension();
            $updatedData['tax_number_pdf'] = $tax_number_pdf;
            $request->tax_number_pdf->storeAs('/public/salons', $tax_number_pdf);
        }
      
        if (isset($data['commercial_register_pdf'])) {
            $commercial_register_pdf = str_replace(" ", "-", $updatedData['name_en']."".time())."-commercial-register.".$request->commercial_register_pdf->extension();
            $updatedData['commercial_register_pdf'] = $commercial_register_pdf;
            $request->commercial_register_pdf->storeAs('/public/salons', $commercial_register_pdf);
        }

        $salon = Salon::create($updatedData);

        $user = User::create([
            'name'      => $data['owner_name'],
            'phone'     => $data['owner_phone'],
            'email'     => $data['owner_email'],
            'password'  => $data['owner_password'],
            'salon_id'  => $salon->id,
            'type'      => 'SALON_OWNER',
        ]);

        $user->syncPermissions([
            'READ_SALONS',
            'UPDATE_SALONS',

            'CREATE_SALON_SERVICES',
            'READ_SALON_SERVICES',
            'UPDATE_SALON_SERVICES',
            'DELETE_SALON_SERVICES',

            'CREATE_EMPLOYEES',
            'READ_EMPLOYEES',
            'UPDATE_EMPLOYEES',
            'DELETE_EMPLOYEES',

            'CREATE_RESERVATIONS',
            'READ_RESERVATIONS',
            'UPDATE_RESERVATIONS',
            'DELETE_RESERVATIONS',

            'CREATE_ADMINS',
            'READ_ADMINS',
            'UPDATE_ADMINS',
            'DELETE_ADMINS',

            'CREATE_PROMOCODES',
            'READ_PROMOCODES',
            'UPDATE_PROMOCODES',
            'DELETE_PROMOCODES',

            'CREATE_OFFERS',
            'READ_OFFERS',
            'UPDATE_OFFERS',
            'DELETE_OFFERS',

            'CREATE_SALON_RATES',
            'READ_SALON_RATES',
            'UPDATE_SALON_RATES',
            'DELETE_SALON_RATES',

            'CREATE_EMPLOYEE_RATES',
            'READ_EMPLOYEE_RATES',
            'UPDATE_EMPLOYEE_RATES',
            'DELETE_EMPLOYEE_RATES',
        ]);

        return $user;
    }
}
