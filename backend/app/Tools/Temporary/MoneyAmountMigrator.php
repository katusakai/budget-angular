<?php


namespace App\Tools\Temporary;


use App\Models\MoneyFlow;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;

class MoneyAmountMigrator
{

    protected $fileName;

    public function __construct()
    {
        $this->fileName = 'MoneyAmountExport.json';
    }

    public function ExportToJson()
    {
        $money = MoneyFlow::all(['id','amount'])
            ->toJson(JSON_PRETTY_PRINT)
        ;
        Storage::disk()->put($this->fileName, $money);
        echo "### Amount data exported to {$this->fileName}\n";
    }

    public function GetFromJsonFile()
    {
        echo storage_path() . "\n";
        $money = json_decode(file_get_contents(storage_path() . "/app/$this->fileName"));

        echo "### Amount data Imported from {$this->fileName}\n";

        return $money;
    }

    public function DeleteFile()
    {
        Storage::disk()->delete($this->fileName);

        echo "### File {$this->fileName} deleted\n";
    }

    public function ClearAmountFromTable()
    {
        $money = MoneyFlow::all();
        foreach ($money as $spending)
        {
            $spending->amount = null;
            $spending->save();
        }
        echo "### Amount data was cleared from money_flow table\n";
    }

    public function FillDataToTable($data)
    {
        $success = 0;
        $fail = 0;

        foreach ($data as $money)
        {
            try {
                $newAmount = floatval(decrypt($money->amount));
            } catch (DecryptException $e) {
                $fail++;
                continue;
            }

            $spending = MoneyFlow::find($money->id);
            $spending->amount = $newAmount;
            $spending->save();
            $success++;
        }
        echo "### Amount data transferred back to money_flow table\n";
        echo "### Successful: {$success}, Failed: {$fail}\n";
     }
 }
