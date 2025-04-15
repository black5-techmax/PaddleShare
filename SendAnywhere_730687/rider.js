function submitVehicle(event) {
    event.preventDefault(); // Prevent form submission

    const source = document.getElementById('source').value;
    const destination = document.getElementById('destination').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const vehicleName = document.getElementById('vehicleName').value;
    const driverName = document.getElementById('driverName').value;
    const carNumber = document.getElementById('carNumber').value;
    const price = document.getElementById('price').value;
    const vehicleImageInput = document.getElementById('vehicleImage');

    const file = vehicleImageInput.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onloadend = function() {
            const vehicleData = {
                source,
                destination,
                date,
                time,
                name: vehicleName,
                driver: driverName,
                number: carNumber,
                price: price,
                image: reader.result // Base64 string of the image
            };

            // Save vehicle data in localStorage
            let vehicles = JSON.parse(localStorage.getItem('vehicles')) || [];
            vehicles.push(vehicleData);
            localStorage.setItem('vehicles', JSON.stringify(vehicles));

            alert('Your vehicle has been successfully registered!');
            window.location.href = 'home.html'; // Redirect to home page
        };

        reader.readAsDataURL(file);
    } else {
        alert('Please select an image file.');
    }
}
