<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Invoice</h2>
    <a href="<?php echo site_url('invoices'); ?>" class="btn btn-secondary">Back to List</a>
</div>

<div id="message"></div>

<form id="invoiceEditForm">
    <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice->id; ?>">
    
    <div class="mb-3">
        <label for="customer_id" class="form-label">Name *</label>
        <select name="customer_id" id="customer_id" required>
            <option value="">Select Customer</option>
            <?php foreach($customers as $customer): ?>
            <option value="<?php echo $customer->id; ?>" <?php if($customer->id == $invoice->customer_id) echo 'selected'; ?>>
                <?php echo $customer->name; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Phone</label>
        <input type="date" name="date" id="date" value="<?php echo $invoice->date; ?>">
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Email</label>
        <input type="number" name="amount" id="amount" step="0.01" value="<?php echo $invoice->amount; ?>" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Address</label>
        <select name="status" id="status">
            <option value="Unpaid" <?php if($invoice->status == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
            <option value="Paid" <?php if($invoice->status == 'Paid') echo 'selected'; ?>>Paid</option>
            <option value="Cancelled" <?php if($invoice->status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    
    $('#invoiceEditForm').submit(function(e) {
        e.preventDefault();
        
        $('#message').html('');

        invoiceId = $('#invoice_id').val();
        
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
            url: "<?php echo site_url('api/invoices/'); ?>" + invoiceId,
            type: 'PUT',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                $('#message').html('<div class="alert alert-success">Invoice updated successfully</div>');

                setTimeout(() => {
                    window.location.href = "<?php echo site_url('invoices'); ?>";
                }, 1500);
            },
            error: function(xhr) {
                $('#message').html('<div class="alert alert-danger">Failed to update invoice</div>');
            },
            complete: function() {
            }
        });
    });
});
</script>