<?php

namespace App\Http\Controllers\Admin;

use App\Configuration;
use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConfigurationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $configs = Configuration::all();
        return $this->sendResponse($configs, 'List of configuration parameters have been shown');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $configs = Configuration::find($id);
        if ($configs) {
            return $this->sendResponse($configs, "Configuration '{$configs->name}' parameters have been shown");
        } else {
            return $this->sendError('', 'Configuration parameter does not exist');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $configs = Configuration::find($id);

        if ($configs) {

            if ($configs->value !== $request['value']) {
                $configs->value = $request['value'];
                $configs->save();

                return $this->sendResponse($configs, "Configuration '{$configs->name}' value has been chanded to '{$configs->value}'");

            } else {

                return $this->sendResponse($configs, "Configuration '{$configs->name}' value '{$configs->value}' was not changed, because is the same as requested");
            }
        } else {
            return $this->sendError('', 'Configuration parameter does not exist');
        }

    }

}
