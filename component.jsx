import React, { useState } from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import axios from "axios";

const AttendanceForm = () => {
  const [selectedDate, setSelectedDate] = useState(new Date());
  const [studentId, setStudentId] = useState("");

  const markAttendance = () => {
    axios
      .post("http://localhost:5000/api/mark-attendance", {
        student_id: studentId,
        date: selectedDate.toISOString().split("T")[0], // Format: YYYY-MM-DD
      })
      .then((response) => {
        alert("Attendance Marked Successfully!");
      })
      .catch((error) => {
        console.error("Error marking attendance:", error);
      });
  };

  return (
    <div>
      <h2>Mark Attendance</h2>
      <label>Student ID: </label>
      <input
        type="text"
        value={studentId}
        onChange={(e) => setStudentId(e.target.value)}
        placeholder="Enter Student ID"
      />
      <br />
      <label>Select Date: </label>
      <DatePicker selected={selectedDate} onChange={(date) => setSelectedDate(date)} dateFormat="yyyy-MM-dd" />
      <br />
      <button onClick={markAttendance}>Submit Attendance</button>
    </div>
  );
};

export default AttendanceForm;
