<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PopulateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert some stuff
        DB::table('categories')->insert(
            [
                [
                    'title' => 'No category',
                    'identifier' => 'no_category',
                ],
                [
                    'title' => 'Entertainment',
                    'identifier' => 'entertainment',
                ],
                [
                    'title' => 'Bills and utilities',
                    'identifier' => 'bills_and_utilities',
                ],
                [
                    'title' => 'Shopping',
                    'identifier' => 'shopping',
                ],
                [
                    'title' => 'Vehicle and transit',
                    'identifier' => 'vehicle_and_transit',
                   
                ],
                [
                    'title' => 'Medical',
                    'identifier' => 'medical',
                ],
                [
                    'title' => 'Sport',
                    'identifier' => 'sport',
                ],                
            ]
        );
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('expenses')->truncate();
    }
}
