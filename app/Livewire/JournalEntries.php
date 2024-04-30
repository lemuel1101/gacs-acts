<?php

namespace App\Livewire;

use App\Models\ChartofAccounts;
use App\Models\JournalAccounts;
use App\Models\JournalEntries as ModelsJournalEntries;
use Livewire\Component;

class JournalEntries extends Component
{
    public $addjournal = false;
    public $creditValue;
    public $debitValue;
    public $ref;
    public $amount;
    public $description;
    public $note;
    public $debit;
    public $credit;
    public $journal_code;
    public $date;
    protected $rules;

    public $rows = [];

    public function mount()
    {
        $this->addRow();
    }
    public function addRow()
    {
        $this->rows[] = ['account' => '', 'debit' => '', 'credit' => '', 'description' => '', 'amount' => ''];

    }
    public function calculateResult($index)
    {
        $debit = isset($this->rows[$index]['debit']) ? floatval($this->rows[$index]['debit']) : 0;
        $credit = isset($this->rows[$index]['credit']) ? floatval($this->rows[$index]['credit']) : 0;

        $this->rows[$index]['amount'] = $credit - $debit;
    }

    public function credits($index)
    {

        $this->creditValue = $this->rows[$index]['credit'];

        $creditValue = $this->rows[$index]['credit'];
        if (!empty($creditValue)) {
            $this->rows[$index]['debit'] = null;
            $this->debitValue = null;
        }
        $this->calculateResult($index);

    }
    public function debits($index)
    {

        $this->debitValue = $this->rows[$index]['debit'];

        $debitValue = $this->rows[$index]['debit'];
        if (!empty($debitValue)) {
            $this->rows[$index]['credit'] = null;
            $this->creditValue = null;
        }
        $this->calculateResult($index);
    }
    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }
    public function addj()
    {
        $this->journal_code = JournalAccounts::latest('created_at')->value('journal_code');
        $this->addjournal = true;
    }

    public function saving()
    {

        $find = JournalAccounts::where('journal_code', 'LIKE', '%' . $this->journal_code . '%')->first();
        $debitTotal = $this->calculateTotal('debit');
        $creditTotal = $this->calculateTotal('credit');

        $validated = $this->validate([
            'journal_code' => 'required|max:10|min:1',
            'ref' => 'nullable',
            'note' => 'nullable',
        ]);

        if ($creditTotal == $debitTotal && $creditTotal !== 0) {
            if ($find) {
                dd('already existed');
            }
            $validated['amount'] = $creditTotal;
            $acc = JournalAccounts::create($validated);

            foreach ($this->rows as $row) {
                if ($row['account'] != null) {
                    ModelsJournalEntries::create([
                        'jur_code' => $acc->journal_code,
                        'account_id' => $row['account'],
                        'credit' => $row['credit'],
                        'debit' => $row['debit'],
                        'description' => $row['description'],
                    ]);
                }else{
                    dd('not null please');
                }
            }
            $this->addjournal = true;
        } else {
            dd('The credit and debit must be equal');
        }
    }
    public function cancel()
    {
        $this->reset();
        $this->addjournal = false;

    }
    public function preview($code)
    {
       return ModelsJournalEntries::where('jur_code',$code)->first();
    }
    public function getjournal()
    {
        return JournalAccounts::all();
    }
    public function getaccounts()
    {
        return ChartofAccounts::all();
    }
    public function render()
    {
        $debitTotal = $this->calculateTotal('debit');
        $creditTotal = $this->calculateTotal('credit');

        return view('livewire.journal-entries', [
            'journals' => $this->getjournal(),
            'accounts' => $this->getaccounts(),

            'debitTotal' => $debitTotal,
            'creditTotal' => $creditTotal,
        ]);
    }

    private function calculateTotal($field)
    {
        return collect($this->rows)->sum(function ($row) use ($field) {
            return $row[$field] ? floatval($row[$field]) : 0;
        });
    }
}
