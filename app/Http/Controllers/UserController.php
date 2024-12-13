<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Models\Location;
use App\Models\UserLocation;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        if(Auth::user()->hasRole('Super Admin')){
            return view('users.index', [
                'users' => User::orderBy('name')->get()
            ]);
        }
        else{
            return view('users.index', [
                'users' => User::where('email','!=','superadmin')->orderBy('name')->get()
            ]);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //dd( Role::pluck('name')->all());
        $locations = Location::where('status_active','Active')->orderBy('name')->get();
        return view('users.create', [
            'roles'     => Role::pluck('name')->where('name','!=','Super Admin')->all(),
            'locations' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {

        
       
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        $user->assignRole($request->roles);


        if(!empty($request->location_id)){
            $userLocationsArray = $request->location_id;
            foreach( $userLocationsArray as $locationId){
                $userLocations                  = new UserLocation();
                $userLocations->location_id     = $locationId;
                $userLocations->user_id         = $user->id;
                $userLocations->save();
            }
        }

        return redirect()->route('users.index')->withSuccess('Data User telah berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {


        $userLocations = DB::table('user_locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->join('locations','locations.id','=','user_locations.location_id')
        ->orderBy('locations.name','asc')
        ->where('user_locations.user_id','=', $user->id)
        ->get();
        

        return view('users.show', [
            'user' => $user,
            'userLocations' => $userLocations,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }

        
        $locations  = Location::where('status_active','Active')->orderBy('name')->get();
        $userLocations       = UserLocation::where('user_id', $user->id)->pluck('location_id')->all();

        //var_dump($aaaa);exit();
        return view('users.edit', [
            'user' => $user,
            'locations' => $locations,
            'userLocations' => $userLocations,
            'roles' => Role::pluck('name')->where('name','!=','Super Admin')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {


        $input = $request->all();
 
        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
        
        $user->update($input);

        $successDelete = UserLocation::where('user_id',$user->id)->delete();
       // if($successDelete){
            if(!empty($request->location_id)){
                $userLocationsArray = $request->location_id;
                foreach( $userLocationsArray as $locationId){
                    $userLocations                  = new UserLocation();
                    $userLocations->location_id     = $locationId;
                    $userLocations->user_id         = $user->id;
                    $userLocations->save();
                }
            }
       // }

        $user->syncRoles($request->roles);

        return redirect()->back()->withSuccess('Data User telah berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')->withSuccess('Data User telah berhasil dihapus.');
    }

    public function updatePassword(ChangePasswordRequest $request, User $user): RedirectResponse
    {


        $input = $request->all();
 
        if(!empty($request->password)){
            $newPass = Hash::make($request->password);
            
            DB::select("update users set password = '".$newPass."' where id = ?", [auth()->user()->id]);      
        }

        return redirect()->back()->withSuccess('Password telah berhasil diubah.');
    }



    
    public function changePassword(): View
    {
       
        return view('users.change_password', [
            'user' =>  User::find(auth()->user()->id)
        ]);
    }

}