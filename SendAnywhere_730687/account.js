document.addEventListener('DOMContentLoaded', () => {
    displayUserDetails();
    displaySeekerRides();
    displayRiderRides();
});

function displayUserDetails() {
    const user = JSON.parse(localStorage.getItem('loggedInUser'));
    const userDetailsDiv = document.getElementById('user-details');

    if (user) {
        userDetailsDiv.innerHTML = `
            <p><strong>Name:</strong> ${user.firstName} ${user.lastName}</p>
            <p><strong>Email:</strong> ${user.email}</p>
            <p><strong>Phone:</strong> ${user.phone}</p>
        `;
    } else {
        userDetailsDiv.innerHTML = '<p>No user is logged in.</p>';
    }
}

function displaySeekerRides() {
    const seekers = JSON.parse(localStorage.getItem('seekers')) || [];
    const seekerTableBody = document.getElementById('seeker-table').querySelector('tbody');
    seekerTableBody.innerHTML = ''; // Clear existing data

    seekers.forEach((ride, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ride.source} to ${ride.destination}</td>
            <td>${ride.date}</td>
            <td><button onclick="cancelSeekerRide(${index})">Cancel Ride</button></td>
        `;
        seekerTableBody.appendChild(row);
    });
}

function displayRiderRides() {
    const riders = JSON.parse(localStorage.getItem('vehicles')) || [];
    const riderTableBody = document.getElementById('rider-table').querySelector('tbody');
    riderTableBody.innerHTML = ''; // Clear existing data

    riders.forEach((ride, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ride.source} to ${ride.destination}</td>
            <td>${ride.date}</td>
            <td><button onclick="cancelRiderRide(${index})">Cancel Ride</button></td>
        `;
        riderTableBody.appendChild(row);
    });
}

function cancelSeekerRide(index) {
    const seekers = JSON.parse(localStorage.getItem('seekers')) || [];
    if (seekers[index]) {
        const rideDate = new Date(seekers[index].date);
        const now = new Date();
        
        // Check if the ride can be canceled (24 hours before)
        if (rideDate - now > 24 * 60 * 60 * 1000) {
            seekers.splice(index, 1); // Remove the ride
            localStorage.setItem('seekers', JSON.stringify(seekers));
            displaySeekerRides(); // Refresh the table
            alert('Ride canceled successfully.');
        } else {
            alert('You cannot cancel this ride less than 24 hours before departure.');
        }
    }
}

function cancelRiderRide(index) {
    const vehicles = JSON.parse(localStorage.getItem('vehicles')) || [];
    if (vehicles[index]) {
        const rideDate = new Date(vehicles[index].date);
        const now = new Date();
        
        // Check if the ride can be canceled (24 hours before)
        if (rideDate - now > 24 * 60 * 60 * 1000) {
            vehicles.splice(index, 1); // Remove the ride
            localStorage.setItem('vehicles', JSON.stringify(vehicles));
            displayRiderRides(); // Refresh the table
            alert('Ride canceled successfully.');
        } else {
            alert('You cannot cancel this ride less than 24 hours before departure.');
        }
    }
}
