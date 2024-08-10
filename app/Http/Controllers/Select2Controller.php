<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function user(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = User::select('id', 'name')
            ->where('name', 'like', "%$search%")
            ->get();

        foreach ($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }

    public function role(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Role::select('id', 'user_type')
            ->where('user_type', 'like', "%$search%")
            ->get();

        foreach ($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->user_type
            ];
        }

        return response()->json(['items' => $response]);
    }
}
