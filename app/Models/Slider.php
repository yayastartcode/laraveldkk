<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\BSON\ObjectId;

class Slider extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sliders';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_url',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public static function getActiveSliders($limit = 10)
    {
        return self::raw(function($collection) use ($limit) {
            $cursor = $collection->find(
                ['is_active' => true],
                [
                    'limit' => $limit,
                    'sort' => ['order' => 1]
                ]
            );

            $sliders = [];
            foreach ($cursor as $document) {
                $slider = [
                    '_id' => (string)$document->_id,
                    'title' => $document->title ?? '',
                    'subtitle' => $document->subtitle ?? '',
                    'image' => $document->image ?? '',
                    'button_text' => $document->button_text ?? '',
                    'button_url' => $document->button_url ?? '',
                    'order' => (int)($document->order ?? 0),
                    'is_active' => (bool)($document->is_active ?? true)
                ];
                $sliders[] = (object)$slider;
            }
            return $sliders;
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
