<?php
namespace App\Helpers;

class BaseHelper {
    public static function includeRouteFile(string $folder) : void
    {
        try {
            $dir = base_path().'/routes/'.$folder;
            if (!is_dir($dir)) {
                throw new Exception('Invalid Error Path');
            }

            foreach(scandir($dir) as $file) {
                if ($file === '.' ) continue;
                if ($file === '..') continue;
                if (is_file($dir.'/'.$file)) {
                    $fileInfo = pathinfo($dir.'/'.$file);
                    if ($fileInfo['extension'] == 'php') {
                        require($dir.'/'.$file);
                    }
                }
                continue;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}