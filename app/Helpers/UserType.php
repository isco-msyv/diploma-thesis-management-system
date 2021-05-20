<?php

namespace App\Helpers;

abstract class UserType
{
    const TEACHER = 'Teacher';
    const STUDENT = 'Student';

    private static array $all = [
        self::TEACHER,
        self::STUDENT,
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
