<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'type',
        'cash_loan_amount',
        'property_value',
        'down_payment_amount',
    ];

    public $incrementing = false;
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
}
