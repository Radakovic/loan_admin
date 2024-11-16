<?php

namespace App\Models;

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

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
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
     * Get all {@see Loan} for current {@see Client}
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
    /**
     * Get only CASH {@see Loan} for current {@see Client}
     */
    public function cashLoan(): HasOne
    {
        return $this->hasOne(Loan::class)->where('type', 'CASH');
    }
    /**
     * Get only HOME {@see Loan} for current {@see Client}
     */
    public function homeLoan(): HasOne
    {
        return $this->hasOne(Loan::class)->where('type', 'HOME');
    }
}
