<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

final readonly class GetBook
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/config/books')]
        private string $jsonDir,
    ) {
    }

    #[Route('/books/{isbn13}', methods: ['GET'])]
    public function __invoke($isbn13): JsonResponse
    {
        $jsonFile = $this->jsonDir . DIRECTORY_SEPARATOR . $isbn13 . '.json';

        if (!is_file($jsonFile)) {
            return new JsonResponse(status: Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(file_get_contents($jsonFile), json: true);
    }
}
