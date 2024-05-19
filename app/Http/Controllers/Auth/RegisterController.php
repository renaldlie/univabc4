<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class RegisterController extends Controller
{
    use RegistersUsers;

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
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:mahasiswa,dosen'],
            'angkatan' => ['required_if:role,mahasiswa', 'integer', 'min:1900'],
            'total_sks' => ['required_if:role,mahasiswa', 'integer', 'min:0'],
        ];

        if ($data['role'] === 'mahasiswa') {
            $rules['nim'] = ['required_if:role,mahasiswa', 'string', 'max:255'];
            $rules['angkatan'] = ['required_if:role,mahasiswa', 'integer', 'min:1900'];
            $rules['total_sks'] = ['required_if:role,mahasiswa', 'integer', 'min:0'];
        } else {
            $rules['nim'] = ['nullable', 'string', 'max:255']; // Make nim optional for dosen
            $rules['angkatan'] = ['nullable', 'string', 'max:255'];
            $rules['total_sks'] = ['nullable', 'string', 'max:255'];
        }

        if ($data['role'] === 'dosen') {
            $rules['nidn'] = ['required_if:role,dosen', 'string', 'max:255'];
        } else {
            $rules['nidn'] = ['nullable', 'string', 'max:255']; // Make nidn optional for mahasiswa
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Log::info('Creating user with data: ', [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        if ($data['role'] === 'mahasiswa') {
            Log::info('Creating mahasiswa...');
            Mahasiswa::create([
                'id_mahasiswa' => $user->id,
                'nim' => $data['nim'],
                'nama' => $data['name'],
                'angkatan' => $data['angkatan'],
                'total_sks' => $data['total_sks'],
            ]);

        Log::info('Created mahasiswa');
        } elseif ($data['role'] === 'dosen') {
            Log::info('Creating dosen...');
            Dosen::create([
                'id_dosen' => $user->id,
                'nidn' => $data['nidn'],
                'nama_dosen' => $data['name'],
            ]);
            Log::info('Created dosen');
        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        Log::info('Registration data:', $request->all());
        var_dump($request->all());
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        var_dump($user);

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
