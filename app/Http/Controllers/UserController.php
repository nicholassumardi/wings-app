<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $dataView;

    public function __construct()
    {
        $this->dataView = [
            'title' => 'User Settings'
        ];
    }

    public function index()
    {
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri_path);

        if ($uri[2] == 'user_setting') {
            $this->dataView['content'] = 'admin.settings.user_setting';
        } else {
            $this->dataView['content'] = 'admin.settings.role_setting';
        }


        return view('admin.layouts.index', ['data' => $this->dataView]);
    }

    public function createUser(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'email'        => 'required|email|unique:users,email',
                'name'         => 'required',
                'password'     => 'required',
                'role_id'      => 'required|array',
            ],
            [
                'email.required'    => 'email cannot empty.',
                'email.unique'      => 'The email address has already been taken.',
                'name.required'     => 'name cannot empty.',
                'password.required' => 'password cannot empty.',
                'role_id.required'  => 'role cannot empty.',
                'role_id.array'     => 'role must be array.',
            ]
        );

        if ($validation->fails()) {
            $response = [
                'status'   => 422,
                'message'  => $validation->errors(),
            ];
        } else {
            $user = User::create([
                'email'    => $request->email,
                'name'     => $request->name,
                'password' => Hash::make($request->password),
            ]);

            foreach ($request->role_id as $role) {
                $queryResult = UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $role,
                ]);
            }

            if ($queryResult) {
                $response = [
                    'status'   => 200,
                    'message'  => 'Data created successfuly',
                ];
            } else {
                $response = [
                    'status'   => 500,
                    'message'  => 'Failed to create data',
                ];
            }
        }

        return response()->json($response);
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $validation = Validator::make(
                $request->all(),
                [
                    'email'        => 'required|email|unique:users,email',
                    'name'         => 'required',
                    'password'     => 'required',
                    'role_id'      => 'required|array',
                ],
                [
                    'email.required'    => 'email cannot empty.',
                    'email.unique'      => 'The email address has already been taken.',
                    'name.required'     => 'name cannot empty.',
                    'password.required' => 'password cannot empty.',
                    'role_id.required'  => 'role cannot empty.',
                    'role_id.array'     => 'role must be array.',
                ]
            );

            if ($validation->fails()) {
                $response = [
                    'status'   => 422,
                    'message'  => $validation->errors(),
                ];
            } else {
                $user->userRole()->delete();

                $user->update([
                    'email'    => $request->email,
                    'name'     => $request->name,
                    'password' => Hash::make($request->password),
                ]);

                foreach ($request->role_id as $role) {
                    UserRole::create([
                        'user_id' => $user->id,
                        'role_id' => $role,
                    ]);
                }

                $response = [
                    'status'  => 200,
                    'message' => 'Data created successfuly',
                ];
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => "Failed to fetch data",
            ];
        }

        return response()->json($response);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        $userRoles = UserRole::where('role_id', $user->id)->get();

        if (count($userRoles) > 0) {
            $response = [
                'status'  => 500,
                'message' => "Failed to delete data, because this user has role. Please remove the role first",
            ];
        } else {
            $user->delete();

            $response = [
                'status'  => 200,
                'message' => "Successfully delete data.",
            ];
        }

        return response()->json($response);
    }

    public function getDataUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $data = [
                'id'    => $user->id,
                'email' => $user->email,
                'name'  => $user->name,
            ];

            $response = [
                'status'  => 200,
                'message' => "Success",
                'data'    => $data
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => "Failed to fetch data",
            ];
        }

        return response()->json($response);
    }

    public function datatableUser(Request $request) {}

    public function createRole(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'user_type'     => 'required',
            ],
            [
                'user_type.required' => 'user_type cannot empty.',
            ]
        );

        if ($validation->fails()) {
            $response = [
                'status'   => 422,
                'message'  => $validation->errors(),
            ];
        } else {
            $queryResult =  Role::create([
                'user_type' => $request->user_type
            ]);

            if ($queryResult) {
                $response = [
                    'status'   => 200,
                    'message'  => 'Data created successfuly',
                ];
            } else {
                $response = [
                    'status'   => 500,
                    'message'  => 'Failed to create data',
                ];
            }
        }

        return response()->json($response);
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->id);

        if ($role) {
            $validation = Validator::make(
                $request->all(),
                [
                    'user_type'      => 'required',
                ],
                [
                    'role_id.required'  => 'user type cannot empty.',
                ]
            );

            if ($validation->fails()) {
                $response = [
                    'status'   => 422,
                    'message'  => $validation->errors(),
                ];
            } else {
                $role->update([
                    'user_type'  => $request->user_type,
                ]);

                $response = [
                    'status'  => 200,
                    'message' => 'Data created successfuly',
                ];
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => "Failed to fetch data",
            ];
        }


        return response()->json($response);
    }

    public function deleteRole(Request $request)
    {
        $role = Role::find($request->id);
        $userRoles = UserRole::where('role_id', $role->id)->get();

        if (count($userRoles) > 0) {
            $response = [
                'status'  => 500,
                'message' => "Failed to delete data, because this role associated with user. Please remove the role from user first",
            ];
        } else {
            $role->delete();

            $response = [
                'status'  => 200,
                'message' => "Successfully delete data.",
            ];
        }

        return response()->json($response);
    }

    public function getDataRole(Request $request)
    {
        $role = Role::find($request->id);

        if ($role) {
            $data = [
                'id'         => $role->id,
                'user_type'  => $role->user_type,
            ];

            $response = [
                'status'  => 200,
                'message' => "Success",
                'data'    => $data
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => "Failed to fetch data",
            ];
        }

        return response()->json($response);
    }

    public function datatableRole(Request $request) {}
}
