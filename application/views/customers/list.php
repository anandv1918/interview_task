<div class="container">
    <h2>Customers</h2>
    <button id="createCustomer" class="btn btn-primary">Add New Customer</button>
    <table id="customersTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Load customers via API
        $.get("<?php echo site_url('api/customers'); ?>", function(data) {
            const table = $('#customersTable tbody');
            data.forEach(customer => {
                table.append(`
                <tr>
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.phone || ''}</td>
                    <td>${customer.email || ''}</td>
                    <td>
                        <a href="<?php echo site_url('customers/edit/'); ?>${customer.id}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${customer.id}">Delete</button>
                    </td>
                </tr>
                `);
            });
        });

        $('#createCustomer').click(function() {
            window.location.href = "<?php echo site_url('customers/create'); ?>";
        });

        $(document).on('click', '.delete-btn', function() {   
            const customerId = $(this).data('id');
            const $row = $(this).closest('tr');

            if (!confirm('Are you sure you want to delete this customer?')) {
                return false;
            }

            $.ajax({
                url: "<?php echo site_url('api/customers/'); ?>"+customerId,
                type: 'DELETE',
                success: function(response) {
                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });

                    alert('Customer deleted successfully');
                },
                error: function(xhr) {
                    alert('Failed to delete customer');
                }
            });
        });
    });
</script>