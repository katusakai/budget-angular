<?php


namespace App\Services;


class InitialCategoriesList
{
    public function get()
    {
        $json = file_get_contents(resource_path() . '/initial/initial_categories.json');
        return json_decode($json)->List;
    }
}