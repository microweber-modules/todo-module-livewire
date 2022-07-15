<?php
namespace MicroweberPackages\Modules\TodoModuleLivewire\migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('todo_list')) {
            Schema::create('todo_list', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('image');
                $table->string('status');
                $table->longText('priority');
                $table->longText('description');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('todo_list');
    }
}
