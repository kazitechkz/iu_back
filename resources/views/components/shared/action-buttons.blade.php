<div class="flex">
    @if($showLink)
        <a href="{{$showLink}}" class="mx-2">
            <button class="btn btn-outline-secondary btn-rounded btn-icon">
                <i class=" mdi mdi-eye"></i>
            </button>
        </a>
    @endif
    @if($editLink)
        <a href="{{$editLink}}" class="mx-2">
            <button class="btn btn-outline-secondary btn-rounded btn-icon">
                <i class="mdi mdi-lead-pencil"></i>
            </button>
        </a>
    @endif
    @if($deleteLink)
            <form action="{{$deleteLink}}" method="post">
                @csrf
                @method('DELETE')
                <div class="mx-2">
                    <button type="submit" class="btn btn-outline-danger btn-rounded btn-icon">
                        <i class="mdi mdi-bitbucket"></i>
                    </button>
                </div>
            </form>

    @endif
</div>
