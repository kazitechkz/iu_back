<x-form-component.form-component
    :method="'post'"
    :route="'subscription.store'"
    :element-id="'subscription-create'"
>
    {{--    Plans --}}
    <div class="form-group">
        <x-select
            label="{{__('table.plan_id')}}*"
            :options="$plans"
            option-label="name"
            option-value="id"
            wire:model="plan_id"
            name="plan_id"
        />
    </div>
    {{--    Plans--}}
    @if($plan_id)
    {{--    Search User--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model.debounce.500ms="search"
                 label="{{__('table.search_user')}}*"
                 placeholder="{{__('table.search_user')}}"
                 icon="search"
                 hint="{{__('table.search_user')}}"
        />
    </div>
    {{--    Search User --}}
    {{--    Search User Result --}}
    @if($users)
           @foreach($users as $userItem)
               @if(is_object($userItem))
                   @if(!$userItem->searchable->isSubscribedTo($plan_id))
                        <x-checkbox
                            id="{{$userItem->searchable->username}}"
                            label="{{$userItem->searchable->name}}"
                            wire:model="{{$user_id}}"
                            value="{{$userItem->searchable->id}}"
                            multiple="multiple"
                            name="user_id[]"
                        />
                    @endif
                @endif
           @endforeach
    @endif
    {{--    Search User Result --}}
        {{--    Description--}}
        <div class="form-group">
            <x-textarea
                wire:model="description"
                label="{{__('table.description')}}*"
                placeholder="{{__('table.description')}}"
                hint="{{__('table.description')}}"
            />
        </div>
        {{--    Description --}}
    @endif
</x-form-component.form-component>
