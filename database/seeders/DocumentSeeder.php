<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::create([
            'name' => 'Document 1'
        ]);

        Document::create([
            'name' => 'Document 2'
        ]);

        Document::create([
            'name' => 'Document 3'
        ]);

        Document::create([
            'name' => 'Document 4'
        ]);

        Document::create([
            'name' => 'Document 5'
        ]);

        Document::create([
            'name' => 'Document 6'
        ]);

        Document::create([
            'name' => 'Document 7'
        ]);

        Document::create([
            'name' => 'Document 8'
        ]);

        Document::create([
            'name' => 'Document 9'
        ]);

        Document::create([
            'name' => 'Document 10'
        ]);
    }
}
