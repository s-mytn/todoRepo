<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface TodoInterface
 * @package App\Contracts
 */
interface TodoInterface
{
    /**
     * idで取得
     * @param int $id
     * @return Todo
     */
    public function getById(int $id): Todo;

    /**
     * idで取得、取得できなければ例外を投げる
     * @param int $id
     * @return Todo
     * @throws ModelNotFoundException
     */
    public function getByIdOrFail(int $id): Todo;

    /**
     * 新規作成
     * @param array $attributes
     * @return Todo
     */
    public function createTodo(array $attributes): Todo;

    /**
     * idで更新
     * @param int $id
     * @param array $attributes
     * @throws ModelNotFoundException
     */
    public function updateById(int $id, array $attributes): void;

    /**
     * idで削除
     * @param int $id
     */
    public function deleteById(int $id): void;
}
