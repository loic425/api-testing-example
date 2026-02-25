<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final readonly class ListBooks
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/config/books.json')]
        private string $jsonFile,
    ) {
    }

    #[Route('/books', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(file_get_contents($this->jsonFile), json: true);
    }
}
