<div wire:ignore>
    <x-modal blur wire:model.defer="showModal" :z-index="'z-5000'" max-width="6xl" spacing="p-2">
        <x-card title="Предпросмотр" fullscreen>
            <div class="my-3">
                <h3><strong>Предмет:</strong> {{$content->step->subject->title}}</h3>
                <h4><strong>Этап:</strong> {{$content->step->title}}</h4>
                <h5><strong>Субэтап:</strong> {{$content->sub_step->title}}</h5>
            </div>
            <div class="grid lg:grid-cols-2 lg:gap-2 sm:grid-cols-1 sm:gap-1">
                <div class="preview-content">
                    {!! \App\Helpers\StrHelper::latexToHTML($content->text_kk) !!}
                </div>
                <div class="preview-content">
                    {!! \App\Helpers\StrHelper::latexToHTML($content->text_ru) !!}
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Закрыть" x-on:click="close"/>
                    {{--                    <x-button primary label="I Agree"/>--}}
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <a class="mx-2" wire:click="open">
        <button class="btn btn-outline-secondary btn-rounded btn-icon">
            <i class="mdi mdi-eye"></i>
        </button>
    </a>
</div>
