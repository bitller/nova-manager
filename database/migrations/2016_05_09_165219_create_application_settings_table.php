<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create application_settings table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateApplicationSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('allow_new_accounts')->defalt(true);
            $table->string('name')->default('Nova');
            $table->string('landing_index_title')->default('Aplicația dedicată reprezentanților Avon.');
            $table->string('second_section_title')->default('Primele 90 de zile gratuit!');
            $table->string('second_section_description')->default('Primele 90 de zile sunt gratuite. Exact, 90 de zile în care te vei convinge că Nova este aplicația special creată pentru tine. Înscrie-te acum, durează 30 de secunde.');
            $table->string('second_section_button_text')->default('Începe să folosești Nova gratuit!');
            $table->string('third_section_title')->default('Statistici pentru fiecare campanie.');
            $table->string('third_section_description')->default('Ai la dispoziție statistici pentru fiecare campanie în parte. Deasemenea, poți compara două campanii pentru a vedea diferențele.');
            $table->tinyInteger('trial_days')->unsigned()->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('application_settings');
    }
}
