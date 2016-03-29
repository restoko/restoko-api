<?php
namespace App\Http\Controllers\Table;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreTableRequest;
use App\Models\Table;
use Carbon\Carbon;

class TablesController extends ApiController
{
    public function all()
    {
        $tables = Table::all();

        if ($tables->isEmpty()) {
            return $this->responseNotFound(['Tables is empty']);
        }

        $tables = $this->parseTables($tables);

        return $this->responseOk($tables);
    }

    public function store(StoreTableRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str_replace(' ', '_', strtolower($input['name']));
        $input['status'] = 'available';

        $table = Table::create($input);

        return $this->createResponse($table);
    }

    public function update(StoreTableRequest $request, $tableId)
    {
        $input = $request->all();
        $input['slug'] = str_replace(' ', '_', strtolower($input['name']));

        $table = Table::where('id', $tableId)->update($input);

        return $this->createResponse($table);
    }

    public function destroy($tableId)
    {
        $table = Table::find($tableId)->delete();

        if (! $table) {
            return $this->responseNotFound(['Table Id not found']);
        }

        return $this->responseOk($table);
    }

    private function parseTables($tables)
    {
        $result = [];
        foreach ($tables as $table) {
            $result[] = [
                'id'    => $table['id'],
                'slug'  => $table['slug'],
                'name'  => strtoupper($table['name']),
                'status'        => $table['status'],
                'created_at'    => Carbon::createFromTimestamp(strtotime($table['created_at']))->toFormattedDateString(),
                'updated_at'    => Carbon::createFromTimestamp(strtotime($table['updated_at']))->toFormattedDateString()
            ];
        }

        return $result;
    }
}