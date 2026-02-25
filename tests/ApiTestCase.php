<?php

declare(strict_types=1);

namespace App\Tests;

use Coduo\PHPMatcher\PHPUnit\PHPMatcherAssertions;
use PHPUnit\Framework\Attributes\Before;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ApiTestCase extends WebTestCase
{
    use PHPMatcherAssertions;

    protected KernelBrowser $client;

    #[Before]
    protected function _createClient(): void
    {
        $this->client = self::createClient();
    }

    protected function assertResponseMatchesPattern(string $pattern): void
    {
        $response = $this->client->getResponse();
        $content = $response->getContent();

        self::assertMatchesPattern($pattern, $content);
    }
}
