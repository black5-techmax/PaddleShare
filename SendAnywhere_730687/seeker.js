document.addEventListener('DOMContentLoaded', () => {
    displayAllRides(); // Display all available rides on page load
});

function displayAllRides() {
    const allRides = document.getElementById('allRides');
    const vehicles = JSON.parse(localStorage.getItem('vehicles')) || [];

    allRides.innerHTML = ''; // Clear previous rides

    vehicles.forEach((vehicle, index) => {
        const rideDiv = document.createElement('div');
        rideDiv.classList.add('ride'); // Add class for styling
        rideDiv.innerHTML = `
            <h3>${vehicle.name} - ${vehicle.driver}</h3>
            <p>From: ${vehicle.source} to ${vehicle.destination}</p>
            <p>Date: ${vehicle.date}, Time: ${vehicle.time}</p>
            <p>Price: $${vehicle.price}</p>
            <img src="${vehicle.image}" alt="Vehicle Image" style="width: 100px; height: auto;">
            <button onclick="confirmRide(${index})">Select Ride</button>
        `;
        allRides.appendChild(rideDiv);
    });
}

function findRides(event) {
    event.preventDefault();
    const source = document.getElementById('source').value.trim().toLowerCase();
    const destination = document.getElementById('destination').value.trim().toLowerCase();
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;

    const vehicles = JSON.parse(localStorage.getItem('vehicles')) || [];
    const filteredRides = vehicles.filter(vehicle => {
        return vehicle.source.toLowerCase() === source &&
               vehicle.destination.toLowerCase() === destination &&
               vehicle.date === date &&
               vehicle.time === time;
    });

    const availableRides = document.getElementById('allRides');
    availableRides.innerHTML = ''; // Clear previous rides

    if (filteredRides.length > 0) {
        filteredRides.forEach((vehicle, index) => {
            const rideDiv = document.createElement('div');
            rideDiv.classList.add('ride');
            rideDiv.innerHTML = `
                <h3>${vehicle.name} - ${vehicle.driver}</h3>
                <p>From: ${vehicle.source} to ${vehicle.destination}</p>
                <p>Date: ${vehicle.date}, Time: ${vehicle.time}</p>
                <p>Price: $${vehicle.price}</p>
                <img src="${vehicle.image}" alt="Vehicle Image" style="width: 100px; height: auto;">
                <button onclick="confirmRide(${index})">Select Ride</button>
            `;
            availableRides.appendChild(rideDiv);
        });
    } else {
        availableRides.innerHTML = '<p>No rides available for the selected criteria.</p>';
    }
}

function confirmRide(index) {
    const vehicles = JSON.parse(localStorage.getItem('vehicles')) || [];
    const vehicle = vehicles[index];

    alert(`Your ride from ${vehicle.source} to ${vehicle.destination} is confirmed!`);
    saveSeekerRide(vehicle); // Save the confirmed ride details
    window.location.href = 'home.html'; // Redirect to home page
}

function saveSeekerRide(vehicle) {
    const seekers = JSON.parse(localStorage.getItem('seekers')) || [];
    seekers.push({ source: vehicle.source, destination: vehicle.destination, date: vehicle.date });
    localStorage.setItem('seekers', JSON.stringify(seekers));
}
