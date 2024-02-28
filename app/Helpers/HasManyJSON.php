<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Octane\Exceptions\DdException;

class HasManyJSON extends HasMany
{
    public function addEagerConstraints(array $models): void
    {
        $this->query->whereIn($this->foreignKey, $this->getKeys($models, $this->localKey));
    }

    protected function getKeys(array $models, $key = null): array
    {
        $keys = [];
        collect($models)->each(function ($value) use ($key, &$keys) {
            $keys = array_merge($keys, $value->getAttribute($key));
        });
        return array_unique($keys);
    }


    public function matchMany(array $models, Collection $results, $relation): array
    {

        $foreign = $this->getForeignKeyName();

        $dictionary = $results->mapToDictionary(function ($result) use ($foreign) {
            return [$result->{$foreign} => $result];
        })->all();

        foreach ($models as $model) {
            $ids = $model->getAttribute($this->localKey);
            $collection = collect();
            foreach($ids as $id) {
                if(isSet($dictionary[$id]))
                    $collection = $collection->merge($this->getRelationValue($dictionary, $id, 'many'));
            }
            $model->setRelation($relation, $collection);
        }

        return $models;
    }

    /**
     * @param $array //входяший json массив
     * @param $model //возвращающая модель
     * @return string
     * @throws DdException
     */
    public static function getJSONRelationModels($array = null, $table, $type = 'title_ru'): string
    {
        $data = [];
        $str = '';
        if ($array) {
            foreach ($array as $key => $item) {
                $data[$key] = DB::table($table)->where('id', $item)->first();
            }
            foreach ($data as $datum) {
                if ($datum) {
                    $str .= $datum->$type.'<br>';
                }
            }
            return $str;
        } else {
            return 'Все';
        }
    }
}

