// Handle registration form submission
document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const firstName = document.getElementById('first-name').value;
    const lastName = document.getElementById('last-name').value;
    const email = document.getElementById('register-email').value;
    const phone = document.getElementById('register-phone').value;
    const password = document.getElementById('register-password').value;

    const users = JSON.parse(localStorage.getItem('users')) || [];
    
    if (users.find(user => user.email === email)) {
        alert('User  already exists');
    } else {
        users.push({ firstName, lastName, email, phone, password });
        localStorage.setItem('users', JSON.stringify(users));

        alert('Registration successful');
        window.location.href = 'login.html'; // Redirect to login page
    }
});


