<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\BSON\ObjectId;

class Setting
{
    protected Collection $collection;
    protected array $attributes = [];
    protected array $where = [];

    public function __construct(array $attributes = [])
    {
        $client = new Client(env('MONGODB_URI'));
        $this->collection = $client->selectDatabase(env('DB_DATABASE'))->selectCollection('settings');
        $this->attributes = $attributes;
    }

    public static function create(array $data): self
    {
        $setting = new self($data);
        $result = $setting->collection->insertOne($data);
        $data['_id'] = $result->getInsertedId();
        return new self($data);
    }

    public static function find($id)
    {
        $setting = new self();
        $document = $setting->collection->findOne(['_id' => new ObjectId($id)]);
        return $document ? new self((array)$document) : null;
    }

    public function update(array $data): bool
    {
        $result = $this->collection->updateOne(
            ['_id' => $this->attributes['_id']],
            ['$set' => $data]
        );
        
        if ($result->getModifiedCount() > 0) {
            $this->attributes = array_merge($this->attributes, $data);
            return true;
        }
        
        return false;
    }

    public function delete(): bool
    {
        $result = $this->collection->deleteOne(['_id' => $this->attributes['_id']]);
        return $result->getDeletedCount() > 0;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public static function where($field, $value)
    {
        $instance = new self();
        $instance->where[$field] = $value;
        return $instance;
    }

    public function get()
    {
        $cursor = $this->collection->find($this->where, ['sort' => ['order' => 1]]);
        $settings = [];
        foreach ($cursor as $document) {
            $settings[] = new self((array)$document);
        }
        return $settings;
    }

    public static function first()
    {
        $instance = new self();
        $document = $instance->collection->findOne($instance->where);
        return $document ? new self((array)$document) : null;
    }

    public static function getByKey(string $key, $default = null)
    {
        $setting = new self();
        $document = $setting->collection->findOne(['key' => $key]);
        return $document ? $document['value'] : $default;
    }

    public static function getSettings(): array
    {
        $setting = new self();
        $generalSettings = $setting->collection->findOne(['type' => 'general']) ?: [];
        
        // Get all individual settings
        $logo = self::getByKey('site_logo');
        $navigation = self::getByKey('navigation', []);
        $contact_email = self::getByKey('contact_email');
        $contact_phone = self::getByKey('contact_phone');
        $address = self::getByKey('address');
        $social_media = self::getByKey('social_media', []);
        
        return array_merge((array)$generalSettings, [
            'site_logo' => $logo,
            'navigation' => $navigation,
            'contact_email' => $contact_email,
            'contact_phone' => $contact_phone,
            'address' => $address,
            'social_media' => $social_media
        ]);
    }

    public static function updateSettings(array $data): bool
    {
        $setting = new self();
        $data['type'] = 'general';
        
        $result = $setting->collection->updateOne(
            ['type' => 'general'],
            ['$set' => $data],
            ['upsert' => true]
        );
        
        return $result->getModifiedCount() > 0 || $result->getUpsertedCount() > 0;
    }

    public static function set($key, $value): bool
    {
        $setting = new self();
        $result = $setting->collection->updateOne(
            ['key' => $key],
            ['$set' => [
                'key' => $key,
                'value' => $value
            ]],
            ['upsert' => true]
        );
        
        return $result->getModifiedCount() > 0 || $result->getUpsertedCount() > 0;
    }

    public static function setByKey(string $key, $value, string $type = 'text', string $group = 'general'): bool
    {
        $setting = new self();
        $result = $setting->collection->updateOne(
            ['key' => $key],
            [
                '$set' => [
                    'key' => $key,
                    'value' => $value,
                    'type' => $type,
                    'group' => $group,
                    'updated_at' => new \MongoDB\BSON\UTCDateTime()
                ]
            ],
            ['upsert' => true]
        );
        
        return $result->getModifiedCount() > 0 || $result->getUpsertedCount() > 0;
    }

    public static function deleteByKey(string $key): bool
    {
        $setting = new self();
        $result = $setting->collection->deleteOne(['key' => $key]);
        return $result->getDeletedCount() > 0;
    }

    public static function getByGroup(string $group): array
    {
        $setting = new self();
        $cursor = $setting->collection->find(['group' => $group]);
        $settings = [];
        foreach ($cursor as $document) {
            $settings[$document['key']] = $document['value'];
        }
        return $settings;
    }

    public static function bulkSet(array $settings, string $group = 'general'): bool
    {
        $setting = new self();
        $operations = [];
        
        foreach ($settings as $key => $value) {
            $operations[] = [
                'updateOne' => [
                    ['key' => $key],
                    [
                        '$set' => [
                            'key' => $key,
                            'value' => $value,
                            'group' => $group,
                            'updated_at' => new \MongoDB\BSON\UTCDateTime()
                        ]
                    ],
                    ['upsert' => true]
                ]
            ];
        }
        
        $result = $setting->collection->bulkWrite($operations);
        return ($result->getModifiedCount() + $result->getUpsertedCount()) > 0;
    }
}
