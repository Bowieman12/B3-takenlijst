<!doctype html>
<html lang="nl">

<head>
    <title>Document</title>
</head>

<body>

    <div class="container">
        <h1>Formulier</h1>

        <form action="../backend/tasksController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="naam">Titel:</label>
                <input type="text" name="titel" id="titel" class="form-input">
            </div>

            <div class="form-group">
                <label for="opdracht">Afdeling:</label>
                <input type="text" name="afdeling" id="afdeling" class="form-input">
            </div>

            <div class="form-group">
                <label for="extra">Beschrijving?</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4"></textarea>
            </div>


            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>