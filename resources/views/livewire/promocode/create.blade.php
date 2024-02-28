<form wire:submit.prevent="submit" method="post">
    @csrf
    <div class="my-3">
        <label for="code">PROMO CODE <span wire:click="generate()" class="cursor-pointer hover:text-blue-500">(Сгенерировать)</span></label>
        <input type="text" id="code" wire:model="code" class="form-control">
        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="my-3">
        <label for="percentage">Скидка в процентах %</label>
        <input type="text" id="percentage" wire:model="percentage" class="form-control">
        @error('percentage') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="my-3">
        <label for="expired_at">Дата истечения</label>
        <input type="date" id="expired_at" wire:model="expired_at" class="form-control">
        @error('expired_at') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="my-3">
        <label for="group_ids">Группа пользователей</label>
        <div wire:ignore>
            <select wire:model="group_ids" multiple id="group_ids" class="w-full form-control">
                @foreach($this->groups as $group)
                    <option value="{{$group->id}}">{{$group->title_ru}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="my-3">
        <label for="plan_ids">Группа промокодов</label>
        <div wire:ignore>
            <select wire:model="plan_ids" multiple id="plan_ids" class="w-full form-control">
                @foreach($this->plans as $plan)
                    <option value="{{$plan->id}}">{{$plan->title}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <x-button type="submit" label="Отправить" primary md icon="check" />
</form>

@push('js')
    <script>
        $(document).ready(function (){
            $('#group_ids').select2()
            $('#group_ids').on('change', function () {
                let data = $(this).val()
                @this.set('group_ids', data)
            })
            $('#plan_ids').select2()
            $('#plan_ids').on('change', function () {
                let data = $(this).val()
                @this.set('plan_ids', data)
            })
        })
    </script>
@endpush

