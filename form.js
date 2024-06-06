window.onload = function() {
    // Get the book name from the URL query string
    const urlParams = new URLSearchParams(window.location.search);
    const bookName = urlParams.get('bookName');
    
    // Set the book name in the form field
    document.getElementById('book-id').value = bookName;
  };

  document.getElementById('borrowingdate').addEventListener('change', function() {
    let borrowingDate = new Date(this.value);
    borrowingDate.setDate(borrowingDate.getDate() + 14);  // Adding 14 days
    document.getElementById('returndate').value = borrowingDate.toISOString().split('T')[0];
});