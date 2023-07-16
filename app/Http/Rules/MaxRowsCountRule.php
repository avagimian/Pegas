<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

class MaxRowsCountRule implements Rule
{
    private const MAX_ROWS_COUNT = 200;

    public function passes($attribute, $value): bool
    {
        if (!($value instanceof UploadedFile)) {
            return false;
        }

        $rows = Excel::toArray((object)[], $value)[0];
        return count($rows) <= self::MAX_ROWS_COUNT;
    }

    public function message(): string
    {
        return trans('validation.max_rows_count', ['max_rows' => self::MAX_ROWS_COUNT]);
    }
}