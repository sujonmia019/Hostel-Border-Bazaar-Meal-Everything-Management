<div class="modal fade" id="bazaar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header py-2">
                <h6 class="modal-title">Add Meal</h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bazaar_form" method="POST">
                    @csrf
                    <input type="hidden" name="meal_date" id="meal_date">
                    <x-input type="number" label="Total Meal" name="total_meal" required="required"/>
                    <x-textarea label="Comment" name="comment" rows="2"></x-textarea>
                    <x-select label="Meal Type" name="meal_type" required="required">
                        <option value="">-- Select Option --</option>
                        @foreach (MEAL_TYPE as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                </form>
                <div class="text-end">
                    <button type="button" class="btn btn-primary btn-sm rounded-0 shadow-none" id="save-btn"><span></span> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
