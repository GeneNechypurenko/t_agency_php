<h2>Выберите тур</h2>
<hr>
<div class="form-group">
    <label for="country">Выберите страну:</label>
    <select id="country" class="form-control">
        <option value="0">Выберите страну...</option>
        <?php
        $mysqli = connect();
        $res = $mysqli->query("SELECT * FROM countries ORDER BY country");
        while ($row = $res->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['country']) . '</option>';
        }
        mysqli_free_result($res);
        ?>
    </select>
</div>

<div class="form-group">
    <label for="city">Выберите город:</label>
    <select id="city" class="form-control" disabled>
        <option value="0">Сначала выберите страну...</option>
    </select>
</div>

<div id="hotels" class="mt-4"></div>

<script>
    document.getElementById('country').addEventListener('change', function () {
        const countryId = this.value;
        const citySelect = document.getElementById('city');
        const hotelsDiv = document.getElementById('hotels');

        citySelect.innerHTML = '<option value="0">Загрузка городов...</option>';
        hotelsDiv.innerHTML = '';

        if (countryId !== '0') {
            fetch(`pages/cities.php?countryid=${countryId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="0">Выберите город...</option>';
                    data.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}">${city.city}</option>`;
                    });
                    citySelect.disabled = false;
                });
        } else {
            citySelect.innerHTML = '<option value="0">Сначала выберите страну...</option>';
            citySelect.disabled = true;
        }
    });

    document.getElementById('city').addEventListener('change', function () {
        const cityId = this.value;
        const hotelsDiv = document.getElementById('hotels');

        hotelsDiv.innerHTML = '<p>Загрузка отелей...</p>';

        if (cityId !== '0') {
            fetch(`pages/hotels.php?cityid=${cityId}`)
                .then(response => response.text())
                .then(data => {
                    hotelsDiv.innerHTML = data;
                });
        } else {
            hotelsDiv.innerHTML = '';
        }
    });
</script>
