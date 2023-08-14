<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public static function uploadFile($file, $folder)
    {
        $model = new static();
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/'.$folder, $filename);
        $model->url = 'uploads/'.$folder.'/'.$filename;
        $model->save();
        return $model->id;
    }
}
