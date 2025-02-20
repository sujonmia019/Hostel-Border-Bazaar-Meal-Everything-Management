<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Hostel;
use App\Traits\UploadAble;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
            'hostel_name'           => ['required', 'string', 'max:190'],
            'hostel_address'        => ['required', 'string', 'max:100'],
            'logo'                  => ['nullable','image','mimes:jpg,png','max:512','dimensions:150,150'],
            'name'                  => ['required', 'string', 'max:100'],
            'username'              => ['required', 'string', 'unique:users,username'],
            'email'                 => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:6', 'max:16', 'confirmed'],
            'password_confirmation' => ['required','string']
        ],[
            'logo.required'=>'The hostel logo field is required',
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

        DB::beginTransaction(); // Start transaction
        try {
            $hostel = Hostel::create([
                'name'    => $data['hostel_name'],
                'address' => $data['hostel_address'],
                'logo'    => $logo
            ]);

            $user = User::create([
                'hostel_id' => $hostel->id,
                'role_id'   => 2,
                'name'      => $data['name'],
                'username'  => str()->slug($data['username']),
                'email'     => $data['email'],
                'password'  => $data['password'],
            ]);

            DB::commit(); // Commit transaction
            return $user;
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            return ['error' => $e->getMessage()];
        }
    }
}
