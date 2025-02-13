const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "attendance_db",
});

// Endpoint to store attendance in MySQL
app.post("/api/mark-attendance", (req, res) => {
  const { student_id, date } = req.body;
  if (!student_id || !date) {
    return res.status(400).send("Student ID and Date are required");
  }

  db.query(
    "INSERT INTO attendance (student_id, date) VALUES (?, ?)",
    [student_id, date],
    (err) => {
      if (err) return res.status(500).send(err);
      res.send("Attendance recorded successfully");
    }
  );
});

app.listen(5000, () => console.log("Server running on port 5000"));
