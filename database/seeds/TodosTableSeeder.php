<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Models\Todo;

/**
 * Class TodosTableSeeder
 */
class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Todo::class, 10)->create();
    }
}
