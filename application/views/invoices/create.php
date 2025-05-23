<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Invoice</h2>
    <a href="<?php echo site_url('invoices'); ?>" class="btn btn-secondary">Back to List</a>
</div>

<div id="message"></div>

<form id="invoiceForm">
    <div class="mb-3">
        <label for="customer_id" class="form-label">Customer *</label>
        <select name="customer_id" id="customer_id" required>
            <option value="">Select Customer</option>
            <?php foreach($customers as $customer): ?>
            <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" name="amount" id="amount" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status">
            <option value="Unpaid">Unpaid</option>
            <option value="Paid">Paid</option>
            <option value="Cancelled">Cancelled</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#invoiceForm').submit(function(e) {
        e.preventDefault();
        
        $('#message').html('');
        
        const formData = {
            customer_id: $('#customer_id').val(),
            date: $('#date').val(),
            amount: $('#amount').val(),
            status: $('#status').val()
        };
        
        if (!formData.customer_id) {
            $('#message').html('<div class="alert alert-danger">Please select customer</div>');
            return;
        }
        
        $.ajax({
            url: "<?php echo site_url('api/invoices'); ?>",
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                $('#message').html('<div class="alert alert-success">invoice created successfully</div>');
                $('#invoiceForm')[0].reset();
                setTimeout(() => {
                    window.location.href = "<?php echo site_url('invoices'); ?>";
                }, 1500);
            },
            error: function(xhr) {
                $('#message').html(`<div class="alert alert-danger">Failed to create Invoice</div>`);
            },
        });
    });
});
</script>