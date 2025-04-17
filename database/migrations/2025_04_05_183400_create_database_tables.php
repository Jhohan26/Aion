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

		Schema::create("restaurantes", function (Blueprint $table) {
			$table->id();
			$table->string("nombre", 45)->unique();
			$table->string("url", 45)->unique();
			$table->string("descripcion", 255)->nullable();
			$table->string("logo", 150)->nullable();
			$table->string("fondo", 150)->nullable();
			$table->timestamps();

			$table->foreignId("usuarios_id")->constrained("usuarios")->onUpdate("cascade")->onDelete("restrict");
		});


		Schema::create("categorias", function (Blueprint $table) {
			$table->id();
			$table->string("nombre", 45);
			$table->smallInteger("orden");
			$table->timestamps();

			$table->foreignId("restaurantes_id")->constrained("restaurantes")->onUpdate("cascade")->onDelete("restrict");
		});


		Schema::create("productos", function (Blueprint $table) {
			$table->id();
			$table->string("nombre", 45);
			$table->string("descripcion", 150)->nullable();
			$table->decimal("precio", 12, 2);
			$table->string("imagen", 150)->nullable();
			$table->smallInteger("orden");
			$table->timestamps();

			$table->foreignId("categorias_id")->constrained("categorias")->onUpdate("cascade")->onDelete("restrict");
		});

		Schema::create("plantillas", function (Blueprint $table) {
			$table->id();
			$table->string("nombre", 45);
			$table->string("descripcion", 255)->nullable();
			$table->string("preview", 150)->nullable();
			$table->timestamps();
		});

		Schema::create("detalles", function (Blueprint $table) {
			$table->id();
			$table->timestamps();

			$table->foreignId("restaurantes_id")->constrained("restaurantes")->onUpdate("cascade")->onDelete("restrict");
			$table->foreignId("plantillas_id")->constrained("plantillas")->onUpdate("cascade")->onDelete("restrict");
		});


	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("restaurantes");
		Schema::dropIfExists("categorias");
		Schema::dropIfExists("productos");
		Schema::dropIfExists("plantillas");
		Schema::dropIfExists("detalles");
	}
};
