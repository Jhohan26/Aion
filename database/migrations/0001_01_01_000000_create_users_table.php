<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		// Schema::create('users', function (Blueprint $table) {
		// 	$table->id();
		// 	$table->string('name');
		// 	$table->string('email')->unique();
		// 	$table->timestamp('email_verified_at')->nullable();
		// 	$table->string('password');
		// 	$table->rememberToken();
		// 	$table->timestamps();
		// });

		Schema::create('usuarios', function (Blueprint $table) {
			$table->id();
			$table->string('nombre', 45);
			$table->string('email', 45)->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password', 255);
			$table->string('telefono', 20)->nullable();
			$table->boolean("estado")->default(true);
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('password_reset_tokens', function (Blueprint $table) {
			$table->string('email')->primary();
			$table->string('token');
			$table->timestamp('created_at')->nullable();
		});

		Schema::create('sessions', function (Blueprint $table) {
			$table->string('id')->primary();
			$table->foreignId('user_id')->nullable()->index();
			$table->string('ip_address', 45)->nullable();
			$table->text('user_agent')->nullable();
			$table->longText('payload');
			$table->integer('last_activity')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('usuarios');
		Schema::dropIfExists('password_reset_tokens');
		Schema::dropIfExists('sessions');
	}
};
