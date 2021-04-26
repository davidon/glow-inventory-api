<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
/**
 * Class InventoryController
 *
 * @package App\Http\Controllers
 */
class InventoryController extends Controller
{
    /**
     * @var \App\Models\Inventory
     */
    private $inventory;

    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Inventory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(Request $request): JsonResponse
    {
        $payLoad = json_decode(trim($request->getContent()), true);

        $ingredients = $payLoad['ingredients'];
        $inventories = $this->inventory->whereIn('name', array_keys($ingredients))->get();
        if(!$inventories) {
            abort(204);
        }
        $recipeCost = 0;
        foreach ($inventories as $inventory) {
            $recipeCost += $ingredients[$inventory->name]  * ($inventory->total_cost / $inventory->units);
        }

        return response()->json([
                'name' => $payLoad['name'],
                'cost' => $recipeCost
            ]
        );
    }
}
