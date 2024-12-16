<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserExport implements FromView
{

    
    function __construct( ) {
    }

    public function view(): View
    {

        return view('exports.user', [
            'listRows' => User::where('email','!=','superadmin')->orderBy('name')->get()
        ]);


    }
}