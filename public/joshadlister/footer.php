<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Moment JS -->
    <script src="js/moment.js"></script>
    <script>
        // DISPLAY RELATIVE DATES WHEN AD WAS POSTED
        var dates = document.getElementsByClassName("listDate");
        for (var i = 0; i < dates.length; i++) {
            dates[i].innerText = moment(dates[i].innerText, 'YYYY MMM DD').fromNow();
        }

    </script>
</body>
</html>