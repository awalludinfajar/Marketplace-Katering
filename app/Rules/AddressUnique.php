<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class AddressUnique implements ValidationRule
{
    protected $userId;
    protected $tableName;
    protected $booleanFields;
    
    public function __construct(int $userId, string $tableName, string $booleanFields = 'primary')
    {
        $this->userId = $userId;
        $this->tableName = $tableName;
        $this->booleanFields = $booleanFields;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value) {
            return;
        }

        $exist = DB::table($this->tableName)
            ->where('user_id', $this->userId)
            ->where($this->booleanFields, true)
            ->exists();

        if ($exist) {
            $fail('Only one entry can be set to true for this user.');
        }
    }
}
