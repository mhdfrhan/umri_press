<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SearchableSelect extends Component
{
    public $name;
    public $placeholder;
    public $items = [];
    public $search = '';
    public $selected = null;
    public $selectedText = '';
    public $showDropdown = false;
    public $disabled = false;

    protected $listeners = ['clear' => 'clearSelection'];

    public function mount($name, $items = [], $placeholder = 'Select an option...', $selected = null)
    {
        $this->name = $name;
        $this->items = $items;
        $this->placeholder = $placeholder;

        if ($selected) {
            $this->selected = $selected;
            $this->selectedText = $this->items[$selected] ?? '';
        }
    }

    public function getFilteredItemsProperty()
    {
        if (strlen($this->search) < 3) {
            $this->placeholder = 'Type at least 3 characters...';
            return [];
        }

        if (empty($this->search)) {
            return $this->items;
        }

        return collect($this->items)->filter(function ($item) {
            return str_contains(strtolower($item), strtolower($this->search));
        })->toArray();
    }

    public function selectItem($value, $text)
    {
        $this->selected = $value;
        $this->selectedText = $text;
        $this->showDropdown = false;
        $this->search = '';
        $this->dispatch('item-selected', [
            'name' => $this->name,
            'value' => $value
        ]);
    }

    public function clearSelection()
    {
        $this->selected = null;
        $this->selectedText = '';
        $this->search = '';
        $this->dispatch('item-selected', [
            'name' => $this->name,
            'value' => null
        ]);
    }

    public function toggleDropdown()
    {
        if (!$this->disabled) {
            $this->showDropdown = !$this->showDropdown;
        }
    }

    public function closeDropdown()
    {
        $this->showDropdown = false;
        $this->search = '';
    }

    public function updatedSearch()
    {
        $this->showDropdown = true;
    }

    public function render()
    {
        return view('livewire.components.searchable-select');
    }
}
