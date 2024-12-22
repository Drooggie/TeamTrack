<?php

namespace App\Models;

use App\Enums\PaymentTypes;
use App\Models\Concerns\HasUuid;
use App\Payments\PaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'full_name',
        'email',
        'department_id',
        'job_title',
        'payment_type',
        'salary',
        'hourly_rate',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'department_id' => 'integer',
        'payment_type' => PaymentTypes::class,
    ];

    // public function paychecks(): HasMany
    // {
    //     return $this->hasMany(Paycheck::class);
    // }

    // public function timelogs(): HasMany
    // {
    //     return $this->hasMany(Timelogs::class);
    // }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getPaymentTypeAttribute(): PaymentType
    {
        return PaymentTypes::from($this->original['payment_type'])
            ->makePaymentType($this);
    }
}
