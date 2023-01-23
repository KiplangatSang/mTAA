<?php

namespace App\Http\Controllers\Auth;

use App\Models\CountriesList;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Profiles\profiles;
use App\Providers\RouteServiceProvider;
use App\Repositories\AppRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends BaseController
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $region = $this->getLocationDetails();
        return view('auth.register', compact('region'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneno' => 'required',
            'terms_and_conditions' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $phonecode = CountriesList::where('name', $data['country'])->first()->phonecode;
        $region = $this->getLocationDetails();
        $user = User::firstOrCreate(
            [
                'username' => $data['firstname'] . " " . $data['lastname'],
                'email' => $data['email'],
            ],
            [
                'role' => $data['role'] ?? 1,
                'phoneno' => $phonecode . $data['phoneno'],
                'password' => Hash::make($data['password']),
                'terms_and_conditions' => $data['terms_and_conditions'],
                'api_token' => Str::random(60),
                'country' => $data['country'],
                'city' => $data['city'],
                'month' => date('M'),
                'year' => date('Y'),
            ]
        );

        if (!$user)
            return false;

        $noprofile = $this->getBaseImages()['noprofile'];
        $user = User::whereIn('email', $user)->first();
        $user->profiles()->create([
            "user_id" => $user->id,
            "profile_image" => $noprofile,
        ]);

        return $user;
    }

    public function apiRegister(Request $request)
    {
        $input = $request->only(
            'firstname',
            'lastname',
            'email',
            'password',
            'phoneno',
            'terms_and_conditions',
            'is_owner',
            'is_employee',
            'role',
        );

        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'c_password' => ['required|same:password', 'string', 'min:8',],
            'phoneno' => ['required', 'unique:users'],
            'terms_and_conditions' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());


        $request['password'] = Hash::make($request['password']);
        $request['terms_and_conditions'] = $request['terms_and_conditions'];
        $request['api_token'] = Str::random(60);
        $request['month'] = date('M');
        $request['year'] = date('Y');

        $user = User::firstOrCreate(
            [
                'username' => $request['firstname'] . " " . $request['lastname'],
                'email' => $request['email'],
                'phoneno' => $request['phoneno'],
            ],
            $request->except(['username', 'email', 'phoneno']),
        );
        $images = $this->getBaseImages();
        $user =  User::where('email', $user->email)->first();
        $user->profiles()->create([
            "user_id" => $user->id,
            "profile_image" => $images['noprofile'],
        ]);
        $success['user'] = $user;
        return $this->sendResponse($success, 'User registered successfully.');
    }

    public function accountDescription()
    {
        # code...
        $account = array(
            "0" => "Admin",
            "1" => "Retailer",
            "2" => "Supplier",
        );
    }

    public function supplierCreate()
    {
        # code...
        return view('auth.supplierregister');
    }
}
