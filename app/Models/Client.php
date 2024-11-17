<?php

namespace App\Models;

use App\Enum\ProductTypeEnum;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Client extends Model
{
    /** @use HasFactory<ClientFactory> */
    use HasFactory, SoftDeletes, HasUuids;
    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
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
     * Get all {@see Product} for current {@see Client}
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    /**
     * Get only CASH {@see Product} for current {@see Client}
     */
    public function cashLoanProduct(): HasOne
    {
        return $this->hasOne(Product::class)->where('type', ProductTypeEnum::CASH_LOAN->value);
    }
    /**
     * Get only HOME {@see Product} for current {@see Client}
     */
    public function homeLoanProduct(): HasOne
    {
        return $this->hasOne(Product::class)->where('type', ProductTypeEnum::HOME_LOAN->value);
    }
}
