<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltersController extends Controller
{
    public function co2tot()
    {
        return DB::select('
            SELECT sum(round((products.co2 * order_products.quantity))) as co2tot
            FROM products join order_products on products.id = order_products.id_product 
        ');
    }

    public function forcountry()
    {
        return DB::select('
            SELECT orders.destination, sum(round((products.co2 * order_products.quantity))) as co2tot
            FROM products 
            JOIN order_products on products.id = order_products.id_product
            JOIN orders on order_products.id_order = orders.Id
            GROUP BY orders.destination 
        ');
    }

    public function forproduct()
    {
        return DB::select('
            SELECT products.name, sum(round((products.co2 * order_products.quantity))) as co2tot
            FROM products 
            JOIN order_products on products.id = order_products.id_product
            GROUP BY products.name
        ');
    }

    public function fortemp(Request $request)
    {
        return DB::select("
            SELECT sum(round((products.co2 * order_products.quantity))) as co2tot
            FROM products 
            JOIN order_products on products.id = order_products.id_product 
            JOIN orders on order_products.id_order = orders.Id
            WHERE orders.date between '{$request->start_date}' and '{$request->end_date}'  
        ");
    }
}
