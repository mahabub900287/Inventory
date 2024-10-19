<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SystemSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Utilities\FileUploadService;

class SettingsController extends Controller
{
    public const FILE_STORE_PATH = 'settings';
    protected $fileUploadService;
    public function __construct()
    {
        $this->fileUploadService = app(FileUploadService::class);

        // $this->middleware(['permission:Site Settings'])->only(['edit']);
    }


    public function index()
    {
        $settings = [];
        $raw_settings = SystemSettings::all();
        foreach ($raw_settings as $s) {
            $settings[$s->settings_key] = $s->settings_value;
        }
        
        setbreadcumb("System Settings", "Settings");
       
        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $request)
    {
        $data = $request->except('_token');

        if (isset($data['general'])) {
            // Set site logo
            $data = $this->uploadImage($data, 'system_logo');
            $data = $this->uploadImage($data, 'system_short_logo');
            // Set favicon
            $data = $this->uploadImage($data, 'favicon');
        }
        $keys = array_keys($data);

        foreach ($keys as $key) {
            $settings = SystemSettings::where('settings_key', $key)->first();
            if (!$settings) $settings = new SystemSettings();
            $settings->settings_key = $key;
            $settings->settings_value = $data[$key];
            $settings->save();
        }
        $notify[] = ['success', 'System settings updated successfully'];
        return redirect()->back()->withNotify($notify);
    }


    /**
     * uploadImage
     *
     * @param  mixed $data
     * @param  mixed $field
     * @return void
     */
    public function uploadImage($data, $field)
    {
        // Get general settings
        $general = SystemSettings::where('settings_key', 'general')->first();
        // Upload image
        if (isset($data['general'][$field])) {
            if (isset($general['settings_value'][$field]) && $general['settings_value'][$field] != null) {
                $array = explode('/', $general['settings_value'][$field]);
                $this->fileUploadService->delete('settings/' . $array[count($array) - 1]);
            }
            $this->fileUploadService->delete($data['general'][$field], self::FILE_STORE_PATH);
            $name = $this->fileUploadService->upload($data['general'][$field], self::FILE_STORE_PATH);
            $data['general'][$field] = get_storage_image(self::FILE_STORE_PATH, $name);
        } else {
            if (isset($general->settings_value[$field])) {
                $data['general'][$field] = $general->settings_value[$field];
            }
        }

        return $data;
    }
}
