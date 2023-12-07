<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Toaster;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("role:Super-Admin");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::role('Employee')->get();
        return view('emp.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('emp.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Adjust image validation rules
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> bcrypt($request->password),
            'email_verified_at'=> now(),
        ])->assignRole($request->role);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/uploads'), $imageName);

            $user->image = $imageName;
            $user->save();
        } 

        Alert::success($user->name,'Added Successfully');
        return redirect()->route('emp.list');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee)
    {
        $employee = User::find($employee);
        $roles = Role::all();
        return view('emp.edit', compact('employee', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employee)
    {
        $emp = User::find($employee);
        $previousRole = $emp->roles[0]->name;
        
        $emp->name = $request->name;
        $emp->phone = $request->phone;
        $emp->email = $request->email;

        if ($request->hasFile('image')) {

            if($emp->image){
                Storage::delete('storage/uploads/' . $employee->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/uploads'), $imageName);

            $emp->image = $imageName;
            $emp->save();
        }
        if($request->role != $previousRole)
        {
            $emp->removeRole($previousRole);
            $emp->assignRole($request->role);
        }

        Alert::success('Success', 'Employee Data Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employee)
    {
        $emp = User::find($employee);
        $emp->delete();
        Alert::success('Success', 'Employee Delete Successfully');
        return redirect()->back();
    }
}
