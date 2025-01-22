
//payment1.php
function validateForm() {
    let isValid = true;
    const cardholder_name = document.getElementById('cardholder_name').value;
    const card_number = document.getElementById('card_number').value;
    const cvv = document.getElementById('cvv').value;
    const expiry_date = document.getElementById('expiry_date').value;

    
    if (!cardholder_name) {
        document.getElementById('err_cardholderName').innerText = 'Name is required';
        isValid = false;
    } else {
        document.getElementById('err_cardholderName').innerText = '';
    }

    if (!card_number || !validateCardNumber(card_number)) {
        document.getElementById('err_cardnumber').innerText = 'Invalid card number format';
        isValid = false;
    } else {
        document.getElementById('err_cardnumber').innerText = '';
    }

    if (!cvv || !validateCVV(cvv)) {
        document.getElementById('err_cvv').innerText = 'Invalid cvv format';
        isValid = false;
    } else {
        document.getElementById('err_cvv').innerText = '';
    }

    if (!expiry_date || !validateExpiryDate(expiry_date)) {
        document.getElementById('err_expdate').innerText = 'INvalid expiry date format';
        isValid = false;
    } else {
        document.getElementById('err_expdate').innerText = '';
    }

    return isValid;
}


function validateCardNumber(card_number) {
    const input = document.createElement('input');
    input.type = 'tel';
    input.pattern = '^\\d{16}$';
    input.value = card_number;
    return input.checkValidity();
}

function validateCVV(cvv) {
    const input = document.createElement('input');
    input.type = 'tel';
    input.pattern = '^\\d{3}$';
    input.value = cvv;
    return input.checkValidity();
}

function validateExpiryDate(expiry_date) {
    const input = document.createElement('input');
    input.type = 'tel';
    input.pattern = '^\\d{2}/\\d{2}$';
    input.value = expiry_date;
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
        xhttp.open('POST', '../controller/creditCheck.php', true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                console.log('Response received:', xhttp.responseText); 
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    window.location.href = '../view/invoice.php';
                } 

                else {
                    document.getElementById('err_cardholderName').innerText = response.errors.err_cardholderName || '';
                    document.getElementById('err_cardnumber').innerText = response.errors.err_cardnumber || '';
                    document.getElementById('err_cvv').innerText = response.errors.err_cvv || '';
                    document.getElementById('err_expdate').innerText = response.errors.err_expdate || '';
                }
            }
        };

        console.log('Sending AJAX request');
        xhttp.send(formData);
    }
}


function proceedToPayCredit(event) {
    event.preventDefault();
    console.log('proceedToPayCredit called'); 

    const user_id = document.getElementById('user_id').value;
    const transaction_id = document.getElementById('transaction_id').value;

    const formData = new FormData();
    formData.append('user_id', user_id);
    formData.append('transaction_id', transaction_id);

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/updateBookingUser.php', true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            console.log('Response received:', xhttp.responseText); 
            const response = JSON.parse(xhttp.responseText);
            if (response.success) {
                alert('Transaction successfully updated!');
                window.location.href = 'invoice.php?transaction_id=' + transaction_id;
            } else {
                alert('Error creating transaction: ' + response.error);
            }
        }
    };
    console.log('Sending AJAX request'); 
    xhttp.send(formData);
}

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

document.addEventListener('DOMContentLoaded', function () {
    const transaction_id = getQueryParam('transaction_id');
    if (transaction_id) {
        document.getElementById('transaction_id').value = transaction_id;
    }

    document.getElementById('payment-form').addEventListener('submit', submitForm);
    document.getElementById('completeBooking').addEventListener('click', proceedToPayCredit);
});