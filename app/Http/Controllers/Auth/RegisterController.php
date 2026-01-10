<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Drivers;
use App\Models\Managers;

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
        return view('auth.register');
    }
   public function register(\Illuminate\Http\Request $request)
{
    // 1. تحقق من البيانات
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // 2. أنشئ المستخدم
    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        //'Address' => $validated['Address'],
        'phone_number' => $validated['phone_number'],
    ]);

    $user->addRole('student');

    // if ($validated['user_type'] === 'driver') {
    //         Drivers::create([
    //             'users_id' => $user->id,
    //             'Driver_Name' => $validated['name'],
    //             'Driver_Phone' => $validated['Driver_Phone'],
    //             'Driver_license_num' => $validated['Driver_license_num'],
    //         ]);

    //         //  الخطوة 1: ربط دور 'driver' في جداول Laratrust
    //         $user->attachRole('driver');

    //     }
    //     elseif ($validated['user_type'] === 'admin')
    //          {
    //             Managers::create([
    //             'users_id' => $user->id,
    //             'manager_name' => $validated['name'],
    //             'phone_number' => $validated['phone_number'],
    //         ]);

    //        // الخطوة 2: ربط دور 'admin' في جداول Laratrust
    //         $user->attachRole('admin');


    //     }
    //     elseif ($validated['user_type'] === 'student') {
    //         //  الخطوة 3: ربط دور 'student' في جداول Laratrust
    //         $user->attachRole('student');
    //     }
    //           // 3. سجل الدخول
    // \Illuminate\Support\Facades\Auth::login($user);
    // // 4. توجيه للصفحة الرئيسية

    //   if ($user->user_type === 'driver')
    //      {
    //         return redirect()->route('driver.dashboard');
    //     }
    //     elseif ($user->user_type === 'admin') {
    //         return redirect()->route('manager.mdashboard');
    //     }
    //     else
    //     {
    //       return redirect()->route('student.dashboard');

    //     }


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
