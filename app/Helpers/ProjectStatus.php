<?php

namespace App\Helpers;

abstract class ProjectStatus
{
    const NOT_ASSIGNED = 'Not Assigned';
    const IN_PROGRESS = 'In Progress';
    const IN_REVIEW = 'In Review';
    const COMPLETED = 'Completed';

    private static array $all = [
        self::NOT_ASSIGNED,
        self::IN_PROGRESS,
        self::IN_REVIEW,
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
