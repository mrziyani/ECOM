<?php

// app/Etudiant.php

namespace App\Models;

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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id'); 
        // The second 'product_id' is the foreign key in 'order_items'
        // The third 'product_id' is the primary key in 'products'
    }
}
