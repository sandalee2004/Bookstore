<?php
// app/Models/CartItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'quantity'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function getTotalAttribute()
    {
        if ($this->book && $this->book->final_price) {
            return $this->quantity * $this->book->final_price;
        }
        return 0;
    }
}
