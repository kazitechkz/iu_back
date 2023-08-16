<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait CRUD
{
    public static function boot(): void
    {
        parent::boot();

        self::creating(function($model){

        });

        self::created(function($model){
            toastr()->success('Data has been saved successfully!');
        });

        self::updating(function($model){
        });

        self::updated(function($model){
            toastr()->info('Data has been updated successfully!');
        });

        self::deleting(function($model){

        });

        self::deleted(function($model){
            toastr()->error('Data has been deleted successfully!');
        });
    }

    /**
     * @param $fields $request->all()
     * @return static
     */
    public static function add($fields): static
    {
        $model = new static;
        $model->fill($fields);
        $model->save();
        return $model;
    }

    /**
     * @param $fields $request->all()
     * @return void
     */
    public function edit($fields): void
    {
        $this->fill($fields);
        $this->save();
    }

    public static function show($id){
        $model = self::find($id);
        if($model){
            return $model;
        }
    }

    public function remove(): void
    {
        $this->delete();
    }
}
