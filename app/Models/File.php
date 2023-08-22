<?php

namespace App\Models;

use App\AppConstants\AppConstants;
use App\Helpers\AWS;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    /**
     * @param $file $request->get('file')
     * @param $folder $folderName
     * @return mixed
     */
    public static function uploadFile($file, $folder): mixed
    {
        $model = new static();
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/'.$folder, $filename);
        $model->url = 'uploads/'.$folder.'/'.$filename;
        $model->save();
        return $model->id;
    }

    public static function deleteFile($id): void
    {
        $file = File::find($id);
        if ($file) {
            if (Storage::exists($file->url)){
                Storage::delete($file->url);
                $file->delete();
            }
        }
    }

    /**
     * @param $file $request->get('file')
     * @param $folder $folderName
     * @return int|mixed
     */
    public static function uploadFileAWS($file, $folder): mixed
    {
        $model = new static();
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random(5).'_'.time().'.'.$extension;
        $path = $file->storeAs($folder, $fileName, 's3');
        $model->url = $path;
        $model->save();
        return $model->id;
    }

    /**
     * @param $filePath $filePath from FILE
     * @return string|null
     */
    public static function getFileFromAWS($filePath): ?string
    {
        $s3 = AWS::getS3();
        if ($filePath && $filePath != '') {
            return $s3->getObjectUrl(
                env('AWS_BUCKET'),
                $filePath
            );
//            return $s3->createPresignedRequest(
//                $s3->getCommand('GetObject', [
//                    'Bucket' => env('AWS_BUCKET'),
//                    'Key' => $filePath,
//                ]),
//                '+10 hour'
//            )->getUri();
        } else {
            return '';
        }
    }

    /**
     * @param $fileId $fileID
     * @return void
     */
    public static function deleteFileFromAWS($fileId): void
    {
        $s3 = AWS::getS3();
        if ($fileId) {
            $path = File::find($fileId);
            $s3->deleteObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => $path->url,
            ]);
        }
    }
}
