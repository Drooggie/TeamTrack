<?php

namespace App\Actions\Department;

use App\Models\Employee;
use Spatie\QueueableAction\QueueableAction;

class PaydayAction
{
    use QueueableAction;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Prepare the action for execution, leveraging constructor injection.
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute()
    {
        foreach (Employee::all() as $employee) {
            $employee->paychecks()->create([
                'net_amount' => $employee->payment_type->monthlyAmount(),
                'payed_at' => now(),
            ]);
        }
    }
}
