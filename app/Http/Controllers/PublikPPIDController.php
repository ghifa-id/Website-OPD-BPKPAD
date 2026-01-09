<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PublikPPIDController extends Controller
{
    public function previewFile($filename)
    {
        $hostParts = explode('.', request()->getHost());
        $subdomain = $hostParts[0] === 'www' ? $hostParts[1] : $hostParts[0];

        $ftpServer = '103.18.117.184';
        $ftpUser = 'ftppessel';
        $ftpPass = '@Painan123';
        $remotePath = "/asset/files/{$subdomain}/{$filename}";

        $tempDir = storage_path('app/public/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $tempPath = $tempDir . '/' . $filename;

        try {
            $conn = ftp_connect($ftpServer);
            if (!$conn) throw new \Exception("Could not connect to FTP server");

            $login = ftp_login($conn, $ftpUser, $ftpPass);
            if (!$login) throw new \Exception("FTP login failed");

            ftp_pasv($conn, true);

            if (!ftp_get($conn, $tempPath, $remotePath, FTP_BINARY)) {
                throw new \Exception("Failed to download file via FTP");
            }

            ftp_close($conn);

            $mime = File::mimeType($tempPath);
            return response()->file($tempPath, ['Content-Type' => $mime]);
        } catch (\Exception $e) {
            if (isset($conn)) @ftp_close($conn);
            if (file_exists($tempPath)) @unlink($tempPath);

            $remoteUrl = "https://repository.pesisirselatankab.go.id/asset/files/{$subdomain}/{$filename}";
            $headers = @get_headers($remoteUrl);

            if ($headers && strpos($headers[0], '200') !== false) {
                return redirect()->away($remoteUrl);
            }

            abort(404, 'File tidak ditemukan.');
        }
    }
}
