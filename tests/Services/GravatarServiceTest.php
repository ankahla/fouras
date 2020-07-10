<?php

namespace Services;

use PHPUnit\Framework\TestCase;

class GravatarServiceTest extends TestCase
{
    public function testGetSrc()
    {
        $email = 'test@test.com';
        $service = new GravatarService();
        $expectedUrl = 'http://www.gravatar.com/avatar.php?gravatar_id=3f89a50facb90e33e469377ac8d53d99&default=&size=128';

        static::assertSame($expectedUrl, $service->getSrc(['gravatar_id' => $email]));
    }
}
