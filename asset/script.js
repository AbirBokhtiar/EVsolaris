
//payment1.php
function validateForm() {
    let isValid = true;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const name = document.getElementById('name').value;
    const address = document.getElementById('address').value;
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked');

    if (!email || !validateEmail(email)) {
        document.getElementById('emailErr').innerText = 'Invalid email format';
        isValid = false;
    } else {
        document.getElementById('emailErr').innerText = '';
    }

    if (!phone || !validatePhone(phone)) {
        document.getElementById('phoneErr').innerText = 'Invalid phone number format';
        isValid = false;
    } else {
        document.getElementById('phoneErr').innerText = '';
    }

    if (!name) {
        document.getElementById('nameErr').innerText = 'Name is required';
        isValid = false;
    } else {
        document.getElementById('nameErr').innerText = '';
    }

    if (!address) {
        document.getElementById('addressErr').innerText = 'Address is required';
        isValid = false;
    } else {
        document.getElementById('addressErr').innerText = '';
    }

    if (!paymentMethod) {
        document.getElementById('paymentMethodErr').innerText = 'Payment method is required';
        isValid = false;
    } else {
        document.getElementById('paymentMethodErr').innerText = '';
    }

    return isValid;
}

// function validateEmail(email) {
//     const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return re.test(email);
// }

function validateEmail(email) {
    const input = document.createElement('input');
    input.type = 'email';
    input.value = email;
    return input.checkValidity();
}

// function validatePhone(phone) {
//     const re = /^\+880-\d{10}$/;
//     return re.test(phone);
// }

function validatePhone(phone) {
    const input = document.createElement('input');
    input.type = 'tel';
    input.pattern = '^\\+880-\\d{10}$';
    input.value = phone;
    return input.checkValidity();
}

function submitForm(event) {
    event.preventDefault();
    console.log('submitForm called'); 

    if (validateForm()) {
        console.log('Form is valid'); 
        const formData = new FormData(document.getElementById('payment-form'));
        formData.append('submit', 'submit'); 
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/payment1Check.php', true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                console.log('Response received:', xhttp.responseText); 
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    document.getElementById('payment-confirmation').style.display = 'block';
                    document.getElementById('payment-amount').innerText = response.total_cost;
                    document.getElementById('selected-method').innerText = response.payment_method;
                    document.getElementById('payment-booking-details').innerText = response.booking_details;
                } else {
                    document.getElementById('emailErr').innerText = response.errors.emailErr || '';
                    document.getElementById('phoneErr').innerText = response.errors.phoneErr || '';
                    document.getElementById('nameErr').innerText = response.errors.nameErr || '';
                    document.getElementById('addressErr').innerText = response.errors.addressErr || '';
                    document.getElementById('paymentMethodErr').innerText = response.errors.paymentMethodErr || '';
                }
            }
        };

        console.log('Sending AJAX request');
        xhttp.send(formData);
    }
}

// function getSelectedCities() {
//     const cityCheckboxes = document.querySelectorAll('#city input[type="checkbox"]:checked');
//     const selectedCities = [];
//     cityCheckboxes.forEach(checkbox => {
//         selectedCities.push(checkbox.value);
//     });
//     return selectedCities.join(', '); // Join the selected cities into a comma-separated string
// }


function proceedToPay(event) {
    event.preventDefault();
    console.log('proceedToPay called'); 

    const user_id = document.getElementById('user_id').value; 
    const transaction_id = generateTransactionId(); 
    const amount = document.getElementById('payment-amount').innerText;
    const city = document.getElementById('station_city').value;
    // error_log('City received: ' . $city);
    const date = new Date().toISOString().slice(0, 10); 
    console.log('Date:', date);
    const status = 'Pending'; // Initial status
    const station_company = document.getElementById('station_name').value; 

    const formData = new FormData();
    formData.append('user_id', user_id);
    formData.append('transaction_id', transaction_id);
    formData.append('amount', amount);
    formData.append('city', city);
    formData.append('date', date);
    formData.append('status', status);
    formData.append('station_company', station_company);

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/createBookingUser.php', true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            console.log('Response received:', xhttp.responseText); 
            const response = JSON.parse(xhttp.responseText);
            if (response.success) {
                alert('Transaction successfully created!');
                // window.location.href = 'credit-card.php';
                //send transaction_id to credit-card.php
                window.location.href = 'credit-card.php?transaction_id=' + transaction_id;
                
            } else {
                alert('Error creating transaction: ' + response.error);
            }
        }
    };
    console.log('Sending AJAX request'); 
    xhttp.send(formData);
}

function generateTransactionId() {
    return Math.floor(Math.random() * 100000000) + 1;
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('payment-form').addEventListener('submit', submitForm);
    document.getElementById('proceed-to-pay').addEventListener('click', proceedToPay);
});