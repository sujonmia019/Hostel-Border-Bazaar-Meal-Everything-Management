<div class="modal fade" id="status-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header py-2">
                <h6 class="modal-title">Add Status</h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="status_form" method="POST">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id"/>
                    <x-input label="Name" name="name" required="required"/>
                </form>
                <div class="text-end">
                    <button type="button" class="btn btn-primary btn-sm rounded-0 shadow-none" id="save_btn"><span></span> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>