<?php

namespace App\Models;

use App\Enum\ProductTypeEnum;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Number;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory, HasUuids, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'cash_loan_amount',
        'property_value',
        'down_payment_amount',
    ];
    /**
     * Prevent autoincrement id
     */
    public $incrementing = false;
    /**
     * Id should have to have string (uuid) value
     */
    protected $keyType = 'string';
    /**
     * Here we generate new UUID for model
     */
    public function newUniqueId(): string
    {
        return Uuid::uuid4()->toString();
    }
    /**
     * Each Loan belongs to one {@see Adviser}
     */
    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }
    /**
     * Each loan belongs to one {@see Client}
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    /**
     * Virtual field for product value
     */
    public function getProductValueAttribute(): string
    {
        if ($this->type === ProductTypeEnum::CASH_LOAN->value) {
            $productValue = round($this->cash_loan_amount / 100);
        } else {
            $productValue = round(($this->property_value - $this->down_payment_amount) / 100);
        }

        return Number::currency($productValue, 'EUR');
    }
}
