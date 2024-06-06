document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.parentElement.parentElement;
        row.querySelectorAll('.view-mode').forEach(span => span.style.display = 'none');
        row.querySelectorAll('.edit-mode').forEach(input => input.style.display = 'block');
        row.querySelector('.edit-btn').style.display = 'none';
        row.querySelector('.save-btn').style.display = 'inline';
    });
});

document.querySelectorAll('.save-btn').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.parentElement.parentElement;
        const name = row.querySelector('input[type="text"]:nth-child(1)').value;
        const email = row.querySelector('input[type="text"]:nth-child(3)').value;
        const phone = row.querySelector('input[type="text"]:nth-child(5)').value;
        
        // Send AJAX request to update.php
        fetch('update.php', {
            method: 'POST',
            body: JSON.stringify({ id: row.dataset.id, name: name, email: email, phone: phone }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Handle response from server
            
            if(data === "Record updated successfully") {
                row.querySelectorAll('.view-mode').forEach(span => {
                    span.style.display = 'inline';
                    span.textContent = span.nextElementSibling.value;
                });
                row.querySelectorAll('.edit-mode').forEach(input => input.style.display = 'none');
                row.querySelector('.edit-btn').style.display = 'inline';
                row.querySelector('.save-btn').style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.parentElement.parentElement;
        const id = row.dataset.id;

        // Send AJAX request to delete.php
        fetch('delete.php', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Handle response from server
            
            if(data === "Record deleted successfully") {
                row.remove();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
