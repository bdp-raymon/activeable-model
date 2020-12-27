<?php

namespace Alish\ActiveableModel\Tests\Models;

use Alish\ActiveableModel\Traits\IsActiveable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use IsActiveable;
}
