const monthYear = document.getElementById("monthYear");
const calendarBody = document.getElementById("calendarBody");
const prevMonthBtn = document.getElementById("prevMonth");
const nextMonthBtn = document.getElementById("nextMonth");

let currentDate = new Date();

function renderCalendar() {
    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    
    monthYear.textContent = firstDay.toLocaleString("en-US", { month: "long", year: "numeric" });

    let days = "";
    let dayOfWeek = firstDay.getDay();

    // Fill blank spaces for the first row
    for (let i = 0; i < dayOfWeek; i++) {
        days += "<td></td>";
    }

    // Fill days of the month
    for (let day = 1; day <= lastDay.getDate(); day++) {
        days += `<td onclick="markAttendance(this)">${day}</td>`;
        dayOfWeek++;
        if (dayOfWeek === 7) {
            days += "</tr><tr>";
            dayOfWeek = 0;
        }
    }

    calendarBody.innerHTML = `<tr>${days}</tr>`;
}

function markAttendance(cell) {
    if (cell.classList.contains("present")) {
        cell.classList.remove("present");
        cell.classList.add("absent");
    } else if (cell.classList.contains("absent")) {
        cell.classList.remove("absent");
    } else {
        cell.classList.add("present");
    }
}

prevMonthBtn.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);   
    renderCalendar();
});

nextMonthBtn.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

renderCalendar();
