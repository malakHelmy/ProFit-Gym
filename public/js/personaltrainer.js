
    // Get references to the card elements
    const cards = document.querySelectorAll('.card');

    const booktrainers = document.querySelectorAll("#trainer-booking");



    const modal = document.getElementById("myModal");
    const confirmationText = document.getElementById("confirmation-text");
    const confirmFreeButton = document.getElementById("confirm-free-button");
    const confirmPackageButton = document.getElementById("confirm-package-button");
    const closeBtn = document.querySelector(".close-popup");
    const modalMessage = document.getElementById("modal-message");

    const popup = document.getElementById("myPopup");
    const popupconfirm = document.getElementById("popup-confirm");
    const popupconfirmButton = document.getElementById("popup-confirm-button");
    const popupcancelButton = document.getElementById("popup-cancel-button");
    const popupclose = document.querySelector(".popup-close");
    const popupMessage = document.getElementById("popup-message");



    function showpopup(message) {
      popupconfirm.textContent = message;
      popup.style.display = "block";
      popupconfirmButton.style.display = "block";
      popupcancelButton.style.display = "block";
      popupMessage.style.display="none";
  }
  
  function resetpopup() {
      popup.style.display = "none";
      popupconfirm.textContent = '';
      popupconfirmButton.style.display = "none";
      popupcancelButton.style.display = "none";
      popupMessage.style.display="none";
  }

  function showmodal(message) {
    confirmationText.textContent = message;
    modal.style.display = "block";
    confirmFreeButton.style.display = "block";
    confirmPackageButton.style.display = "block";
    modalMessage.style.display="none";
}

function resetmodal() {
    modal.style.display = "none";
    confirmationText.textContent = '';
    confirmFreeButton.style.display = "none";
    confirmPackageButton.style.display = "none";
    modalMessage.style.display="none";
}

    // Get reference to the details section
    const detailsSection = document.querySelector('#all-avail-times');

    // Add a click event listener to each card
    cards.forEach((card) => {
      card.addEventListener('click', () => {
        // Toggle the visibility of the details section


            detailsSection.style.display="block";
            showmodal("View Private Training packages for this coach ?");

        closeBtn.addEventListener('click', () => {
            resetmodal();
        });

        confirmFreeButton.addEventListener('click', () => {
        if (confirmationText.textContent) {
            
            resetmodal();

            detailsSection.style.display = 'block';


            booktrainers.forEach((booktrainer) => {
                booktrainer.addEventListener('click', () => {
                    showpopup("Are you sure you want to book one of your free personal trainer sessions?");


                    popupclose.addEventListener('click', () => {
                        resetpopup();
                    });

                    popupconfirmButton.addEventListener('click', () => {
                        if (popupconfirm.textContent) {
                            
                          resetpopup();
                          popup.style.display="block";
                          popupMessage.style.display="block";
                          popupMessage.textContent = "Booking successful and details will also be sent by mail soon.";
                        }
                    });

                    popupcancelButton.addEventListener("click", () => {
                        if (popupconfirm.textContent) {

                          resetpopup();
                
                        }
                    });


                    
                });
            });


        }

    });

        confirmPackageButton.addEventListener('click', () => {
        if (confirmationText.textContent) {
          resetpopup();

            window.location.href = "bookptpackage.php"; 

        }
        

        });

    });
});


// Get references to the slider elements
const slider = document.querySelector('.slider');
const prevSlideBtn = document.querySelector('.prev-slide');
const nextSlideBtn = document.querySelector('.next-slide');
const availableTimes = document.querySelectorAll('.available-times');
let currentSlide = 0;

// Function to show the current slide
function showSlide(slideIndex) {
  // Hide all available times
  availableTimes.forEach((time) => {
    time.style.display = 'none';
  });
  // Show the selected slide
  availableTimes[slideIndex].style.display = 'block';
}

// Show the initial slide
showSlide(currentSlide);

// Click event for the "Previous" button
prevSlideBtn.addEventListener('click', () => {
  currentSlide--;
  if (currentSlide < 0) {
    currentSlide = 0; // Prevent going to a negative slide index
  }
  showSlide(currentSlide);
});

// Click event for the "Next" button
nextSlideBtn.addEventListener('click', () => {
  currentSlide++;
  if (currentSlide >= availableTimes.length) {
    currentSlide = availableTimes.length - 1; // Prevent going beyond the last slide
  }
  showSlide(currentSlide);
});

     




    



    