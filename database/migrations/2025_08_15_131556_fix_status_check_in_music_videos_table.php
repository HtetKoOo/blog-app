<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $connection = Schema::getConnection()->getDriverName();

        if ($connection === 'mysql') {
            // MySQL: convert old string values to numeric
            DB::statement("UPDATE music_videos SET status = 1 WHERE status = 'active'");
            DB::statement("UPDATE music_videos SET status = 0 WHERE status = 'inactive'");

            // Modify column to TINYINT(1) (boolean equivalent)
            DB::statement("ALTER TABLE music_videos MODIFY COLUMN status TINYINT(1) NOT NULL");

            // Add check constraint (optional, MySQL 8+)
            // DB::statement("ALTER TABLE music_videos ADD CONSTRAINT music_videos_status_check CHECK (status IN (0,1))");
        }

        if ($connection === 'pgsql') {
            // PostgreSQL: convert old string values to 0/1
            DB::statement("UPDATE music_videos SET status = '1' WHERE status = 'active'");
            DB::statement("UPDATE music_videos SET status = '0' WHERE status = 'inactive'");

            // Alter column to BOOLEAN using USING clause
            DB::statement("ALTER TABLE music_videos ALTER COLUMN status TYPE BOOLEAN USING (status::integer::boolean)");

            // Drop old check constraint if exists
            DB::statement("ALTER TABLE music_videos DROP CONSTRAINT IF EXISTS music_videos_status_check");

            // Add new check constraint
            DB::statement("ALTER TABLE music_videos ADD CONSTRAINT music_videos_status_check CHECK (status IN (TRUE, FALSE))");
        }
    }

    public function down(): void
    {
        $connection = Schema::getConnection()->getDriverName();

        if ($connection === 'mysql') {
            DB::statement("ALTER TABLE music_videos MODIFY COLUMN status VARCHAR(10)");
        }

        if ($connection === 'pgsql') {
            DB::statement("ALTER TABLE music_videos ALTER COLUMN status TYPE VARCHAR(10) USING status::text");
            DB::statement("ALTER TABLE music_videos DROP CONSTRAINT IF EXISTS music_videos_status_check");
        }
    }
};
