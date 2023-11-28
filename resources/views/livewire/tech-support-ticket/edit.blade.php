<div class="container">
    <div class="row">
        @if($techSupportTicket)
            <div class="col-12">
                <div class="card w-full py-4 px-3 my-2">
                        <div class="card-body">
                            <div class="flex w-full justify-content-between">
                                <div class="text-lg text-primary card-title inline-block">
                                    {{$techSupportTicket->user->name}} ({{$techSupportTicket->user->email}})
                                </div>
                                 <small class="card-text inline-block my-4">{{$techSupportTicket->updated_at}}</small>
                            </div>
                            <div class="my-2">
                                <p class="card-text">{{$techSupportTicket->title}}</p>
                            </div>
                        </div>
                    <div class="text-left">
                        <div class="inline-block shadow-xl border border-success my-2 mx-2 whitespace-nowrap rounded-full bg-white p-2 text-center align-baseline text-sm font-bold leading-none text-white">
                            <span  class="text-success">  {{$techSupportTicket->tech_support_category->title_ru}}</span>
                        </div>
                        <div class="inline-block shadow-xl border border-success my-2 mx-2 whitespace-nowrap rounded-full bg-white p-2 text-center align-baseline text-sm font-bold leading-none text-white">
                            <span class="text-success"> {{$techSupportTicket->tech_support_type->title_ru}}  </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row overflow-y-scroll max-w-[60vh]">
        @foreach($messages as $messageItem)
            <div class="col-12">
                <div class="card w-full py-4 px-3 my-2">
                    <div class="card-body">
                        <div class="flex w-full justify-content-between">
                            <div class="text-lg  text-primary card-title inline-block">
                                {{$messageItem->user->name}} ({{$messageItem->user->email}})
                            </div>
                            <small class="card-text inline-block my-4">{{$messageItem->updated_at}}</small>
                        </div>
                        <div class="my-2">
                            <p class="card-text">{{$techSupportTicket->title}}</p>
                        </div>
                        <p class="card-text">{!! $messageItem->message !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        @if(!$techSupportTicket->is_closed)

            <div class="col-12">
                {{--    Description--}}
                <div class="form-group">
                    <x-form-component.form-component
                        :method="'post'"
                        :route="'tech-support-ticket.store'"
                        :element-id="'tech-support-ticket-create'"
                    >
                     <div class="hidden">
                         <input type="hidden" name="ticket_id" value="{{$ticket_id}}">
                     </div>
                    <div class="md:flex lg:flex justify-between my-3">
                        <div class="w-full" wire:ignore>
                            <x-ckeditor :description="$message" :input-name="'message'" :title="'Описание'"/>
                        </div>
                    </div>
                        {{-- Is Resolved --}}
                        <div class="form-group">
                            <x-checkbox
                                id="is_resolved"
                                label="{{__('table.is_resolved')}}"
                                icon="check"
                                wire:model.defer="is_resolved"
                            />
                        </div>
                        {{-- Is Resolved --}}
                        {{-- Is Answered --}}
                        <div class="form-group">
                            <x-checkbox
                                id="is_closed"
                                label="{{__('table.is_closed')}}"
                                icon="check"
                                wire:model.defer="is_closed"
                            />
                        </div>
                        {{-- Is Answered --}}
                    </x-form-component.form-component>
                </div>
                {{--    Description --}}
            </div>
        @endif
    </div>
</div>
