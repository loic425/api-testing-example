<?php

declare(strict_types=1);

namespace App\Tests\Book;

use App\Tests\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class DeleteBookTest extends ApiTestCase
{
    public function testDeleteBook(): void
    {
        $this->client->request('DELETE', '/books/9781484206485');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }
}
