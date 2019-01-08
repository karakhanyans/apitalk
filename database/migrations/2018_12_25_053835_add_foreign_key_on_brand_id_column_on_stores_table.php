<?php

use App\Models\Brand;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOnBrandIdColumnOnStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->unsignedInteger('brand_id')->nullable()->change();
            $table->index('brand_id');
            $table->foreign('brand_id')
                ->references('id')->on((new Brand())->getTable())
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('brand_id')->change();
            $table->dropIndex('stores_brand_id_index');
            $table->dropForeign('stores_brand_id_foreign');
        });
    }
}
