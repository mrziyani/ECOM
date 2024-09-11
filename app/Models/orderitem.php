<?php

// app/Etudiant.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'order_items';
}
