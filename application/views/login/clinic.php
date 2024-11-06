<!DOCTYPE html>
<html lang="en">
</body>

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to our OBGYN Clinic. We provide comprehensive gynecological and obstetric care.">
    <link rel="icon" href="<?php echo base_url('assets/logo/favicon.ico'); ?>" type="image/x-icon">
    <title>OBGYN Clinic</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <style type="text/tailwindcss">
        @layer base {
            body, html {
                font-family: 'Arial', sans-serif;
                background-color: #f7fafc; 
                height: 100%;
  margin: 0;
            }
            .full-screen {
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
            .hero {
                position: relative;
                background-image: url('<?php echo base_url("upload/obgy.jpg"); ?>');
                background-size: cover;
                background-position: center;
                color: white;
                padding: 100px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
                overflow: hidden; /* Ensure child elements are clipped */
            }

            .hero::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image: inherit;
                background-size: cover;
                background-position: center;
                filter: blur(8px);
                z-index: -1;
            }

            .service-card {
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .doctor-card {
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            .contact-info {
                background-color: rgba(255, 255, 255, 0.9);  
                border-radius: 8px;
                padding: 35px;
                margin-bottom: 20px;
            }

            .text-green-custom {
                color: #6dbf8c;
            }

            .bg-green-custom {
                background-color: #b2e1b2; 
            }

            .bg-green-custom-dark {
                background-color: #8fbf8f; 
            }
        }

        .fc {
            font-size: 14px;
        }
    </style>

</head>

<body>
    <div class="container mx-auto p-4">
        <header class="bg-green-custom-dark text-green-100 py-4 px-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-center">OBGYN CLINIC</h1>
            <nav class="flex justify-center mt-4">
                <a href="<?= base_url('clinic/index'); ?>" class="text-green-100 hover:text-green-200 mx-3">Home</a>
                <a href="#services" class="text-green-100 hover:text-green-200 mx-3">Services</a>
                <a href="#about" class="text-green-100 hover:text-green-200 mx-3">About</a>
                <a href="#contact" class="text-green-100 hover:text-green-200 mx-3">Contact</a>
            </nav>
        </header>

        <main class="bg-gray-100 text-gray-800 py-8 rounded-lg mt-4 shadow-md">
            <!-- Hero Section-->
            <section id="home" class="hero text-center">
                <h2 class="text -4xl font-bold mb-4">Welcome to our OBGYN Clinic</h2>
                <p class="mb-6">We provide gyncological and obstetric care with a compassionate touch.</p>
                <a href="#book-appointment" class="bg-green-custom text-white py-2 px-4 rounded-lg hover:bg-green-700">Book Appointment</a>
            </section>

            <!-- Our Services -->
            <section id="services" class="max-w-4xl mx-auto mt-8">
                <h2 class="text-3xl font-bold mb-4 text-center text-green-custom">Our Services</h2>
                <p class="mb-4 text-center">Explore the range of services we offer at our OBGYN Clinic.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="service-card p-4">
                        <h3 class="text-lg font-semibold mb-2">Parental Check Up and Delivery</h3>
                        <p>Comprehensive care throughout pregnancy, including delivery services.</p>
                    </div>
                    <div class="service-card p-4">
                        <h3 class="text-lg font-semibold mb-2">Gyn-cologic Check Up</h3>
                        <p>Routine check-ups to ensure gynecological health and address any concerns.</p>
                    </div>
                    <div class="service-card p-4">
                        <h3 class="text-lg font-semibold mb-2">Basic Infertility Work Up</h3>
                        <p>Initial assessments to diagnose and address potential causes of infertility.</p>
                    </div>
                    <div class="service-card p-4">
                        <h3 class="text-lg font-semibold mb-2">OBGYN Ultrasound</h3>
                        <p>Ultrasound imaging to monitor pregnancy and evaluate gynecological conditions.</p>
                    </div>
                </div>
            </section>

            <!-- About Us Section -->
            <section id="about" class="max-w-4xl mx-auto mt-8 text-center">
                <h2 class="text-3xl font-bold mb-4 text-green-custom">About Us</h2>
                <p class="mb-4">Established in 1968, Mendoza General Hospital is a recognized healthcare institution in Sta. Maria, Bulacan, Philippines. Services: Surgery, OBGYN, Pediatrics, Internal Medicine, Ophthalmology, EENT, Orthopedics, Urology, Medical Oncology, etc.</p>
                <div class="doctor-card p-6 mt-6">
                    <h2 class="text-3xl font-bold mb-4">Physician</h2>
                    <h3 class="text-lg font-semibold mb-2">Dra. Ma. Chona M. Mendoza MD, FPOGS, FPSUOG</h3>
                    <hr>
                </div>
            </section>

            <!-- Doctor Section -->
            <section id="doctor" class="max-w-4xl mx-auto mt-16 text-center">
                <h2 class="text-3xl font-bold mb-4 text-green-custom">Meet Our Doctor</h2>
                <div class="flex justify-center items-center mt-8">
                    <div class="doctor-card p-6 rounded-lg text-center max-w-lg">
                        <img src="<?php echo base_url('upload/drachona.png'); ?>" alt="Dr. Ma. Chona M. Mendoza" class="w-40 h-40 rounded-full mx-auto mb-4">
                        <h3 class="text-2xl font-semibold">Dra. Ma. Chona M. Mendoza MD, FPOGS, FPSUOG</h3>
                        <p class="mt-2 text-gray-600">OB-GYN Specialist</p>
                        <hr class="my-4">
                        <p class="text-gray-700">Dr. Mendoza has over 20 years of experience in Obstetrics and Gynecology. She is a Fellow of the Philippine Obstetrical and Gynecological Society (FPOGS) and the Philippine Society of Ultrasound in Obstetrics and Gynecology (FPSUOG). She specializes in prenatal care, gynecologic surgeries, and ultrasound diagnostics. With a compassionate approach, she ensures every patient receives personalized and attentive care.</p>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="max-w-4xl mx-auto mt-8 text-center">
                <h2 class="text-3xl font-bold mb-4 text-green-custom">Contact Us</h2>
                <div class="contact-info">
                    <p class="mb-2">Phone: <a href="tel:+639952302499" class="text-green -custom">+63 995 230 2499</a></p>
                    <p class="mb-2">Email: <a href="mailto:info@mendozagenhospital.com" class="text-green-custom">info@mendozagenhospital.com</a></p>
                    <p class="mb-2">Location: <a href="https://www.google.com/maps/place/Mendoza+General+Hospital,+A+Morales+St,+Santa+Maria,+Bulacan,+Philippines/@14.8531229,120.9627468,14z/data=!4m8!4m7!1m0!1m5!1m1!1s0x33b14e6bd105b5bb:0x2d5880b2df9d4307!2m2!1d120.9760535!2d14.853124" target="_blank" class="text-green-custom">Get Directions</a></p>
                </div>
            </section>

            <!-- Appointment Section -->
            <div class="formcontainer mx-auto p-6">
                <section id="book-appointment" class="bg-green-custom text-white p-6 rounded-lg mt-6 shadow-md">
                    <h2 class="text-2xl font-bold mb-4 text-center">Book an Appointment</h2>
                    <p class="text-2xl font-bold mb-4 text-center">Please book an appointment 3 - 4 business days</p>
                    <form action="<?= base_url('onlineappointments/onlinestore'); ?>" method="post" class="space-y-4">
                        <!-- Success Message -->
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="bg-green-200 text-green-800 p-3 rounded-lg mb-4">
                                <p class="font-medium"><?= $this->session->flashdata('success'); ?></p>
                                <p class="mt-1">Please wait for the approval confirmation email. Once you receive an email of approved message, you can reply to cancel your appointment via reply to the email.</p>
                            </div>
                        <?php endif; ?>

                        <!-- Warning Messages -->
                        <?php if ($this->session->flashdata('warning')): ?>
                            <div class="bg-yellow-200 text-yellow-800 p-3 rounded-lg mb-4">
                                <p class="font-medium"><?= $this->session->flashdata('warning'); ?></p>
                                <?php
                                $warning_type = $this->session->flashdata('warning');
                                if ($warning_type === 'minute_limit'): ?>
                                    <p class="mt-1">You can only book an appointment every minute with the same email.</p>
                                <?php elseif ($warning_type === 'time_booked'): ?>
                                    <p class="mt-1">You can’t book this time; it’s already booked.</p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form Fields -->
                        <div class="flex flex-col mb-3">
                            <label for="email" class="text-sm font-medium mb-1">Email:</label>
                            <input type="email" class="bg-gray-100 border border-gray-300 rounded-lg p-2 text-black focus:outline-none focus:ring-2 focus:ring-green-500" id="email" name="email" placeholder="Enter email" aria-label="Email" required>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="firstname" class="text-sm font-medium mb-1">First Name:</label>
                            <input type="text" class="bg-gray-100 border border-gray-300 rounded-lg p-2 text-black focus:outline-none focus:ring-2 focus:ring-green-500" id="firstname" name="firstname" placeholder="Enter first name" aria-label="First Name" required>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="lastname" class="text-sm font-medium mb-1">Last Name:</label>
                            <input type="text" class="bg-gray-100 border border-gray-300 rounded-lg p-2 text-black focus:outline-none focus:ring-2 focus:ring-green-500" id="lastname" name="lastname" placeholder="Enter last name" aria-label="Last Name" required>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="contact_number" class="text-sm font-medium mb-1">Contact Number:</label>
                            <input type="tel" class="bg-gray-100 border border-gray-300 rounded-lg p-2 text-black focus:outline-none focus:ring-2 focus:ring-green-500" id="contact_number" name="contact_number" placeholder="Enter your contact number" aria-label="Contact Number" required>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="appointment_date" class="text-sm font-medium mb-1">Appointment Date:</label>
                            <input type="date" class="bg-gray-100 border border-gray-300 rounded-lg p-2 text-black focus:outline-none focus:ring-2 focus:ring-green-500" id="appointment_date" name="appointment_date" aria-label="Appointment Date" required>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="appointment_time" class="text-sm font-medium mb-1">Appointment Time:</label>
                            <select class="bg-gray-100 border border-gray-300 rounded-lg p-2 text-black focus:outline-none focus:ring-2 focus:ring-green-500" id="appointment_time" name="appointment_time" aria-label="Appointment Time" required>
                                <!-- Time options will be populated here -->
                            </select>
                        </div>


                        <div class="bg-gray-100 text-gray-800 p-3 rounded-lg mb-4">
                            <h3 class="font-semibold mb-2 text-center">Clinic Hours</h3>
                            <ul class="space-y-1 text-center text-sm">
                                <li>Monday: 9 AM - 5 PM</li>
                                <li>Tuesday: 9 AM - 5 PM</li>
                                <li>Wednesday: 9 AM - 5 PM</li>
                                <li>Thursday: 9 AM - 5 PM</li>
                                <li>Friday: 9 AM - 5 PM</li>
                                <li>Saturday: Closed</li>
                                <li>Sunday: Closed</li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-200 w-full">Book Now</button>
                    </form>
                </section>
            </div>

            <!-- Add some CSS for the container (if needed) -->
            <style>
                .formcontainer {
                    max-width: 800px;
                    /* Adjust this value to change the maximum width */
                    margin: 0 auto;
                    /* Center the container */
                }

                .bg-green-custom {
                    background-color: #6bbf77;

                }
            </style>



            <!-- Appointment Calendar -->
            <section id="book-appointment" class="max-w-4xl mx-auto mt-8">
                <h2 class="text-3xl font-bold mb-4 text-center text-green-custom">Book Your Appointment</h2>
                <div id="calendar" class="mt-4"></div>
            </section>
        </main>

        <!-- <footer class="text-center py-4">
    <p class="text-gray-600">© 2024 OBGYN Clinic. All Rights Reserved.</p>
</footer> -->
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: {
                    url: '<?= site_url('calendar/get_events'); ?>', // Call the new method
                    method: 'GET',
                    failure: function() {
                        alert('There was an error while fetching events!');
                    }
                },
                eventRender: function(event, element) {
                    // Remove the clickability
                    element.removeAttr('href'); // Remove href if it exists
                    element.css('cursor', 'default'); // Change cursor to default
                }
            });
        });
    </script>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    </main>

    <!-- <footer class="bg-green-500 text-green-100 py-4 px-6 text-center">
            <p>&copy; <?= date('Y'); ?> OBGYN Clinic. All rights reserved.</p>
        </footer> -->
    <!-- dont delete the script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const appointmentDateInput = document.getElementById("appointment_date");
            const appointmentTimeSelect = document.getElementById("appointment_time");

            // Set min date to today and set today's date as default
            const today = new Date();
            const philippinesTimeOffset = 8 * 60; // Offset in minutes for UTC+8
            today.setMinutes(today.getMinutes() + today.getTimezoneOffset() + philippinesTimeOffset);

            const todayString = today.toISOString().split("T")[0];
            appointmentDateInput.setAttribute("min", todayString);
            appointmentDateInput.value = todayString; // Set current date as default

            // Define lunch break slots for exclusion
            const lunchBreakSlots = [{
                    hour: 11,
                    minute: 30
                },
                {
                    hour: 12,
                    minute: 0
                },
                { hour: 17, minute: 0 },
                {
                    hour: 17,
                    minute: 30
                }
                
            ];

            // Helper function to check if the time is within lunch break
            function isLunchBreak(hour, minute) {
                return lunchBreakSlots.some(slot => slot.hour === hour && slot.minute === minute);
            }

            // Function to populate time slots based on selected date and current time
            function populateTimeSlots() {
                const selectedDate = new Date(appointmentDateInput.value);
                const now = new Date();
                now.setMinutes(now.getMinutes() + now.getTimezoneOffset() + philippinesTimeOffset); // Convert current time to Philippine time

                // Clear previous options
                appointmentTimeSelect.innerHTML = "";

                // Generate time options in 30-minute intervals from the current time to 5:00 PM Philippine time
                if (selectedDate.toDateString() === now.toDateString()) {
                    let startHour = now.getHours();
                    let startMinute = now.getMinutes() >= 30 ? 30 : 0;
                    const endHour = 17;

                    for (let hour = startHour; hour <= endHour; hour++) {
                        for (let minute = startMinute; minute < 60; minute += 30) {
                            if (isLunchBreak(hour, minute)) continue;

                            const option = document.createElement("option");
                            const formattedHour = hour > 12 ? hour - 12 : hour; // Convert to 12-hour format
                            const formattedMinute = minute === 0 ? '00' : minute;
                            const amPm = hour >= 12 ? 'PM' : 'AM';

                            option.value = `${hour.toString().padStart(2, '0')}:${formattedMinute}`; // Store as 'HH:MM'
                            option.textContent = `${formattedHour}:${formattedMinute} ${amPm}`; // Display in 12-hour format
                            appointmentTimeSelect.appendChild(option);
                        }
                        startMinute = 0; // Reset startMinute after the first hour
                    }
                } else {
                    // For other future dates, show all slots from 9:00 AM to 5:00 PM
                    for (let hour = 9; hour <= 17; hour++) {
                        for (let minute = 0; minute < 60; minute += 30) {
                            if (isLunchBreak(hour, minute)) continue;

                            const option = document.createElement("option");
                            const formattedHour = hour > 12 ? hour - 12 : hour;
                            const formattedMinute = minute === 0 ? '00' : minute;
                            const amPm = hour >= 12 ? 'PM' : 'AM';

                            option.value = `${hour.toString().padStart(2, '0')}:${formattedMinute}`;
                            option.textContent = `${formattedHour}:${formattedMinute} ${amPm}`;
                            appointmentTimeSelect.appendChild(option);
                        }
                    }
                }
            }

            // Update time slots every minute to ensure past times are removed
            setInterval(() => {
                if (appointmentDateInput.value === todayString) {
                    populateTimeSlots();
                }
            }, 60000); // Refresh every 60 seconds

            // Initial population of time slots
            appointmentDateInput.addEventListener("change", populateTimeSlots);
            populateTimeSlots();
        });
    </script>

    </div>
</body>

</html>