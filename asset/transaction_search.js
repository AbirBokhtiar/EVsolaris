

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('searchButton').addEventListener('click', function () {
        const query = document.getElementById('searchInput').value;
        searchTransactions(query);
    });

    document.getElementById('searchInput').addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            const query = event.target.value;
            searchTransactions(query);
        }
    });

    document.getElementById('clearButton').addEventListener('click', function () {
        document.getElementById('searchInput').value = '';
        loadAllTransactions();
    });
});

function searchTransactions(query) {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../controller/searchTransactions.php?query=' + encodeURIComponent(query), true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            document.getElementById('transactionTable').innerHTML = xhttp.responseText;
        }
    };
    xhttp.send();
}

function loadAllTransactions() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../controller/searchTransactions.php', true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            document.getElementById('transactionTable').innerHTML = xhttp.responseText;
        }
    };
    xhttp.send();
}