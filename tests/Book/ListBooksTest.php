<?php

declare(strict_types=1);

namespace App\Tests\Book;

use App\Tests\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ListBooksTest extends ApiTestCase
{
    public function testListBooks(): void
    {
        $this->client->request('GET', '/books');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $this->assertResponseMatchesPattern(
            <<<'JSON'
            {
                "total": "48",
                "page": "1",
                "books":  [
                    {
                        "title": "Practical MongoDB",
                        "subtitle": "Architecting, Developing, and Administering MongoDB",
                        "isbn13": "@string@",
                        "price": "$32.04",
                        "image": "@string@.isUrl()",
                        "url": "@string@.isUrl()"
                    },
                    {
                        "title": "The Definitive Guide to MongoDB, 3rd Edition",
                        "subtitle": "A complete guide to dealing with Big Data using MongoDB",
                        "isbn13": "@string@",
                        "price": "$47.11",
                        "image": "@string@.isUrl()",
                        "url": "@string@.isUrl()"
                    },
                    {
                        "title": "MongoDB in Action, 2nd Edition",
                        "subtitle": "Covers MongoDB version 3.0",
                        "isbn13": "@string@",
                        "price": "$32.10",
                        "image": "@string@.isUrl()",
                        "url": "@string@.isUrl()"
                    }
                ]
            }
            JSON
        );
    }
}
