<!DOCTYPE HTML>
<html>
    <body>
        <h1>Event Selection<h1>
        <h4>Choose Event<h4>
        <select>
            <option value="Jazz">Jazz</option>
            <option value="Dance">Dance</option>
            <option value="Food">Food</option>
        </select>

        <h4>Choose Date<h4>
        <select>
            <option value="26th">26th</option>
            <option value="27th">27th</option>
            <option value="28th">28th</option>
        </select>

        <h4>Choose Child Amount<h4>
        <form action="/action_page.php">
            <input type="text" name="Amount" value=""><br>
        </form>

        <h4>Choose Adult Amount<h4>
        <form action="/action_page.php">
            <input type="text" name="Amount" value=""><br>
        </form>
        
        <br>
        <form action="/action_page.php">
            <input type="submit" name="Submit">
        </form>
    </body>
</html>