<div class="container">
    <h2>Invoices</h2>
    <button id="createInvoice" class="btn btn-primary">Create New Invoice</button>
    <table id="invoicesTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Load invoices via API
    $.get("<?php echo site_url('api/invoices'); ?>", function(data) {
        const table = $('#invoicesTable tbody');
        data.forEach(invoice => {
            table.append(`
                <tr>
                    <td>${invoice.id}</td>
                    <td>${invoice.customer_name}</td>
                    <td>${invoice.date}</td>
                    <td>${invoice.amount}</td>
                    <td>${invoice.status}</td>
                    <td>
                        <a href="<?php echo site_url('invoices/edit/'); ?>${invoice.id}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${invoice.id}">Delete</button>
                    </td>
                </tr>
            `);
        });
    });

    $('#createInvoice').click(function() {
        window.location.href = "<?php echo site_url('invoices/create'); ?>";
    });

    $(document).on('click', '.delete-btn', function() {   
            const invoiceId = $(this).data('id');
            const $row = $(this).closest('tr');

            if (!confirm('Are you sure you want to delete this invoice?')) {
                return false;
            }

            $.ajax({
                url: "<?php echo site_url('api/invoices/'); ?>"+invoiceId,
                type: 'DELETE',
                success: function(response) {
                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });

                    alert('Invoice deleted successfully');
                },
                error: function(xhr) {
                    alert('Failed to delete invoice');
                }
            });
        });
});
</script>