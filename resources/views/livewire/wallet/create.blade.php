
    {{--    Plans --}}
    <div class="form-group">
        <x-select
            label="Exchange Types*"
            :options="$exchanges"
            option-label="name"
            option-value="value"
            wire:model="exchangeType"
            name="exchangeType"
        />
    </div>
    {{--    Plans--}}
    @if($exchangeType)
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
            @foreach($usersGroupOne as $userOneItem)
                @if(is_object($userOneItem))

                @endif
            @endforeach
        @endif
        {{--    Search User Result --}}

        @if($exchangeType == "transfer")
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
                @foreach($usersGroupTwo as $userTwoItem)
                    @if(is_object($userTwoItem))

                    @endif
                @endforeach
            @endif
            {{--    Search User Result --}}
        @endif
    @endif

