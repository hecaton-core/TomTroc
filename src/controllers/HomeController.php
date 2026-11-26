<?php

class HomeController
{
    public function index(): void
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->findLatest();
        require __DIR__ . '/../../views/home.php';
    }
}