<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CctvCaptureController extends Controller
{
    public function captureImage()
    {
        $username = 'admin';
        $password = 'hik12345';
        $imageUrl = 'http://172.10.10.212/ISAPI/Streaming/channels/101/picture';

        //$path = 'images/capture/'.date('Ym').'/image_'.time().'.jpg';
        $path = 'image_'.time().'.jpg';
        $localFilePath = public_path($path);

        $ch = curl_init();

        // Konfigurasi otentikasi HTTP Basic
        curl_setopt($ch, CURLOPT_URL, $imageUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        // Simpan respons gambar ke file lokal
        $fp = fopen($localFilePath, 'w');
        curl_setopt($ch, CURLOPT_FILE, $fp);

        // Eksekusi request
        $result = curl_exec($ch);

        // Tutup file dan handle cURL
        fclose($fp);
        curl_close($ch);

        return env('APP_URL').'/'.$path;
    }
}
