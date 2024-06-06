window.addEventListener('beforeunload', function (e) {
    // Perform Ajax request to log the user out
    // Make sure to replace 'logout-url' with the actual URL to your logout route
    // This assumes you're using Axios for Ajax, adjust accordingly if not
    axios.post('logout-url')
        .then(response => {
            // Handle successful logout if needed
        })
        .catch(error => {
            // Handle error if needed
        });
});
