<h3 class="text-center">Volunteer Work Profile</h3>

@if(session('msg'))
<h4 class="text-center text-success">{{session('msg')}}</h4>

@endif

<form class="w-50 m-auto" method="post" action="{{ route('volunteer.update') }}">
    @csrf

    <div class="">
    <label for=" worktype">WorkType</label>
        <select name="worktype" class="form-select" required id="">
            <option value="heavyA">HeavyA</option>
            <option value="heavyB">HeavyB</option>
            <option value="heavyC">HeavyC</option>
        </select>
    </div>

    <div class="">
    <label for=" area">Area</label>
        <select class="form-select" name="work_area" required id="">
            <option value="dhaka">Dhaka</option>
            <option value="chittagong">Chittagong</option>
            <option value="shylhet">Sylhet</option>
        </select>
    </div>
    <div class="">
    <label for=" area">Availability</label>
        <select class="form-select" name="availablity" required id="">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <input type="hidden" id="longitude" name="longitude">
    <input type="hidden" id="latitude" name="latitude">
    <div class="text-center my-3">
        <button type="submit" class="btn btn-primary mx-3 px-5">Update</button>

    </div>
</form>


<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            // x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        const {
            latitude,
            longitude
        } = position.coords;
        // console.log(latitude,longitude);
        myLocationSetter(latitude+0.01, longitude+0.01); //Adding 0.01 due to working from the same latitude and longitude
    }

    getLocation();

    //23.762498400000002 90.4475341;

    function myLocationSetter(latitude, longitude) {
        document.getElementById('longitude').value =  longitude;
        document.getElementById('latitude').value =  latitude;
    }
</script>