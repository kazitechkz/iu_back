<x-form-component.form-component
    :method="'post'"
    :route="'wallet.store'"
    :element-id="'wallet-create'"
    :is-clear="false"
    :is-send="false"
>
    {{--    Plans --}}
    <div class="form-group">
        <x-select
            label="Exchange Type*"
            :options="$exchanges"
            option-label="name"
            option-value="value"
            wire:model="exchange"
            name="exchange"
        />
    </div>
    {{--    Plans--}}
    @if($exchange)
        {{--    Search User--}}
        <div class="form-group">
            <x-input class="my-2"
                     wire:model.debounce.500ms="searchFirst"
                     label="Search*"
                     placeholder="Search"
                     icon="search"
                     hint="Search by name,username,email,phone"
            />
        </div>
        {{--    Search User --}}
        {{--    Search User Result --}}
        @if($usersGroupOne)
            <div class="form-group">
                <select wire:model="userOneId" class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" >
                 <option value="">Выберите пользователя</option>
                @foreach($usersGroupOne as $userOneItem)
                    @if(is_object($userOneItem))
                        @if($userTwoId != $userOneItem->searchable->id)
                            <option value="{{$userOneItem->searchable->id}}">{{$userOneItem->searchable->name}}</option>
                        @endif
                    @endif
                @endforeach
                </select>
            </div>
        @endif
        {{--    Search User Result --}}
        @if($exchange == "transfer")
            {{--    Search User--}}
            <div class="form-group">
                <x-input class="my-2"
                         wire:model.debounce.500ms="searchSecond"
                         label="Search*"
                         placeholder="Search"
                         icon="search"
                         hint="Search by name,username,email,phone"
                />
            </div>
            {{--    Search User --}}
            {{--    Search User Result --}}
            @if($usersGroupTwo)
                <div class="form-group">
                    <select wire:model="userTwoId" class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" >
                        <option value="">Выберите пользователя</option>
                        @foreach($usersGroupTwo as $userTwoItem)
                            @if(is_object($userTwoItem))
                                @if($userOneId != $userTwoItem->searchable->id)
                                    <option value="{{$userTwoItem->searchable->id}}">{{$userTwoItem->searchable->name}}</option>
                                 @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif
            {{--    Search User Result --}}
        @endif

        {{--    Transaction --}}
        @if($exchange == "transaction")
            @if($userFrom)
                <div class="col-md-12 form-group">
                    <x-inputs.number
                        disabled
                        value="{{$userFrom->balance}}"
                        label="Баланс первого пользователя" />
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <x-inputs.number
                            wire:model="amount"
                            label="Перевод на баланс первого пользователя" />
                    </div>
                        <div class="col-md-6 form-group flex justify-content-center align-content-center items-end">
                            <x-button class="bg-red-500 text-white"  wire:click="transaction" icon="check" label="Перевод" />
                        </div>

                </div>
            @endif
        @endif
        {{--    Transaction --}}

        {{--    Transfer --}}
            @if($exchange == "transfer")
                @if($userFrom && $userTo)
                    <div class="row">
                        <div class="col-md-6">
                            <x-inputs.number
                                    disabled
                                    value="{{$userFrom->balance}}"
                                    label="Баланс первого пользователя" />
                        </div>

                        <div class="col-md-6">
                            <x-inputs.number
                                disabled
                                value="{{$userTo->balance}}"
                                label="Баланс второго пользователя" />
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <x-inputs.number
                            min="0"
                            wire:model="amount"
                            :max="$userFrom->balance"
                            label="Перевод с баланса первого пользователя" />
                    </div>
                    @if($amount > 0 && $amount <= $this->userFrom->balance)
                        <div class="col-md-6 form-group flex justify-content-center align-content-center items-end">
                              <x-button class="bg-red-500 text-white"  wire:click="transfer" icon="check" label="Перевод" />
                         </div>
                    @endif

                </div>
                @endif

            @endif
        {{--    Transfer --}}


    @endif

</x-form-component.form-component>
