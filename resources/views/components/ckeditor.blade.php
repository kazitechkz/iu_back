<div class="w-full">
    <label for="ckeditor-id-{{$inputName}}" class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">{{$title}}</label>
    <textarea id="ckeditor-id-{{$inputName}}" name="{{$inputName}}">{{$description}}</textarea>
</div>


@push('js')
    <script type="text/javascript">
        CKEDITOR.replace("ckeditor-id-{{$inputName}}", {
            filebrowserUploadUrl: "{{route('questions-ckeditor-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
