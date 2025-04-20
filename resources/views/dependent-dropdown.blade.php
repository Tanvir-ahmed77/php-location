
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Selector</title>
    <link href="{{ asset('css/dropdowns.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
                    <option value="{{ $division->name }}">{{ $division->name }}</option>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    // Your existing JavaScript with loading indicators
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division');
        const districtSelect = document.getElementById('district');
        const upazilaSelect = document.getElementById('upazila');
        const divisionLoading = document.getElementById('division-loading');
        const districtLoading = document.getElementById('district-loading');

        // Division change handler
        divisionSelect.addEventListener('change', function() {
            const divisionCode = this.value;

            // Reset district and upazila
            districtSelect.innerHTML = '<option value="">Select District</option>';
            districtSelect.disabled = !divisionCode;
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
            upazilaSelect.disabled = true;

            if (divisionCode) {
                // Show loading state
                divisionLoading.style.display = 'inline-block';
                districtSelect.disabled = true;

                // Fetch districts using Axios
                axios.get(`/get-districts/${divisionCode}`)
                    .then(response => {
                        districtSelect.innerHTML = '<option value="">Select District</option>';
                        response.data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.name;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                        districtSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching districts:', error);
                        districtSelect.innerHTML = '<option value="">Error loading districts</option>';
                    })
                    .finally(() => {
                        divisionLoading.style.display = 'none';
                    });
            } else {
                divisionLoading.style.display = 'none';
            }
        });

        // District change handler
        districtSelect.addEventListener('change', function() {
            const districtCode = this.value;

            // Reset upazila
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
            upazilaSelect.disabled = !districtCode;

            if (districtCode) {
                // Show loading state
                districtLoading.style.display = 'inline-block';
                upazilaSelect.disabled = true;

                // Fetch upazilas using Axios
                axios.get(`/get-upazilas/${districtCode}`)
                    .then(response => {
                        upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
                        response.data.forEach(upazila => {
                            const option = document.createElement('option');
                            option.value = upazila.name;
                            option.textContent = upazila.name;
                            upazilaSelect.appendChild(option);
                        });
                        upazilaSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching upazilas:', error);
                        upazilaSelect.innerHTML = '<option value="">Error loading upazilas</option>';
                    })
                    .finally(() => {
                        districtLoading.style.display = 'none';
                    });
            } else {
                districtLoading.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>
