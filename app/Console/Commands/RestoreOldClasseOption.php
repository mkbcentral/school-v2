<?php

namespace App\Console\Commands;

use App\Models\ClasseOption;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldClasseOption extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restore:classe-option';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recuperation des options au format Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter=0;
        $worksheet=$this->getActiveSheet(storage_path('data/classe_options.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if($counter++ ==0) continue;
            $iteratorCell=$row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells=[];
            foreach ($iteratorCell as $cell) {
                $cells[]=$cell->getValue();
            }

            ClasseOption::create([
                'id'=>$cells[0],
                'name'=>$cells[1],
                'section_id'=>$cells[2],
            ]);
        }
        $this->comment("Options bien importées");
    }

    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }
}
