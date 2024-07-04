<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form action="{{ $actionRoute }}" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $id }}Label">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column row-gap-3">
                    {{ $slot }}
                </div>
            </div>
            <div class="modal-footer">
                {{ $actions }}
            </div>
        </form>
    </div>
</div>
