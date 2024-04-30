<?php

namespace App\Livewire;

class Validation
{

    public function addaccount()
    {
        return [
            'code' => 'string|max:10|min:1',
            'name' => 'required|string|min:3',
            'nb' => 'required',
            'type' => 'required',
            'amount' => 'nullable|integer|min:1',
            'description' => 'nullable',
        ];
    }

    public function addjournal()
    {
        return [
            'journal_code' => 'string|max:10|min:1',
            'ref' => 'nullable',
            'amount' => 'require|integer|min:1',
            'note' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
