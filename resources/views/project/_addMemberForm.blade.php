<form>
    <div class="form-group">
        <select class="form-control" id="person-select" multiple="multiple" data-placeholder="Select an option">
                  
                    @forelse ($people as $person)
                    <option value="{{$person->userId}}">{{$person->name}}</option>
                    @empty
                    <option value="" disabled="disabled">
                        tidak ada pengguna
                    </option>
                    @endforelse
              
        </select>
    </div>
</form>


<script>
             // Binds to the global ajax scope
             function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
            return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.indexOf(params.term) > -1) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.text += ' (matched)';

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    $("#person-select").select2({
        matcher: matchCustom
    });
</script>
