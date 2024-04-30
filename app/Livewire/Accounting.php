<?php

namespace App\Livewire;

use App\Models\ChartofAccounts;
use Livewire\Component;

class Accounting extends Component
{
    public $add = false;
    public $edit = false;
    public $find;
    public $code;
    public $name;
    public $nb;
    public $type;
    public $amount;
    public $search;
    public $description;
    protected $rules;


    public function __construct()
    {
        $validatedData = new Validation();
        $this->rules = $validatedData->addaccount();

    }

    public function getaccounts()
    {
        return ChartofAccounts::where("name", "LIKE", "%" . $this->search . "%")->get();
    }
    public function adds()
    {
        $this->add = true;
    }
    public function saving()
    {
        $validated = $this->validate();
        ChartofAccounts::create($validated);
        session()->flash('success', 'Created successfully!');
        $this->reset();
        $this->add = false;
        $this->getaccounts();
    }
    public function edist($code)
    {
        $this->edit = true;
        $this->find = ChartofAccounts::where('code', $code)->first();
        $this->code = $this->find->code;
        $this->name = $this->find->name;
        $this->nb = $this->find->nb;
        $this->type = $this->find->type;
        $this->amount = $this->find->amount;
        $this->description = $this->find->description;
    }
    public function save()
    {
        $this->find->update([
            'code' => $this->code,
            'name' => $this->name,
            'nb' => $this->nb,
            'type' => $this->type,
            'amount' => $this->amount,
            'description' => $this->description,
        ]);
        $this->reset();
        session()->flash('success', 'Updated successfully!');
        $this->edit = false;

    }
    public function delete($code)
    {
        $find = ChartofAccounts::where('code', $code)->first();
        if ($find) {
            $find->delete();
            $this->reset();
            session()->flash('success', 'Deleted successfully!');
        } else {
            session()->flash('error', 'Record not found!');
        }

    }
    public function cancel(){
        $this->reset();
        $this->edit = false;
        $this->add = false;
    }

    public function render()
    {
        return view('livewire.accounting',
            ['accounts' => $this->getaccounts()]);
    }
}
