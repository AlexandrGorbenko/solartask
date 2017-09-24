<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function json_success($data = []) {
        if(count($data) > 0)
            return ['success' => true, 'data' => $data];

        return ['success' => true];
    }

    protected function json_error($erros) {
        return ['success' => false, 'errors' => $erros];
    }

}
