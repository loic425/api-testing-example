<?php

declare(strict_types=1);

namespace App\Tests\Book;

use App\Tests\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class GetBookTest extends ApiTestCase
{
    public function testGetBook(): void
    {
        $this->client->request('GET', '/books/9781484206485');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $this->assertResponseMatchesPattern(
            <<<'JSON'
            {
                "title": "Practical MongoDB",
                "subtitle": "Architecting, Developing, and Administering MongoDB",
                "isbn13": "9781484206485",
                "price": "$32.04",
                "image": "@string@.isUrl()",
                "url": "@string@.isUrl()"
            }
            JSON
        );
    }

    public function testGetMissingBook(): void
    {
        $this->client->request('GET', '/books/not_found');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
        $this->assertResponseHeaderSame('content-type', 'application/json');

    }
}
