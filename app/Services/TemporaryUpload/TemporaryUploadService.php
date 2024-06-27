<?php
namespace App\Services\TemporaryUpload;

use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class TemporaryUploadService {
    
    /**
     * Handle temporary file upload.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing upload data.
     * @return mixed|string
     */
    public function upload($request): mixed
    {
        if ($request->hasFile('filepond.*')) {
                $folders = [];
                $files = $request->file('filepond');
                foreach ($files as $file) {
                    $original = $file->getClientOriginalName();
                    $extension = $file->extension();

                    $filename = \uniqid() . '-' . now()->timestamp . '.' . $extension;
                    $folder = \uniqid() . '-' . now()->timestamp;

                    $folders[] = $folder;

                    $file = Storage::putFileAs('uploads/tmp/' . $folder, $file, $filename);

                    if (!$file) // Will not create if storeAs fails
                        return response()->json(['status' => 'failed', 'message' => "Something's wrong in Storing File(s)"]);

                    TemporaryFile::create([
                        'folder' => $folder,
                        'filename' => $filename,
                        'file' => $file,
                        'original' => $original,
                    ]);
                }

                return $folders;
        } 
        
        if ($request->hasFile('filepond')) {

            $file = $request->file('filepond');
            $original = $file->getClientOriginalName();
            $extension = $file->extension();

            $filename = \uniqid() . '-' . now()->timestamp . '.' . $extension;
            $folder = \uniqid() . '-' . now()->timestamp;


            $file = Storage::putFileAs('uploads/tmp/' . $folder,  $file, $filename);

            if (!$file) // Will not create if storeAs fails
                return response()->json(['status' => 'failed', 'message' => "Something's wrong in Storing File(s)"]);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
                'file' => $file,
                'original' => $original,
            ]);

            return $folder;
        }

        return '';
    }

    /**
     * Handle temporary file revert.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing upload data.
     * @return mixed|string
     */
    public function revert($request): mixed
    {
        $temp_file = $request->filepond; // Directory

        if ($temp_file) {
            TemporaryFile::where('folder', $temp_file)->delete();
            Storage::deleteDirectory('uploads/tmp/' . $temp_file);
            return response('');
        }
    }
}