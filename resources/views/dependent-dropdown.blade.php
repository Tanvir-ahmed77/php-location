<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Selector</title>
    <link href="{{ asset('css/dropdowns.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body class="dropdown-page">
<div class="dropdown-container">
    <h1 class="dropdown-title">Location Selector</h1>

    <div class="dropdown-group">
        <label for="division" class="dropdown-label">
            <i class="bi bi-map"></i> Division
        </label>
        <select class="dropdown-select" id="division">
            <option value="">Select Division</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
            @endforeach
        </select>
        <span id="division-loading" class="loading-indicator" style="display: none;">
                <span class="spinner"></span> Loading districts...
            </span>
    </div>

    <div class="dropdown-group">
        <label for="district" class="dropdown-label">
            <i class="bi bi-geo-alt"></i> District
        </label>
        <select class="dropdown-select" id="district" disabled>
            <option value="">Select District</option>
        </select>
        <span id="district-loading" class="loading-indicator" style="display: none;">
                <span class="spinner"></span> Loading upazilas...
            </span>
    </div>

    <div class="dropdown-group">
        <label for="upazila" class="dropdown-label">
            <i class="bi bi-geo"></i> Upazila
        </label>
        <select class="dropdown-select" id="upazila" disabled>
            <option value="">Select Upazila</option>
        </select>
    </div>
    <div class ="dropdown-group">
        <button id ="save-btn" class="btn-save" disabled>
            <i class ="bi bi-save"></i> Save Data
        </button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        const divisionSelect  =  $('#division');
        const districtSelect  =  $('#district');
        const upazilaSelect   =  $('#upazila');
        const divisionLoading =  $('#division-loading');
        const districtLoading =  $('#district-loading');
        const saveBtn         =  $('#save-btn');

        function updateSaveButton(){
            if(divisionSelect.val() && districtSelect.val() && upazilaSelect.val() ) {
                saveBtn.pop('disabled' , false ); }
            else{saveBtn.pop('disabled' , true) ; }

        }
        // Division change handler
        divisionSelect.on('change', function() {
            const divisionId = $(this).val();
            updateSaveButton();

            // Reset dropdowns
            districtSelect.html('<option value="">Select District</option>').prop('disabled', true);
            upazilaSelect.html('<option value="">Select Upazila</option>').prop('disabled', true);

            if (divisionId) {
                divisionLoading.show();

                $.ajax({
                    url: `/get-districts/${divisionId}`,
                    method: 'GET',
                    success: function(response) {
                        const options = response.map(district =>
                            $('<option>', {
                                value: district.id,
                                text: district.name
                            })
                        );
                        districtSelect.html('<option value="">Select District</option>').append(options).prop('disabled', false);
                    },
                    error: function(xhr) {
                        console.error('Error fetching districts:', xhr.responseText);
                        districtSelect.html('<option value="">Error loading districts</option>');
                    },
                    complete: function() {
                        divisionLoading.hide();
                    }
                });
            } else {
                divisionLoading.hide();
            }
        });

        // District change handler
        districtSelect.on('change', function() {
            const districtId = $(this).val();
            updateSaveButton()

            upazilaSelect.html('<option value="">Select Upazila</option>').prop('disabled', true);

            if (districtId) {
                districtLoading.show();

                $.ajax({
                    url: `/get-upazilas/${districtId}`,
                    method: 'GET',
                    success: function(response) {
                        const options = response.map(upazila =>
                            $('<option>', {
                                value: upazila.id,
                                text: upazila.name
                            })
                        );
                        upazilaSelect.html('<option value="">Select Upazila</option>').append(options).prop('disabled', false);
                    },
                    error: function(xhr) {
                        console.error('Error fetching upazilas:', xhr.responseText);
                        upazilaSelect.html('<option value="">Error loading upazilas</option>');
                    },
                    complete: function() {
                        districtLoading.hide();
                    }
                });
            } else {
                districtLoading.hide();
            }
        });
        upazilaSelect.on('change', updateSaveButton);

        saveBtn.on('click' , function(){
           const selectedData = {
               division_id: divisionSelect.val(),
               division_name:divisionSelect.find('option:selected').test(),
               district_id: districtSelect.val(),
               district_name:districtSelect.find('option:selected').test(),
               upazila_id:upazilaSelect.val(),
               upazila_name:upazilaSelect.find('option:selected').test(),
           }
        });
    });
</script>
</body>
</html>
