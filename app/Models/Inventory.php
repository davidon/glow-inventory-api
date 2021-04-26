<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventory.
 */
class Inventory extends Model
{
    use HasFactory;

    public $timestamps = true; //???

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'units',
        'total_cost',
        //???
        'created_at',
        'updated_at'
    ];

    /**
     * The table inventory is associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory';

    /**
     * The connection name for the model same as .env.
     *
     * @var string
     */
    protected $connection = 'mysql';
}
