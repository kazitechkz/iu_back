<div wire:ignore>
    <x-modal blur wire:model.defer="showModal" :z-index="'z-5000'" max-width="4xl" spacing="p-2">
        <x-card title="Предпросмотр" fullscreen>
            @if($question_ru)
                <div class="p-2 grid grid-cols-2 gap-2">
                    <div class="w-full">
                        <div id="preview-img">
                            <p id="text-img" class="text-gray-700">
                                <b>Вопрос: </b>
                                {!! \App\Helpers\StrHelper::latexToHTML($question_ru->text) !!}
                            </p>

                            @if($question_ru->context != null && $question_ru->context->context != '')
                                <p class="text-gray-600">
                                    <b>Контекст: </b>
                                    {!! \App\Helpers\StrHelper::latexToHTML($question_ru->context->context) !!}
                                </p>
                            @endif
                        </div>
                        <p class="text-gray-600">
                            <b>Ответы: </b>
                        <ul id="answers_math">
                            <li class="{{in_array('a', $correct_answers_ru) ? 'text-green-500' : ''}}">
                                <b>A)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_a)}}
                            </li>
                            <li class="{{in_array('b', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>B)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_b)}}</li>
                            <li class="{{in_array('c', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>C)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_c)}}</li>
                            <li class="{{in_array('d', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>D)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_d)}}</li>
                            @if($question_ru->answer_e)
                                <li class="{{in_array('e', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>E)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_e)}}</li>
                            @endif
                            @if($question_ru->answer_f)
                                <li class="{{in_array('f', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>F)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_f)}}</li>
                            @endif
                            @if($question_ru->answer_g)
                                <li class="{{in_array('g', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>G)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_g)}}</li>
                            @endif
                            @if($question_ru->answer_h)
                                <li class="{{in_array('h', $correct_answers_ru) ? 'text-green-500' : ''}}"><b>H)</b> {{\App\Helpers\StrHelper::latexToHTML($question_ru->answer_h)}}</li>
                            @endif
                        </ul>
                        </p>
                    </div>
                    <div class="w-full">
                        <div id="preview-img2">
                            <p id="text-img2" class="text-gray-700">
                                <b>Вопрос: </b>
                                {!! \App\Helpers\StrHelper::latexToHTML($question->text) !!}
                            </p>

                            @if($question->context != null && $question->context->context != '')
                                <p class="text-gray-600">
                                    <b>Контекст: </b>
                                    {!! \App\Helpers\StrHelper::latexToHTML($question->context->context) !!}
                                </p>
                            @endif
                        </div>
                        <p class="text-gray-600">
                            <b>Ответы: </b>
                        <ul id="answers_math2">
                            <li class="{{in_array('a', $correct_answers) ? 'text-green-500' : ''}}">
                                <b>A)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_a)}}
                            </li>
                            <li class="{{in_array('b', $correct_answers) ? 'text-green-500' : ''}}"><b>B)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_b)}}</li>
                            <li class="{{in_array('c', $correct_answers) ? 'text-green-500' : ''}}"><b>C)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_c)}}</li>
                            <li class="{{in_array('d', $correct_answers) ? 'text-green-500' : ''}}"><b>D)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_d)}}</li>
                            @if($question->answer_e)
                                <li class="{{in_array('e', $correct_answers) ? 'text-green-500' : ''}}"><b>E)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_e)}}</li>
                            @endif
                            @if($question->answer_f)
                                <li class="{{in_array('f', $correct_answers) ? 'text-green-500' : ''}}"><b>F)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_f)}}</li>
                            @endif
                            @if($question->answer_g)
                                <li class="{{in_array('g', $correct_answers) ? 'text-green-500' : ''}}"><b>G)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_g)}}</li>
                            @endif
                            @if($question->answer_h)
                                <li class="{{in_array('h', $correct_answers) ? 'text-green-500' : ''}}"><b>H)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_h)}}</li>
                            @endif
                        </ul>
                        </p>
                    </div>
                </div>
            @else
                <div id="preview-img">
                    <p id="text-img" class="text-gray-700">
                        <b>Вопрос: </b>
                        {!! \App\Helpers\StrHelper::latexToHTML($question->text) !!}
                    </p>

                    @if($question->context != null && $question->context->context != '')
                        <p class="text-gray-600">
                            <b>Контекст: </b>
                            {!! \App\Helpers\StrHelper::latexToHTML($question->context->context) !!}
                        </p>
                    @endif
                </div>
                <p class="text-gray-600">
                    <b>Ответы: </b>
                <ul id="answers_math">
                    <li class="{{in_array('a', $correct_answers) ? 'text-green-500' : ''}}">
                        <b>A)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_a)}}
                    </li>
                    <li class="{{in_array('b', $correct_answers) ? 'text-green-500' : ''}}"><b>B)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_b)}}</li>
                    <li class="{{in_array('c', $correct_answers) ? 'text-green-500' : ''}}"><b>C)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_c)}}</li>
                    <li class="{{in_array('d', $correct_answers) ? 'text-green-500' : ''}}"><b>D)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_d)}}</li>
                    @if($question->answer_e)
                        <li class="{{in_array('e', $correct_answers) ? 'text-green-500' : ''}}"><b>E)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_e)}}</li>
                    @endif
                    @if($question->answer_f)
                        <li class="{{in_array('f', $correct_answers) ? 'text-green-500' : ''}}"><b>F)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_f)}}</li>
                    @endif
                    @if($question->answer_g)
                        <li class="{{in_array('g', $correct_answers) ? 'text-green-500' : ''}}"><b>G)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_g)}}</li>
                    @endif
                    @if($question->answer_h)
                        <li class="{{in_array('h', $correct_answers) ? 'text-green-500' : ''}}"><b>H)</b> {{\App\Helpers\StrHelper::latexToHTML($question->answer_h)}}</li>
                    @endif
                </ul>
                </p>
            @endif
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
