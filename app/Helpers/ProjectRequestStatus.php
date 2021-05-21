<?php

namespace App\Helpers;

abstract class ProjectRequestStatus
{
    const PENDING = 'Pending';
    const ACCEPTED = 'Accepted';
    const REJECTED = 'Rejected';

    private static array $all = [
        self::PENDING,
        self::ACCEPTED,
        self::REJECTED,
    ];

    public static function all(): array
    {
        $data = [];

        foreach (self::$all as $parameter) {
            $data[] = $parameter;
        }

        return $data;
    }
}
