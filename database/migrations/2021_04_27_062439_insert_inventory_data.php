<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class Inventory.
 */
class InsertInventoryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            // Insert some stuff
            DB::table('inventory')->insert([
                [
                    'name' => 'beetroot',
                    'units' => 1760,
                    'total_cost' => 520,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ],
                [
                    'name' => 'cheese',
                    'units' => 750,
                    'total_cost' => 660,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ],
                [
                    'name' => 'mint',
                    'units' => 2,
                    'total_cost' => 360,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}
