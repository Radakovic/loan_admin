<?php

namespace App\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
