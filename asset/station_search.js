document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('searchButton').addEventListener('click', function () {
        const query = document.getElementById('searchInput').value;
        const cities = getSelectedCities();
        searchStations(query, cities);
    });

    document.getElementById('searchInput').addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            const query = event.target.value;
            const cities = getSelectedCities();
            searchStations(query, cities);
        }
    });

    document.getElementById('clearButton').addEventListener('click', function () {
        document.getElementById('searchInput').value = '';
        clearCheckboxes();
        loadAllStations();
    });
});

function getSelectedCities() {
    const cityCheckboxes = document.querySelectorAll('#city input[type="checkbox"]:checked');
    const selectedCities = [];
    cityCheckboxes.forEach(checkbox => {
        selectedCities.push(checkbox.value);
    });
    return selectedCities;
}

function searchStations(query, cities) {
    const xhttp = new XMLHttpRequest();
    let url = '../controller/searchStations.php?query=' + encodeURIComponent(query);
    if (cities.length > 0) {
        url += '&city[]=' + cities.join('&city[]=');
    }
    xhttp.open('GET', url, true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            document.getElementById('station_grid').innerHTML = xhttp.responseText;
        }
    };
    xhttp.send();
}

function loadAllStations() {
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../controller/searchStations.php', true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            document.getElementById('station_grid').innerHTML = xhttp.responseText;
        }
    };
    xhttp.send();
}

function clearCheckboxes() {
    const checkboxes = document.querySelectorAll('#city input[type="checkbox"]:checked');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
}