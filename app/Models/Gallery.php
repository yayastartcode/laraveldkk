<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\BSON\ObjectId;

class Gallery extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'galleries';

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public static function getActiveGalleries($limit = 10)
    {
        return self::raw(function($collection) use ($limit) {
            $cursor = $collection->find(
                ['is_active' => true],
                [
                    'limit' => $limit,
                    'sort' => ['order' => 1]
                ]
            );

            $galleries = [];
            foreach ($cursor as $document) {
                $gallery = [
                    '_id' => (string)$document->_id,
                    'title' => $document->title ?? '',
                    'description' => $document->description ?? '',
                    'image' => $document->image ?? '',
                    'category' => $document->category ?? '',
                    'order' => (int)($document->order ?? 0),
                    'is_active' => (bool)($document->is_active ?? true)
                ];
                $galleries[] = (object)$gallery;
            }
            return $galleries;
        });
    }

    public static function updateOrder(array $items): void
    {
        foreach ($items as $item) {
            self::raw(function($collection) use ($item) {
                $collection->updateOne(
                    ['_id' => new ObjectId($item['id'])],
                    ['$set' => ['order' => (int)$item['order']]]
                );
            });
        }
    }
}
