<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\TodoInterface;
use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class TodoRepository
 * @package App\Repositories
 */
class TodoRepository implements TodoInterface
{
    /**
     * @var Todo
     */
    private $todo;

    /**
     * TodoRepository constructor.
     * @param Todo $todo
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * idで取得
     * @param int $id
     * @return Todo
     */
    public function getById(int $id): Todo
    {
        return $this->todo->find($id);
    }

    /**
     * idで取得、取得できなければ例外を投げる
     * @param int $id
     * @return Todo
     * @throws ModelNotFoundException
     */
    public function getByIdOrFail(int $id): Todo
    {
        return $this->todo->findOrFail($id);
    }


    /**
     * 新規作成
     * @param array $attributes
     * @return Todo
     */
    public function createTodo(array $attributes): Todo
    {
        return $this->todo->create($attributes);
    }

    /**
     * idで更新
     * @param int $id
     * @param array $attributes
     * @throws ModelNotFoundException
     */
    public function updateById(int $id, array $attributes): void
    {
        $todo = $this->todo->findOrFail($id);
        $todo->fill($attributes)->save();
    }

    /**
     * idで削除
     * @param int $id
     */
    public function deleteById(int $id): void
    {
        $this->todo->destroy($id);
    }
}
