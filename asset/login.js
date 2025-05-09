document.addEventListener("DOMContentLoaded", function () {
    
    const loginForm = document.querySelector("form[action='../controller/logincheck.php']");

    
    if (loginForm) {
        
        loginForm.addEventListener("submit", function (event) {
        
            const email = document.getElementById("email").value.trim();
            
            const password = document.getElementById("password").value;

            
            let errors = [];

            
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                errors.push("Invalid email format. Email must include '@' and '.'");
            }

            
            if (password.length < 8) {
                errors.push("Password must be at least 8 characters long.");
            }

            
            if (errors.length > 0) {
                event.preventDefault(); 
                alert(errors.join("\n")); 
            }
        });
    }
});
