<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guest_name')->comment('имя гостя');
            $table->string('series_passport')->comment('серия паспорт');
            $table->string('number_passport')->comment('номер паспорт');
            $table->string('phone_number')->comment('номер телефона');
            $table->string('hotel_name')->comment('наименование отеля');
            $table->timestamp('date_of_arrival')->comment('дата прибытия');
            $table->timestamp('date_of_departure')->nullable()->comment('дата убытия');
            $table->string('room_type')->comment('тип номера');
            $table->string('room_cost')->comment('стоимость номера');
            $table->json('amenities')->nullable()->comment('услуги');
            $table->double('percent_discounts')->nullable()->comment('процент скидки');
            $table->double('amount_discounts')->nullable()->comment('сумма скидки');
            $table->double('total_cost')->comment('итоговая стоимость');
            $table->string('admin_name')->comment('имя администратора');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
