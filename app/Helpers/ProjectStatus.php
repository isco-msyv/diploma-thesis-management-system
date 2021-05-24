<?php

namespace App\Helpers;

abstract class ProjectStatus
{
    const NOT_ASSIGNED = 'Not Assigned';
    const ASSIGNED = 'Assigned';
    const SUBMITTED = 'Submitted';
    const COMPLETED = 'Completed';

    private static array $all = [
        self::NOT_ASSIGNED,
        self::ASSIGNED,
        self::SUBMITTED,
        self::COMPLETED,
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
