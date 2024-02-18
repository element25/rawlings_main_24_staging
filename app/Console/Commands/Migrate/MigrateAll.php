<?php

namespace App\Console\Commands\Migrate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryFolder;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MigrateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate all data from old site';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Schema::disableForeignKeyConstraints();
        MediaLibraryItem::truncate();
        MediaLibraryFolder::truncate();
        Media::truncate();

        //$this->call('migrate:news');
        $this->call('migrate:categories');
        $this->call('migrate:homepage-hero');

        Schema::enableForeignKeyConstraints();

    }
}
