<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\BSON\ObjectId;

class Service extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'services';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'features',
        'order',
        'is_active',
        'slug'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public static function getActiveServices($limit = 10)
    {
        return self::raw(function($collection) use ($limit) {
            $cursor = $collection->find(
                ['is_active' => true],
                [
                    'limit' => $limit,
                    'sort' => ['order' => 1]
                ]
            );

            $services = [];
            foreach ($cursor as $document) {
                $service = [
                    '_id' => (string)$document->_id,
                    'title' => $document->title ?? '',
                    'description' => $document->description ?? '',
                    'icon' => $document->icon ?? '',
                    'features' => $document->features ?? [],
                    'order' => (int)($document->order ?? 0),
                    'is_active' => (bool)($document->is_active ?? true),
                    'slug' => $document->slug ?? ''
                ];
                $services[] = (object)$service;
            }
            return $services;
        });
    }

    public static function updateOrder(array $items): void
    {
        foreach ($items as $item) {
            self::raw(function($collection) use ($item) {
                $collection->updateOne(
                    ['_id' => new ObjectId($item['id'])],
                    ['$set' => ['order' => $item['order']]]
                );
            });
        }
    }
}
