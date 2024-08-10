<?php

namespace App\Http\Controllers;

use App\Models\TaskManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskManagementController extends Controller
{
    protected $dataView;

    public function __construct()
    {
        $this->dataView = [
            'title' => 'Task Management'
        ];
    }

    public function index()
    {
        $this->dataView['content'] = 'admin.task_management.list';

        return view('admin.layouts.index', ['data' => $this->dataView]);
    }

    public function detail()
    {
        $this->dataView['content'] = 'admin.task_management.detail';
        $this->dataView['data_user'] = User::all();
        return view('admin.layouts.index', ['data' => $this->dataView]);
    }

    public function detailShow($id)
    {
        $this->dataView['content'] = 'admin.task_management.detail_update';
        $this->dataView['data_task'] = TaskManagement::where('id', $id)->first();
        
        return view('admin.layouts.index', ['data' => $this->dataView]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title'        => 'required',
                'description'  => 'required',
                'due_date'     => 'required',
            ],
            [
                'title.required'       => 'title cannot empty.',
                'description.required' => 'description cannot empty.',
                'due_date.required'    => 'due date cannot empty.',
            ]
        );

        if ($validation->fails()) {
            $response = [
                'status'   => 422,
                'message'  => $validation->errors(),
            ];
        } else {
            $queryResult =  TaskManagement::create([
                'user_id'      => $request->user_id ? $request->user_id : NULL,
                'title'        => $request->title,
                'description'  => $request->description,
                'due_date'     => date('Y-m-d', strtotime($request->due_date)),
                'status'       => $request->status,
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



    public function update(Request $request)
    {
        $task = TaskManagement::find($request->id);

        if ($task) {
            $validation = Validator::make(
                $request->all(),
                [
                    'title'        => 'required',
                    'description'  => 'required',
                    'due_date'     => 'required',
                ],
                [
                    'title.required'       => 'title cannot empty.',
                    'description.required' => 'description cannot empty.',
                    'due_date.required'    => 'due date cannot empty.',
                ]
            );

            if ($validation->fails()) {
                $response = [
                    'status'   => 422,
                    'message'  => $validation->errors(),
                ];
            } else {
                $queryResult =  $task->update([
                    'user_id'      => $request->user_id ? $request->user_id : NULL,
                    'title'        => $request->title,
                    'description'  => $request->description,
                    'due_date'     => date('Y-m-d', strtotime($request->due_date)),
                    'status'       => $request->status,
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
        } else {
            $response = [
                'status'   => 500,
                'message'  => 'Failed to fetch data',
            ];
        }


        return response()->json($response);
    }

    public function delete(Request $request)
    {
        $task = TaskManagement::find($request->id);

        $task->delete();

        if ($task) {

            $response = [
                'status'  => 200,
                'message' => "Successfully deleted",
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => "Failed to delete data",
            ];
        }

        return response()->json($response);
    }

    public function getDataTaskManagement(Request $request)
    {
        $task = TaskManagement::find($request->id);

        if ($task) {
            $data = [
                'user_id'      => $task->user_id ? $task->user_id : NULL,
                'title'        => $task->title,
                'description'  => $task->description,
                'due_date'     => $task->due_date,
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

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'title',
            'description',
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = TaskManagement::count();

        $query_data = TaskManagement::where(function ($query) use ($search, $request) {
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%");
                })->orWhere(function ($query) use ($search) {
                    $query->where('description', 'like', "%$search%");
                })->orWhereHas('user', function ($query) use ($search, $request) {
                    $query->where('name', 'like', "%$search%");
                });
            }
        })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = TaskManagement::where(function ($query) use ($search, $request) {
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhere(function ($query) use ($search) {
                            $query->where('description', 'like', "%$search%");
                        });
                })->orWhereHas('user', function ($query) use ($search, $request) {
                    $query->where('name', 'like', "%$search%");
                });
            }
        })
            ->count();

        $response['data'] = [];
        if ($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach ($query_data as $val) {
                $button = '<div class="row">
                            <div class="col s6">
                                <p><a class="mb-6 btn btn-medium waves-effect waves-light green darken-1"  href="' . url('admin/task_management/show_update/' . $val->id . '') . '"> <i
                                            class="material-icons edit">edit</i></a>
                            </div>
                            <div class="col s6">
                                </p>
                                <p><a class="mb-6 btn btn-medium waves-effect waves-light red darken-1" onclick="destroy(' . $val->id . ')"> <i
                                            class="material-icons edit">cancel</i></a></p>
                            </div>
                        </div>';
                $response['data'][] = [
                    $nomor,
                    $val->title,
                    $val->description,
                    date('Y-m-d', strtotime($val->due_date)),
                    $val->status == 1 ? ' <span class="badge green">Complete</span>' : '<span class="badge red">Incomplete</span>',
                    $val->user_id ? $val->user->name : 'No Assigne yet',
                    $button,

                ];

                $nomor++;
            }
        }

        $response['recordsTotal'] = 0;
        if ($total_data <> FALSE) {
            $response['recordsTotal'] = $total_data;
        }

        $response['recordsFiltered'] = 0;
        if ($total_filtered <> FALSE) {
            $response['recordsFiltered'] = $total_filtered;
        }

        return response()->json($response);
    }
}
