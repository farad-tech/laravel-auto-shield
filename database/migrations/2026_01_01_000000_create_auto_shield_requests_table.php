<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('auto_shield_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 45)->index();      // ipv4, ipv6
            $table->string('first_piece', 45)->nullable()->index();
            $table->string('ip_version', 45)->nullable()->index();
            $table->integer('day_timestamp')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('auto_shield_requests');
    }
};
