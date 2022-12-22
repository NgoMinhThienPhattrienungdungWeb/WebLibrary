<?php

class Book extends Model
{
    /**
     * @throws ValidationException
     */
    public function create(array $book)
    {
        $data = [
            'name' => Str::clean($book['name']),
            'category' => Str::clean($book['category']),
            'author' => Str::clean($book['author']),
            'quantity' => Str::clean($book['quantity']),
            'avatar' => File::upload($book['avatar']),
            'description' => Str::clean($book['description']),
            'created_at' => Time::get(),
            'updated_at' => Time::get()
        ];

        $errors = $this->validate($data);
        if ($errors) {
            throw new ValidationException($errors);
        }
        $sql = Sql::query()
            ->insertInto('books (name, category, author, quantity, avatar, description, created_at, updated_at)')
            ->values('(:name, :category, :author, :quantity, :avatar, :description, :created_at, :updated_at)')
            ->get();
        $stmt = $this->connect->prepare($sql);
        $this->bind($stmt, $data);
        $stmt->execute();
    }

    /**
     */
    private function validate(array $data): array
    {
        $errors = Str::validate(
            $data['name'],
            'name',
            [
                'required' => 'Hãy nhập tên giáo viên',
                'length' => 'Không nhập quá 100 ký tự'
            ],
            true,
            100
        );
        $errors = Str::validate(
            $data['category'],
            'category',
            ['required' => 'Hãy chọn thể loại'],
            true,
            0,
            $errors
        );
        $errors = Str::validate(
            $data['author'],
            'author',
            [
                'required' => 'Hãy nhập tên tác giả',
                'length' => 'Không nhập quá 250 ký tự'
            ],
            true,
            255,
            $errors
        );
        $errors = Str::validate(
            $data['author'],
            'author',
            [
                'required' => 'Hãy nhập số lượng',
                'length' => 'Hãy nhập số lượng ít hơn hoặc bằng 2 chữ số'
            ],
            true,
            2,
            $errors
        );
        $errors = Str::validate(
            $data['description'],
            'description',
            [
                'required' => 'Hãy nhập mô tả chi tiết',
                'length' => 'Không nhập quá 1000 ký tự'
            ],
            true,
            2,
            $errors
        );
        return Str::validate(
            $data['avatar'],
            'avatar',
            ['required' => 'Hãy chọn avatar'],
            true,
            0,
            $errors
        );
    }
}