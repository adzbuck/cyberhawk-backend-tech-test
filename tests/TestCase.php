<?php

namespace Tests;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function fixTimestampDates(array $data): array
    {
        return array_merge($data, [
            'created_at' => Carbon::parse($data['created_at'])->toDateTimeString(),
            'updated_at' => Carbon::parse($data['updated_at'])->toDateTimeString(),
        ]);
    }
}
