<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Candidate extends Eloquent {

    protected $connection = 'mongodb';

    protected $fillable = ['name', 'expected_salary', 'experience'];
}