<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Imports\LocationImport;
use App\Models\Admin\DepartmentModel;
use App\Models\Admin\LocationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DepartmentModel::all()->toArray();
        $locations = LocationModel::with('department')->get();
        return view('Admin.Home.Components.Contents.Locations.Location', ['departments' => $departments, 'locations' => $locations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*         return response()->json(['mess' => $request->all()]);
 */
        if ($request->hasFile('file')) {
            try {
                Excel::import(new LocationImport, $request->file('file'));
                return redirect()->back();
            } catch (\Throwable $th) {
                return redirect()->back()->with(['error_import' => 'Lỗi định dạng']);
            }
        }
        $validator = Validator::make($request->all(), [
            'location_name' => 'required',
            'department_model_id' => 'not_in:0'
        ]);

        $customMessages = [
            'location_name.required' => 'Không được để trống',
            'department_model_id.not_in' => 'Vui lòng chọn Department'
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {

            $error =  $validator->errors();

            $location_name = $error->get('location_name');

            $department_model_id = $error->get('department_model_id');
            return response()->json(['location_name_error' => $location_name, 'department_error' => $department_model_id]);
        }

        $locations = LocationModel::create($request->all());
        $locations->department;
        return response()->json($locations);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = DepartmentModel::find($id);
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /*         return response()->json(['mess' => $request->all()]);
 */
        $validator = Validator::make($request->all(), [
            'location_name' => 'required',
            'department_model_id' => 'not_in:0'
        ]);

        $customMessages = [
            'location_name.required' => 'Không được để trống',
            'department_model_id.not_in' => 'Vui lòng chọn Department'
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {

            $error =  $validator->errors();

            return response()->json($error);
        }
        LocationModel::where('id', $request->input('id'))->update(['location_name' => $request->input('location_name'), 'department_model_id' => $request->input('department_model_id'), 'note' => $request->input('note')]);
        return response()->json(204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LocationModel::where('id', $id)->delete();
        return response()->json(204);
    }
}
