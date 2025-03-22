<div class="modal fade" id="bazaar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header py-2">
                <h6 class="modal-title">Add Bazaar</h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bazaar_form" method="POST">
                    @csrf
                    <x-textarea label="Bazaar Name" name="name" required="required" rows="2" optional="Type the details of the daily bazaar here."></x-textarea>
                    <x-input type="number" label="Total Amount" name="amount" required="required"/>
                    <x-textarea label="Note" name="note" rows="1"></x-textarea>
                    <x-input type="date" label="Date" name="date" required="required"/>
                </form>
                <div class="text-end">
                    <button type="button" class="btn btn-primary btn-sm rounded-0 shadow-none" id="save_btn"><span></span> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>