<?php

use App\Helpers\AdminHelper;
use App\Http\Controllers\AuthController;
use App\Mail\MailVerification;
use App\Models\Admin\AssetModel;
use App\Models\Admin\LocationModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/send-email', function () {
    $mail = new MailVerification('danh010500@mail.com', 'dawd.123');
    Mail::send($mail);
    return response()->json(['message' => 'Email đang được gửi.']);
});
Route::get('/get-location', function () {
    $locations = LocationModel::with('department')->get();
    return response()->json($locations);
});

use Spatie\Permission\Models\Permission;

Route::get('/permission', function () {
    $permission = Permission::create(['name' => 'VIEW']);
    $permission = Permission::create(['name' => 'CREATE']);
    $permission = Permission::create(['name' => 'EDIT']);
    $permission = Permission::create(['name' => 'DELETE']);
    $user = AssetModel::with(['modelof_mannuf.manufaturer', 'supplier', 'location'])->get();
    Permission::create(['name' => 'create-location']);
    Permission::create(['name' => 'create-role']);
    Permission::create(['name' => 'create-asset']);

    Permission::create(['name' => 'edit-location']);
    Permission::create(['name' => 'edit-role']);
    Permission::create(['name' => 'edit-asset']);

    Permission::create(['name' => 'view-location']);
    Permission::create(['name' => 'view-role']);
    Permission::create(['name' => 'view-asset']);

    Permission::create(['name' => 'delete-location']);
    Permission::create(['name' => 'delete-role']);
    Permission::create(['name' => 'delete-asset']);
    $assets = AssetModel::with(['modelof_mannuf.manufaturer', 'supplier', 'location.department', 'image'])->get();
    return response()->json($assets);
});
Route::get('/givePermissionTo', function () {
    $user = User::where('email', 'danh010500@gmail.com')->first();
    $permissions = Permission::all();
    if ($user) {
        $user->syncPermissions($permissions);

        echo "Đã gán tất cả quyền cho người dùng.";
    } else {
        echo "Không tìm thấy người dùng.";
    }
});
