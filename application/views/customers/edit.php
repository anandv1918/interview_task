<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Customer</h2>
    <a href="<?php echo site_url('customers'); ?>" class="btn btn-secondary">Back to List</a>
</div>

<div id="message"></div>

<form id="customerEditForm">
    <input type="hidden" id="customer_id" name="invoice_id" value="<?php echo $customer->id; ?>">
    
    <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($customer->name); ?>" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($customer->phone); ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($customer->email); ?>">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($customer->address); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    
    $('#customerEditForm').submit(function(e) {
        e.preventDefault();
        
        $('#message').html('');

        customerId = $('#customer_id').val();
        
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
            url: "<?php echo site_url('api/customers/'); ?>" + customerId,
            type: 'PUT',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                $('#message').html('<div class="alert alert-success">Customer updated successfully</div>');

                setTimeout(() => {
                    window.location.href = "<?php echo site_url('customers'); ?>";
                }, 1500);
            },
            error: function(xhr) {
                $('#message').html(`<div class="alert alert-danger">Failed to update customer</div>`);
            },
            complete: function() {
            }
        });
    });
});
</script>