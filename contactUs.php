<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>
<style>
    #cubox {
    height: 100vh;
    width: auto;
    margin: 120px 0 -120px 0;
    background-color: #F7FBFC;
    position: relative;
    }

    #cucontainer {
        width: 60%;
        margin: 20px auto;
        padding: 0 40px;
        border-radius: 5px;
        line-height: 3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: seashell;
        text-align: center;
    }
</style>

<body>
    <?php include 'userNavigationBar.php'; ?>

    <main>
        <div id="cubox">
            <h1  style="margin: 25px;">Contact Us</h1>
            <div id="cucontainer">
                <table>
                    <tr>
                        <th><h4>Field</h4></th>
                        <th><h4>Details</h4></th>
                    </tr>
                    <tr>
                        <td>Name/Registration No.</td>
                        <td>Paws Print Hub<br>PPH-G29-03-22082024</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Lot 23A-29, Jalan XYZ Subang Jaya,<br>47100 Subang, Selangor, Malaysia</td>
                    </tr>
                    <tr>
                        <td>Operation Hours</td>
                        <td>Sundays - Closed<br>Mon-Sat - 9am - 4pm</td>
                    </tr>
                    <tr>
                      <td>Contact Number</td>
                      <td>(+60)12-345 6789</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>pawsprinthub@gmail.com</td>
                    </tr>
                  </table>
            </div>
    </main>
    
</body>
</html>
