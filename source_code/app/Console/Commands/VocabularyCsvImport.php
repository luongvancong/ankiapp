<?php

namespace App\Console\Commands;

use App\Imports\VocabularyImport;
use App\Models\Desk;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use App\Models\Card;

class VocabularyCsvImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vocabulary:csv_import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import vocabularies from csv file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $collection = Excel::toCollection(new VocabularyImport(), resource_path('csv/600-cards.csv'));
        $totalAffected = 0;
        $desk = Desk::query()->first();
        $mediaMap = file_get_contents(resource_path('csv/media'));
        $mediaMap = json_decode($mediaMap, true);
        $mediaMap = array_flip($mediaMap);

        foreach ($collection[0] as $index => $item) {

            try {
                // image, vietnamese,target_word,transcription,example
                $imageTag = new DOMDocument();
                $imageTag->loadHTML($item['image']);
                $imageTag = $imageTag->getElementsByTagName('img');
                $src = $imageTag[0]->getAttribute('src');
                if (array_has($mediaMap, $src)) {
                    $src = $mediaMap[$src];
                }
                $dataInsert = [
                    'front' => $item['target_word'],
                    'back' => $item['vietnamese'],
                    'example' => $item['example'],
                    'ipa' => $item['transcription'],
                    'image' => $src,
                    'desk_id' => $desk->id
                ];

                $exist = Card::query()->where('front', $dataInsert['front'])->first();
                if (!$exist) {
                    Card::query()->insert($dataInsert);
                    $totalAffected ++;
                }

            } catch (\Exception $e) {
                $this->error("$index : ". $e->getMessage());
            }
        }

        $this->info("Total: ". $totalAffected);
    }
}
