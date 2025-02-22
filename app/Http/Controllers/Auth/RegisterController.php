<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Hostel;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers, UploadAble;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'hostel_name'           => ['required', 'string', 'max:100'],
            'hostel_address'        => ['required', 'string', 'max:100'],
            'name'                  => ['required', 'string', 'max:100'],
            'username'              => ['required', 'string', 'max:100', 'unique:users,email'],
            'email'                 => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:6', 'max:16', 'confirmed'],
            'password_confirmation' => ['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $logo = null;
        if (!empty($data['logo'])) {
            $logo = $this->uploadDataFile($data['logo'], LOGO_PATH);
        }

        $hostel = Hostel::create([
            'name'    => $data['hostel_name'],
            'address' => $data['hostel_address'],
            'logo'    => $logo
        ]);

        return User::create([
            'hostel_id' => $hostel->id,
            'role'      => 2,
            'username'  => str()->slug($data['username']),
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => $data['password'],
        ]);
    }

        /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        session()->flash('success','Your registration was successful');
    }
}
