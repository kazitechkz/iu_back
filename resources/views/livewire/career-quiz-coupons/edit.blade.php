<x-form-component.form-component
    :method="'put'"
    :parameters="['career_quiz_coupon'=>$careerCoupon]"
    :route="'career-quiz-coupon.update'"
    :element-id="'career-quiz-coupon-edit'"
>
    {{--    Career Quiz Groups  --}}
    <div class="form-group">
        <x-select
            :label="'Группа тестов'"
            :options="$career_groups"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="career_group_id"
        />
    </div>
    {{--    Career Quiz Groups  --}}
    {{--    Quiz  --}}
    <div class="form-group">
        <x-select
            :label="'Профориентационный тест'"
            :options="$career_quizzes"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="career_quiz_id"
        />
    </div>
    {{--    Quiz--}}
    {{--    Users--}}
    <div class="form-group">
        <x-select
            :label="__('table.user')"
            :options="$users"
            :option-value="'id'"
            :option-label="'name'"
            :option-description="'email'"
            wire:model="user_id"
        />
    </div>
    {{-- Users --}}
    {{-- Order --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.order')}}*"
            prefix="0"
            wire:model="order_id"
            hint="Номер заказа (введите 0 для бесплатного доступа)"
        />
    </div>
    {{-- Order --}}
    {{-- Is Used --}}
    <div class="form-group">
        <x-checkbox
            id="is_used"
            label="Уже использован"
            icon="check"
            wire:model.defer="is_used"
            hint="Оставьте поле пустым если купон еще не использован"
        />
    </div>
    {{-- Is Used --}}
    {{-- Status --}}
    <div class="form-group">
        <x-checkbox
            id="status"
            label="Активный"
            icon="check"
            wire:model.defer="status"
            hint="Поставьте галочку если купон готов к использованию и активен"
        />
    </div>
    {{-- Status --}}
</x-form-component.form-component>
