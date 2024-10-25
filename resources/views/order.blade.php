<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Payment Page</h1>

    <form action="{{ url('create-invoice') }}" method="POST">
        @csrf
        <label for="external_id">Transaction ID:</label>
        <input type="text" name="external_id" required><br>

        <label for="payer_email">Email:</label>
        <input type="email" name="payer_email" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" required><br>

        <input type="hidden" name="success_redirect_url" value="{{ url('/success') }}">
        <input type="hidden" name="failure_redirect_url" value="{{ url('/failure') }}">

        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
