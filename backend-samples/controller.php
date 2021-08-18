<?php

namespace App\Http\Controllers;

use App\Models\SomeRand;

class ApiController extends Controller
{
    public function test()
    {
        // SomeRand::insert([
        //     [
        //         'first_name' => mt_rand(10, 1000),
        //         'last_name' => mt_rand(10, 1000),
        //         'second_name' => mt_rand(10, 1000),
        //     ],
        //     [
        //         'first_name' => mt_rand(10, 1000),
        //         'last_name' => mt_rand(10, 1000),
        //         'second_name' => mt_rand(10, 1000),
        //     ],
        //     [
        //         'first_name' => mt_rand(10, 1000),
        //         'last_name' => mt_rand(10, 1000),
        //         'second_name' => mt_rand(10, 1000),
        //     ],
        // ]);
        $model = SomeRand::find(1);
        $model->lastName = 'изменения привет в camelCase 123';
        $model->save();
        dd($model->lastName);
        return SomeRand::find(1);
    }
}
