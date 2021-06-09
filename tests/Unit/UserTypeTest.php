<?php

namespace Tests\Unit;

use App\Helpers\UserType;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class UserTypeTest extends TestCase
{
    public function test_user_type_count()
    {
        $this->assertCount(3, UserType::all());
    }

    public function test_user_type_has_teacher(){
        $mailer = new ReflectionClass(UserType::class);
        $this->assertArrayHasKey('TEACHER', $mailer->getConstants());
    }

    public function test_user_type_has_student(){
        $mailer = new ReflectionClass(UserType::class);
        $this->assertArrayHasKey('STUDENT', $mailer->getConstants());
    }

    public function test_user_type_has_admin(){
        $mailer = new ReflectionClass(UserType::class);
        $this->assertArrayHasKey('ADMIN', $mailer->getConstants());
    }
}
