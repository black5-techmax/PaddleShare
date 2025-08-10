window.onload = () =>
{
    function gotlocation(position)
    {
        console.log(position);
        const latt = position.coords.latitude;
        const long = position.coords.longitude;

        const geoApiUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latt}&longitude=${long}&localityLanguage=en`;

        fetch(geoApiUrl)
            .then(res => res.json())
            .then(data => {
                console.log(data);

                if (data.localityInfo && data.localityInfo.administrative) {
                    const locality = data.localityInfo.administrative.find(admin => admin.adminLevel === 6);
                    
                    if (locality) {
                        const status = document.getElementById('status');
                        status.textContent = `You are in: ${locality.name}`;
                    } else {
                        console.log("Locality with adminLevel 6 not found.");
                        const status = document.getElementById('status');
                        status.textContent = `You are in: ${locality.name || 'Unknown Location'}`;
                    }
                }
                else
                {
                    console.log("No 'localityInfo' or 'administrative' data available.");
                }
            })
            .catch(error =>
            {
                console.error("Error fetching the location data:", error);
                const status = document.getElementById('status');
                status.textContent = "Failed to get your location.";
            });
    }
    function failedToGetLocation()
    {
        console.log("There was some issue with getting the location.");
        const status = document.getElementById('status');
        status.textContent = "Unable to retrieve your location.";
    }

    navigator.geolocation.getCurrentPosition(gotlocation, failedToGetLocation);
};