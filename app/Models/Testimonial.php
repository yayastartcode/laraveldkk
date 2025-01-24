<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\BSON\ObjectId;

class Testimonial extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'testimonials';

    protected $fillable = [
        'name',
        'position',
        'company',
        'content',
        'image',
        'rating',
        'order',
        'is_active'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public static function getActiveTestimonials($limit = 10)
    {
        return self::raw(function($collection) use ($limit) {
            $cursor = $collection->find(
                ['is_active' => true],
                [
                    'limit' => $limit,
                    'sort' => ['order' => 1]
                ]
            );

            $testimonials = [];
            foreach ($cursor as $document) {
                $testimonial = [
                    '_id' => (string)$document->_id,
                    'name' => $document->name ?? '',
                    'position' => $document->position ?? '',
                    'company' => $document->company ?? '',
                    'content' => $document->content ?? '',
                    'image' => $document->image ?? '',
                    'rating' => (int)($document->rating ?? 5),
                    'order' => (int)($document->order ?? 0),
                    'is_active' => (bool)($document->is_active ?? true)
                ];
                $testimonials[] = (object)$testimonial;
            }
            return $testimonials;
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
