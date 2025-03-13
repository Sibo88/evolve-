const timeElement = document.querySelector(".time");
const dateElement = document.querySelector(".date");

/**
 * @param {Date} date
 */
function formatTime(date) {
  const hours12 = date.getHours() % 12 || 12;
  const minutes = date.getMinutes();
  const isAm = date.getHours() < 12;

  return `${hours12.toString().padStart(2, "0")}:${minutes
    .toString()
    .padStart(2, "0")} ${isAm ? "AM" : "PM"}`;
}

/**
 * @param {Date} date
 */
function formatDate(date) {
  const DAYS = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ];
  const MONTHS = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];

  return `${DAYS[date.getDay()]}, ${
    MONTHS[date.getMonth()]
  } ${date.getDate()} ${date.getFullYear()}`;
}

setInterval(() => {
  const now = new Date();

  timeElement.textContent = formatTime(now);
  dateElement.textContent = formatDate(now);
}, 2000);

// Function to handle card swipe (simulated or actual)
function handleCardSwipe(rfidCardNumber) {
  // Send POST request to backend
  fetch('attendance.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `rfid_card=${rfidCardNumber}`
  })
  .then(response => response.json())
  .then(data => {
      if (data.status === "in") {
          alert(`${data.student_name} has entered at ${data.in_time}`);
      } else if (data.status === "out") {
          alert(`${data.student_name} has left. Attendance: ${data.attendance_status}`);
      }
      fetchAttendanceRecords(); // Refresh the table
  })
  .catch(error => console.error('Error:', error));
}

// Function to fetch and update the attendance table
function fetchAttendance() {
  fetch('attendance.php')
      .then(response => response.json())
      .then(data => {
          let tableBody = document.querySelector("tbody");
          tableBody.innerHTML = "";
          data.forEach(record => {
              let row = `<tr>
                          <td>${record.id}</td>
                          <td>${record.fullname}</td>
                          <td>${record.in_time}</td>
                          <td>${record.out_time || '---'}</td>
                          <td>${record.attendance_status || '---'}</td>
                        </tr>`;
              tableBody.innerHTML += row;
          });
      })
      .catch(error => {
          console.error("Error fetching attendance records:", error);
      });
}


// Helper function to format time
function formatTime(date) {
  const hours12 = date.getHours() % 12 || 12;
  const minutes = date.getMinutes().toString().padStart(2, "0");
  const amPm = date.getHours() < 12 ? 'AM' : 'PM';
  return `${hours12}:${minutes} ${amPm}`;
}

// Example: Simulate a swipe event
document.addEventListener('DOMContentLoaded', function() {
  // Simulate a swipe with RFID card number
  handleCardSwipe('123456'); // Replace with actual card number from your login table
});

// Call to fetch attendance records on page load
fetchAttendanceRecords();

