<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULAIRE</title>
</head>
<body>
    <h1>CONNECTEZ-VOUS ICI</h1>

    <form action="tlogin.php" method="post">
        <table>
            <tr>
                <td>
                    <label>NOM:</label>
                </td>
                <td>
                    <input type="text" placeolder="ECRIVEZ VOTRE NOM" name="nom_user">
                </td>
            </tr>

            <tr>
                <td>
                    <label>EMAIL:</label>
                </td>
                <td>
                    <input type="text" placeloder="ECRIVEZ VOTRE NOM" name="email_user">
                </td>
            </tr>

            <tr>
                <td>
                    <label>MOT DE PASSE:</label>
                </td>
                <td>
                    <input type="password" placeloder="ECRIVEZ VOTRE NOM" name="pass_user">
                </td>
            </tr>

            <tr>
                <td>
                    <button type="submit">CONNEXION</button>
                </td>
            </tr>

        </table>
    </form>
</body>
</html>