<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'orders';

    /**
     * Run the migrations.
     * @table orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('order_status')->nullable();
            $table->bigInteger('user_id')->index()->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->json('districts')->nullable();
            $table->string('format_title', 30)->nullable();
            $table->string('format_measurements', 30)->nullable();
            $table->double('format_coefficient')->nullable();
            $table->string('print_type_title')->nullable();
            $table->double('print_type_coefficient')->nullable();
            $table->integer('amount')->nullable();
            $table->double('amount_coefficient')->nullable();
            $table->double('total')->nullable();
            $table->string('payment_method_title')->nullable();
            $table->tinyInteger('layout_needed')->nullable();
            $table->tinyInteger('invoice_needed')->nullable();
            $table->text('flyer_text')->nullable();
            $table->date('distribution_date')->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
