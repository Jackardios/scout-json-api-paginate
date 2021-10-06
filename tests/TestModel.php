<?php

namespace Jackardios\ScoutJsonApiPaginate\Tests;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TestModel extends Model
{
    use Searchable;

    protected $guarded = [];
}
