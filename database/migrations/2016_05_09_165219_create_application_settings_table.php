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
            $table->string('fourth_section_title')->default('Acces rapid la istoricul fiecărui client.');
            $table->string('fourth_section_description')->default('Pentru fiecare client în parte ai acces la numărul și suma totală a comenzilor efectuate, precum și numărul de produse comandate. Plus multe altele.');
            $table->string('fifth_section_title')->default('Facturi personalizate pentru clienții tăi.');
            $table->string('fifth_section_description')->default('Facturile sunt personalizate cu numele dumneavoastră, astfel denotă profesionalism și respect, două calități care contează tot mai mult în ochii cliențiilor.');
            $table->string('sixth_section_title')->default('Generează facturi în câteva secunde.');
            $table->string('sixth_section_description')->default('Adăugând produsele după codul din catalog îți perimte să generezi facturi pentru clienții tăi în câteva secunde. Timpul tău contează pentru noi.');
            $table->string('seventh_section_title')->default('Detalii despre încasările tale ca reprezentant.');
            $table->string('seventh_section_description')->default('Ai la dispoziție detalii despre încasările efectuate, clienții care nu au plătit la timp și banii care urmează să îi primești. Toate astea pentru a vedea ce câștiguri îți aduce această meserie.
');
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
