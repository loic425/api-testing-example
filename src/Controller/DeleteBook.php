<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class DeleteBook
{
    #[Route('/books/{isbn13}', methods: ['DELETE'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
