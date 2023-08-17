<x-form-component.form-component
    :method="'post'"
    :route="'subscription.store'"
    :element-id="'subscription-create'"
>
    {{--    Plans --}}
    <div class="form-group">
        <x-select
            label="Plan*"
            :options="$plans"
            option-label="name"
            option-value="id"
            wire:model="plan_id"
            name="plan_id"
        />
    </div>
    {{--    Plans--}}
    {{--    User --}}
    <div class="form-group">
        <x-select
            label="User*"
            :options="$users"
            option-label="name"
            option-value="id"
            wire:model="user_id"
            name="user_id"
        />
    </div>
    {{--    User--}}
    {{--    Status --}}
    <div class="form-group">
        @if($user->subscription($this->subscription->tag)->isActive())
            <x-badge  icon="check" class="bg-green-500" rounded positive label="Активный" /><br>
            <x-checkbox class="my-4" id="right-label" label="Я хочу изменить подписку" wire:model="agree" /><br>
            @if($agree)
             <x-button class="bg-red-500" wire:click="changeSubscription('cancel')" icon="x" red label="Отменить подписку" />
            @endif
        @elseif($user->subscription($this->subscription->tag)->isCanceled())
            <x-badge  icon="check" class="bg-red-500" rounded positive label="Отменен" /><br>
            <x-checkbox class="my-4" id="right-label" label="Я хочу изменить подписку" wire:model="agree" /><br>
            @if($agree)
            <x-button class="bg-info" wire:click="changeSubscription('uncancel')" info label="Восстановить подписку" />
            @endif
        @elseif($user->subscription($this->subscription->tag)->hasEnded())
            <x-badge  icon="check" class="bg-red-500" rounded positive label="Завершился" /><br>
            <x-checkbox class="my-4" id="right-label" label="Я хочу изменить подписку" wire:model="agree" /><br>
            @if($agree)
            <x-button class="bg-info" wire:click="changeSubscription('renew')" icon="check" info label="Переоткрыть доступ" />
            @endif
        @elseif($user->subscription('main')->hasEndedTrial())
            <x-badge  icon="check" class="bg-orange-500" rounded positive label="Завершился пробный" />
        @elseif($user->subscription('main')->isOnTrial())
            <x-badge  icon="check" class="bg-blue-500" rounded positive label="На пробном периоде" />
        @endif
    </div>
    {{--    Status --}}
</x-form-component.form-component>
