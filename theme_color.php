<?php
if (isset($_POST['submit'])) {
    $selected_theme = $_POST['theme'];
    // Do something with the selected theme value, such as saving it to a database or using it to change the website theme
    echo "theme name " . $selected_theme;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Radio Button Example</title>
    <style>
        #app {
            display: block;
            grid-area: app;
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            height: 200px;
        }

        .radio-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group label {
            display: inline-block;
            /* height: 100px; */
            width: 200px;
            border: 2px solid black;
            text-align: center;
            font-size: 1.5rem;
            line-height: 40px;
            cursor: pointer;

        }

        .radio-group label:hover {
            background-color: #ddd;
        }

        .radio-group input[type="radio"]:checked+label {
            background-color: #555;
            color: white;
        }
    </style>
</head>

<body>


    <div id="app">
        This is the app content.
        <form method="post">
            <div class="radio-group">
                <input type="radio" name="theme" id="dark" value="Dark">
                <label style="background: #121212; color: white" for="dark">Dark theme</label>
                <input type="radio" name="theme" id="light" value="light">
                <label style="background:lightblue;color: black" for="light">Light theme</label>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>


    <script>
        const app = document.getElementById('app');
        const darkRadio = document.getElementById('dark');
        const lightRadio = document.getElementById('light');

        darkRadio.addEventListener('change', () => {
            if (darkRadio.checked) {
                app.style.backgroundColor = '#555555';
            }
        });

        lightRadio.addEventListener('change', () => {
            if (lightRadio.checked) {
                app.style.backgroundColor = 'lightblue';
            }
        });
    </script>
</body>

</html>