<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    const NAME = 'name';
    const GENDER = 'gender';
    const CULTURE = 'culture';
    const BORN = 'born';
    const DIED = 'died';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string(self::NAME)->nullable();
            $table->enum(self::GENDER, \App\Models\Character::GENDERS)->nullable();
            $table->string(self::CULTURE)->nullable();
            $table->string(self::BORN)->nullable();
            $table->string(self::DIED)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
