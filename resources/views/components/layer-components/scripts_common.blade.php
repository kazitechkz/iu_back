<script src="{{asset('js/app.js')}}" defer></script>
@livewireScripts
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    if ($(".ckeditor-textarea")[0]){
        CKEDITOR.replaceAll("ckeditor-textarea", {
            filebrowserUploadUrl: "{{route('questions-ckeditor-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    }
</script>
