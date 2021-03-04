<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\SettingModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    //
    public function edit()
    {
        $settings = SettingModel::all();
        $setup = [];
        foreach ($settings as $setting) {
            $setup[$setting->name] = $setting->value;
        }
        return view("backend.setting.edit", compact('setup'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'meta_key' => 'required',
            'meta_desc' => 'required',
            'meta__title' => 'reuired',
        ]);
        // echo "<pre>";
        // print_r($logo_db_path);
        // echo "</pre>";
        // die;
        if ($request->hasFile("logo")) {
            $logo_db_path = SettingModel::where("name", "logo")->first();
            Storage::delete($logo_db_path->value);
            $path = $request->file('logo')->store('public/setting_img');
            $logo_db_path->value = $path;
            $logo_db_path->save();
        }
        $keys = ["site_name","meta_desc","meta_key","meta_title"];
        foreach($keys as $key){
            $db = SettingModel::where("name", $key)->first();
            if(!$db){
                $db = new SettingModel();
                $db->name = $key;
                $db->default_value = "";
            }
            $db->value = $request->input($key,"");
            $db->save();
        }
        return redirect(route("setting"))->with("status","Cập nhật cấu hình thành công");
    }
}
