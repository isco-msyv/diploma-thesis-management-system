<?php

namespace Tests\Unit;

use App\Helpers\ProjectStatus;
use PHPUnit\Framework\TestCase;

class ProjectStatusTest extends TestCase
{
    public function test_project_status_count()
    {
        $this->assertCount(4, ProjectStatus::all());
    }
}
