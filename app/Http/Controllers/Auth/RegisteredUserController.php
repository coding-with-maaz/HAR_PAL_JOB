<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:job_seeker,employer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role
        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role->id);

        // If employer, create company profile
        if ($request->role === 'employer') {
            $request->validate([
                'company_name' => ['required', 'string', 'max:255'],
                'company_description' => ['required', 'string'],
                'company_website' => ['nullable', 'url'],
                'industry' => ['required', 'string', 'max:255'],
                'company_size' => ['required', 'string', 'max:255'],
                'founded_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
                'headquarters' => ['required', 'string', 'max:255'],
                'is_public' => ['boolean'],
            ]);

            $company = new Company([
                'name' => $request->company_name,
                'description' => $request->company_description,
                'website' => $request->company_website,
                'industry' => $request->industry,
                'company_size' => $request->company_size,
                'founded_year' => $request->founded_year,
                'headquarters' => $request->headquarters,
                'is_public' => $request->boolean('is_public', true),
                'status' => 'pending',
            ]);
            
            $company->user_id = $user->id;
            $company->slug = Str::slug($request->company_name);
            $company->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
} 