<?php

class BookController extends Controller
{
    private $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function create()
    {
        if (isset($_POST['book-create'])) {
            $dataBook = [
                'name' => $_POST['name'],
                'category' => $_POST['category'],
                'author' => $_POST['author'],
                'quantity' => $_POST['quantity'],
                'avatar' => $_POST['avatar'],
                'description' => $_POST['description']
            ];
            try {
                $this->book->create($dataBook);
            } catch (ValidationException $e) {
                $errors = $e->getError();
            }
        }
        $data = [
            'title' => 'Đăng ký sách',
            'data' => $dataBook ?? [],
            'errors' => $errors ?? [],
        ];

        $this->view('books/create', $data);
    }
}