<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Exception;

class SettingService
{
    public function updateSettings(array $data)
    {
        try {
            foreach ($data as $key => $value) {
                if ($value instanceof UploadedFile) {
                    $setting = Setting::where('key', $key)->first();
                    if ($setting && $setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $path = $value->store('logos', 'public');
                    $value = $path;
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSettings()
    {
        return Setting::pluck('value', 'key')->toArray();
    }
}
