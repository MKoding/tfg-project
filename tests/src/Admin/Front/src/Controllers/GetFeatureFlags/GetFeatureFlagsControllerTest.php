<?php

namespace Tests\Src\Admin\Front\src\Controllers\GetFeatureFlags;

use Tests\TestCase;

/**
 * @group Integration
 */
class GetFeatureFlagsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function getsFeatureFlagsView()
    {
        $expectedContent = '<div class="feature-flags">';

        $response = $this->get(route('admin.feature-flags'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString($expectedContent, $response->getContent());
    }
}
