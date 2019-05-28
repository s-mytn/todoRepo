<?php
declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Contracts\TodoInterface;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class TodoTest
 * @package Tests\Unit\Repositories
 */
class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var TodoRepository
     */
    private $todoRepository;

    /**
     * 初期設定
     */
    public function setUp()
    {
        parent::setUp();
        $this->todoRepository = resolve(TodoInterface::class);
    }

    /**
     * 指定のidで取得できること
     */
    public function testGetById()
    {
        $target = factory(Todo::class)->create();
        $actual = $this->todoRepository->getById($target->id);

        $this->assertSame($target->id, $actual->id);
    }

    /**
     * 指定のidで取得できること
     */
    public function testGetByIdOrFailSuccess()
    {
        $target = factory(Todo::class)->create();
        $actual = $this->todoRepository->getByIdOrFail($target->id);

        $this->assertSame($target->id, $actual->id);
    }

    /**
     * 指定のidで取得できなければ例外が投げれられること
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testGetByIdOrFailThrowException()
    {
        $this->todoRepository->getByIdOrFail(999);
    }

    /**
     * 新規作成できること
     */
    public function testCreateTodo()
    {
        $attributes = [
            'title' => 'あはん'
        ];
        $created = $this->todoRepository->createTodo($attributes);
        $actual = Todo::find($created->id);

        $this->assertSame('あはん', $actual->title);
    }

    /**
     * 指定のidで更新できること
     */
    public function testUpdateById()
    {
        $target = factory(Todo::class)->create(['title' => '寝る']);
        $this->todoRepository->updateById($target->id, ['title' => '起きる']);
        $actual = Todo::find($target->id);

        $this->assertSame('起きる', $actual->title);
    }

    /**
     * 指定のidで削除できること
     */
    public function testDeleteById()
    {
        $target = factory(Todo::class)->create();
        $this->todoRepository->deleteById($target->id);
        $actual = Todo::withTrashed()->find($target->id);
        // 論理削除されていること
        $this->assertTrue($actual->trashed());
    }
}
