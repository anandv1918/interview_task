<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Customer</h2>
    <a href="<?php echo site_url('customers'); ?>" class="btn btn-secondary">Back to List</a>
</div>

<div id="message"></div>

<form id="customerForm">
    <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#customerForm').submit(function(e) {
        e.preventDefault();
        
        $('#message').html('');
        
        const formData = {
            name: $('#name').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            address: $('#address').val()
        };
        
        if (!formData.name) {
            $('#message').html('<div class="alert alert-danger">Name is required</div>');
            return;
        }
        
        $.ajax({
            url: "<?php echo site_url('api/customers'); ?>",
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                $('#message').html('<div class="alert alert-success">Customer created successfully</div>');
                $('#customerForm')[0].reset();
                setTimeout(() => {
                    window.location.href = "<?php echo site_url('customers'); ?>";
                }, 1500);
            },
            error: function(xhr) {
                $('#message').html(`<div class="alert alert-danger">Failed to create customer</div>`);
            },
        });
    });
});
</script>