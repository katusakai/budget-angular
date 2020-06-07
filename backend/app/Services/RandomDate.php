<?php


namespace App\Services;


class RandomDate
{
    public function daysBefore($daysBefore)
    {
        $rand = rand(0, 3600 * 24 * $daysBefore);
        $time = time() - $rand;
        $date = date( 'Y-m-d H:i', $time);
        return(new \DateTime($date));
    }
}