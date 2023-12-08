<?php

namespace App\Http\Controllers;

use App\Models\projectManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProjectManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email'=> ['required','email'],
            'password' => 'required'
        ]);
        // if user tries to connect with these credentials
        // dd($formFields);
         $user = projectManager::query()->where('email',$request->email)->first()->where('password',$request->password);

        if($user){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('project_managers', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);


        // $formFields['password'] = bcrypt($formFields['password']);
        projectManager::create($formFields);

        return redirect('/')->with('message', 'user created and logged in');
    }



    /**
     * Display the specified resource.
     */
    public function show(projectManager $projectManager)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function dashboard(projectManager $projectManager,Request $request)
    {
    
        return view('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(projectManager $projectManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, projectManager $projectManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(projectManager $projectManager)
    {
        //
    }
}
