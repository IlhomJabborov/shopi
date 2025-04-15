<div class="form-row">
    <div class="form-group col-lg-12">
        <div class="custom_select">
            <select class="form-control select-active" name="country" id="country">
                <option value="">Choose a option...</option>
                <option value="UZ" {{$billingDetails && $billingDetails->country == 'UZ' ? 'selected' : ''}}>Uzbekistan</option>
            </select>
        </div>
    </div>
</div>

