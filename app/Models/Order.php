<?php

// app/Etudiant.php



namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'Orders';

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class); // Adjust the class name if needed
    }
    
}
