<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportTableAsMigration extends Command
{
    protected $signature = 'export:migration {table}';
    protected $description = 'Générer une migration et un seeder à partir d\'une table existante';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');

        // 1. Récupérer la structure de la table
        $columns = DB::select("SHOW COLUMNS FROM $table");
        $migrationContent = $this->generateMigration($table, $columns);

        // 2. Récupérer les données de la table
        $data = DB::table($table)->get();
        $seederContent = $this->generateSeeder($table, $data);

        // 3. Sauvegarder les fichiers générés
        $migrationPath = database_path("migrations/" . date('Y_m_d_His') . "_create_{$table}_table.php");
        File::put($migrationPath, $migrationContent);

        $seederPath = database_path("seeders/" . ucfirst($table) . "TableSeeder.php");
        File::put($seederPath, $seederContent);

        $this->info("Migration et Seeder générés avec succès !");
    }

    protected function generateMigration($table, $columns)
    {
        $fields = "";
        foreach ($columns as $column) {
            if ($column->Field == 'id') {
                $fields .= "\$table->id();\n";
            } elseif (str_contains($column->Type, 'int')) {
                $fields .= "\$table->integer('{$column->Field}');\n";
            } elseif (str_contains($column->Type, 'varchar')) {
                $fields .= "\$table->string('{$column->Field}');\n";
            } elseif (str_contains($column->Type, 'text')) {
                $fields .= "\$table->text('{$column->Field}')->nullable();\n";
            } elseif (str_contains($column->Type, 'timestamp')) {
                $fields .= "\$table->timestamps();\n";
            }
        }

        return "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('$table', function (Blueprint \$table) {
            $fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('$table');
    }
};";
    }

    protected function generateSeeder($table, $data)
{
    $insertData = "";
    foreach ($data as $row) {
        $values = [];
        foreach ((array) $row as $key => $value) {
            $escapedValue = is_null($value) ? 'null' : "'" . addslashes($value) . "'";
            $values[] = "'$key' => $escapedValue";
        }
        $insertData .= "\n            [" . implode(', ', $values) . "],";
    }

    return "<?php

use Illuminate\\Database\\Seeder;
use Illuminate\\Support\\Facades\\DB;

class " . ucfirst($table) . "TableSeeder extends Seeder
{
    public function run()
    {
        DB::table('$table')->insert([" . rtrim($insertData, ',') . "
        ]);
    }
}";
}
}
