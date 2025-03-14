<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StatusService
{
    protected static $filename = 'status.json';

    public static function get(string $key): mixed
    {
        return static::read()[$key] ?? null;
    }

    public static function put(string $key, mixed $value): void
    {
        $state = static::read();
        $state[$key] = $value;

        Storage::put(static::$filename, json_encode($state));
    }

    protected static function read(): array
    {
        if (!Storage::exists(static::$filename)) {
            static::init();
        }

        $data = Storage::get(static::$filename);
        $state = json_decode($data, true);

        if (is_null($state)) {
            static::init();
            return [];
        }

        return $state;
    }

    protected static function init(): void
    {
        Storage::put(static::$filename, json_encode([]));
    }
}
