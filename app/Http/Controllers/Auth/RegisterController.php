<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Driver;
use App\Models\Manager;
use App\Models\Student;
use App\Models\Region;
use Illuminate\Http\Request;


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

    // use RegistersUsers;

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
     public function showRegistrationForm()
    {
        //return view('auth.register');
        $regions = Region::all();
        return view('auth.register', compact('regions'));
    }
   public function register(\Illuminate\Http\Request $request)
{
    // 1. تحقق من البيانات
    //      $rules =  [];

      $validated = $request->validate(
       [ 'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'region_id' => 'required|exists:regions,id',
        'phone_number' => ['required', 'regex:/^(079|078|077)[0-9]{7}$/'],
        'student_number' => 'required|string|max:9',

       // 'user_type' => 'required|in:driver,admin,student'
     ] );


   /* if ($request->user_type === 'driver')
         { $rules['driver_license_number'] = 'required|string|max:50'; }
    if ($request->user_type === 'admin')
         { $rules['experience_years'] = 'required|integer|min:0|max:99'; }
     if ($request->user_type === 'student')
         { $rules['student_number'] = 'required|string|max:9'; }
      $validated = $request->validate($rules);
*/
    // 2. أنشئ المستخدم
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        'phone_number' => $validated['phone_number'],
          'region_id' => $validated['region_id'],
    ]);

   Student::create([
    'user_id' => $user->id,
     'student_number' => $validated['student_number'],
    ]);

    /* if ($validated['user_type'] === 'driver') {
            Driver::updateOrCreate([
                'user_id' => $user->id,
               'driver_license_number' => $validated['driver_license_number']
            ]);

            $user->addRole('driver');

        }
       elseif ($validated['user_type'] === 'admin')
             {
               Manager::updateOrCreate([
                'user_id' => $user->id,
            'experience_years' => $validated['experience_years']
            ]);

            $user->addRole('admin');


       }
        elseif ($validated['user_type'] === 'student')
             {
                Student::updateOrCreate([
                   'user_id' => $user->id,
                'student_number' => $validated['student_number']

        ]); }*/
             //  الخطوة 3: ربط دور 'student' في جداول Laratrust
             $user->addRole('student');

    //           // 3. سجل الدخول
    \Illuminate\Support\Facades\Auth::login($user);



   return redirect()->route('login');
}
}
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   /* protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Address' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string', 'max:50'],
        ]);
    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    /*protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Address' => $data['Address'],
            'user_type' => $data['user_type'],

        ]);
    }*/
