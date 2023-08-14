<x-select
    :label="$label"
    :placeholder="$placeholder"
    :options="$options"
    :option-label="$option_label"
    :option-value="$option_value"
    wire:model.defer="model"
    :name="$name"

/>
