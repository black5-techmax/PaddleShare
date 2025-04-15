// login.js
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;
    
    const users = JSON.parse(localStorage.getItem('users')) || [];
    const user = users.find(u => u.email === email && u.password === password);
    
    if (user) {
        localStorage.setItem('loggedInUser', JSON.stringify(user)); // Store logged-in user info
        alert('Login successful');
        window.location.href = 'home.html'; // Redirect to account page
    } else {
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = 'Invalid email or password';
        errorMessage.style.display = 'block';
    }
});
