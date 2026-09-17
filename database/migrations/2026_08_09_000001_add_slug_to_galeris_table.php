<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('galeri', 'slug')) {
            // Add slug column without unique first
            Schema::table('galeri', function (Blueprint $table) {
                $table->string('slug')->after('title')->default('');
            });

            // Backfill slugs from existing titles
            $galeris = DB::table('galeri')->select('id', 'title')->get();
            foreach ($galeris as $galeri) {
                $slug = Str::slug($galeri->title);
                $original = $slug;
                $count = 1;
                while (DB::table('galeri')->where('slug', $slug)->where('id', '!=', $galeri->id)->exists()) {
                    $slug = $original.'-'.$count;
                    $count++;
                }
                DB::table('galeri')->where('id', $galeri->id)->update(['slug' => $slug]);
            }

            // Now create unique index
            Schema::table('galeri', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
