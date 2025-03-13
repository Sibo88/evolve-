function checkRFID() {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'check_rfid_status.php', true); // Calls the PHP to check RFID card status
  xhr.onload = function () {
      if (xhr.status === 200) {
          const result = JSON.parse(xhr.responseText);

          const loader = document.getElementById('loader');
          const message = document.getElementById('message');
          const resultIcon = document.getElementById('result-icon');

          loader.style.display = 'none'; // Hide loader

          if (result.status === 'fail') {
              resultIcon.innerHTML = '&#10060;'; // White Cross in Red Circle (Unicode)
              resultIcon.classList.add('fail');
              resultIcon.style.display = 'block';
              message.innerText = 'RFID Card already registered. Access denied.';
          } else if (result.status === 'success') {
              resultIcon.innerHTML = '&#10004;'; // Green Checkmark (Unicode)
              resultIcon.classList.add('success');
              resultIcon.style.display = 'block';
              message.innerText = 'RFID Card is valid. Registering student...';

              // Redirect after successful registration
              setTimeout(() => {
                  window.location.href = 'register_success.html'; // Redirect to success page
              }, 2000);
          } else {
              // Retry if no RFID card is detected or error
              message.innerText = 'Waiting for RFID card. Please scan again.';
              setTimeout(checkRFID, 2000); // Retry every 2 seconds
          }
      } else {
          console.error('Error: ', xhr.status);
      }
  };
  xhr.send();
}

// Call the checkRFID function after 2 seconds (to simulate waiting for card)
setTimeout(checkRFID, 2000);
