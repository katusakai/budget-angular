<?php


namespace App\Tools\Temporary;


use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MoneyAmountMigrator
{

    protected string $fileName;

    public function __construct()
    {
        $this->fileName = 'MoneyAmountExport.json';
    }

    public function ExportToJson()
    {
        $money = DB::table('money_flows')
            ->select('money_flows.id', 'money_flows.amount')
            ->get()->toJson(JSON_PRETTY_PRINT);
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
        DB::table('money_flows')->update(['amount' => null]);
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

            DB::table('money_flows')
                ->where('id', $money->id)
                ->update(['amount' => $newAmount]);
            $success++;
        }
            echo "### Amount data transferred back to money_flow table\n";
        echo "### Successful: {$success}, Failed: {$fail}\n";
    }
}
