    // Function to get URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
      };
  
      // Check if the signup success flag is present in the URL
      var signupSuccess = getUrlParameter('signupSuccess');
      if (signupSuccess === 'true') {
        // Display the popup
        alert('Sign up successful! Please log in with your credentials.');
      }