<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AssetModel;
use App\Models\Admin\ImageModel;
use App\Models\Admin\LocationModel;
use App\Models\Admin\ManufaturerModel;
use App\Models\Admin\SupplierModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = LocationModel::with('department')->get();
        $manufacturers = ManufaturerModel::all()->toArray();
        $assets  = AssetModel::with(['modelof_mannuf.manufaturer', 'supplier', 'location.department', 'image'])->get();
        $suppliers = SupplierModel::all()->toArray();
        return view('Admin.Home.Components.Contents.Assets.Asset', ['locations' => $locations, 'manufacturers' => $manufacturers, 'suppliers' => $suppliers, 'assets' => $assets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token', 'file']);
        $asset = AssetModel::create($input);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $models = ManufaturerModel::find($id);
        $models->modelofManuf;
        return response()->json($models);
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
        dd($request->all());
        if ($request->hasFile('file')) {

            $name = $request->file->getClientOriginalName();

            $request->file->storeAs('public', $name);

            ImageModel::create(['asset_model_id' => $request->input('id'), 'url' => $name]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset = AssetModel::find($id)->delete();
        return redirect()->back();
    }
}
