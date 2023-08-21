<div>
    <x-button primary :label="$text" wire:click="toggle"/>
    @if($show)
        <div style="width: 100%; height: 700px;" class="my-3">
            <iframe src="https://visualmatheditor.equatheque.net/VisualMathEditor.html?codeType=Latex&encloseAllFormula=false" frameborder="0" style="width: 100%; height: 100%"></iframe>
        </div>
    @endif
</div>
