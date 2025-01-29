// Function to fetch and display booking notifications
async function fetchBookingNotification() {
    try {
        const response = await fetch('booking_notification.php');
        const notification = await response.text();

        // Display the notification
        if (notification) {
            alert(notification); // You can customize this to show notification in a more user-friendly way
        }
    } catch (error) {
        console.error('Error fetching booking notification:', error);
    }
}

// Call fetchBookingNotification function periodically
setInterval(fetchBookingNotification, 5000); // Fetch notification every 5 seconds
