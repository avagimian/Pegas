<?php

namespace App\Http\Requests;

use App\Http\Rules\MaxRowsCountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class CardImportRequest extends FormRequest
{
    const FILE = 'file';

    public function rules(): array
    {
        return [
            self::FILE => [
                'required',
                'file',
                'mimes:xlsx',
                'max:200',
                new MaxRowsCountRule()
            ],
        ];
    }

    public function getFile(): UploadedFile
    {
        return $this->file('file');
    }

    public function getUrlToFileSending(): string
    {
        return $this->header('File-Sending-Url');
    }
}
