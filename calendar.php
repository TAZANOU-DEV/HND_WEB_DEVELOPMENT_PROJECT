<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Calendar</title>
    <link rel="stylesheet" href="calendar.css">
</head>
<body>

    <div class="calendar-container">
        <h2>Attendance Calendar</h2>
        <div class="calendar-header">
            <button id="prevMonth">❮</button>
            <h3 id="monthYear"></h3>
            <button id="nextMonth">❯</button>
        </div>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody id="calendarBody"></tbody>
        </table>
    </div>

    <script src="calendar.js"></script>
</body>
</html>
