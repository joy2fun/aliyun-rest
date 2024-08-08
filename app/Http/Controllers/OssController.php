<?php

namespace App\Http\Controllers;

use Nette\Utils\Json;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OssController extends Controller
{
    public function signedEndpoint(Request $request)
    {
        if ($bucket = $request->input('bucket')) {
            config([
                'filesystems.disks.aliyun.bucket' => $bucket,
            ]);
        }

        $prefix = $request->input('prefix', date("Y/m/d"));
        /** @var ignore */
        $disk = Storage::disk('aliyun');
        $ext = $request->input('ext', pathinfo($request->input('name'), PATHINFO_EXTENSION) ?: 'bin');
        $name = $request->input('force') ? $request->input('name') : date("YmdHis") . '-' . Str::random(16) . '.' . $ext;

        $config = $disk->getAdapter()->signatureConfig($prefix, $callBackUrl = '', $customData = [], $expire = 30, $maxSize = \config('filesystems.disks.aliyun.maxSize'));
        $config = Json::decode($config, $asArray = true);
        $config['path'] = $prefix . '/' . $name;
        $config['url'] = $config['host'] . $config['path'];
        return response()->json($config);
    }
}
